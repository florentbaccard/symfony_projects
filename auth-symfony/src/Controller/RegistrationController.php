<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use DateTime;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        TokenGeneratorInterface $tokenGeneratorInterface,
        MailerService $mailerService
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $tokenRegistration = $tokenGeneratorInterface->generateToken();
            $user->setTokenRegistration($tokenRegistration);
            $entityManager->persist($user);
            $entityManager->flush();

            // Send confirmation email
            $mailerService->send(
                $user->getEmail(),
                'Confirmation du compte utilisateur',
                'registration_confirmation.html.twig',
                [
                    'user' => $user,
                    'token' => $tokenRegistration,
                    'lifeTimeToken' => $user->getTokenRegistrationLifeTime()->format('d-m-y H:i:s')
                ]
            );

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/{token}/{id<\d+>}', name: 'account_verify', methods: ['GET'])]
    public function verify(string $token, User $user, EntityManagerInterface $em): Response
    {
        if ($user->getTokenRegistration() !== $token || $user->getTokenRegistration() === null || new DateTime('now') > $user->getTokenRegistrationLifeTime()) {
            throw new AccessDeniedException();
        }

        $user->setIsVerified(true);
        $user->setTokenRegistration('');
        $em->flush();

        return $this->redirectToRoute('app_login');
    }
}

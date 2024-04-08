<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserService;
use Doctrine\ORM\EntityManagerInterface;
class ServiceController extends AbstractController
{
#[Route('/service', name: 'app_service')]
public function index(): JsonResponse
{
return $this->json([
'message' => 'Welcome to your new controller!',
'path' => 'src/Controller/ServiceController.php',
]);
}
#[Route('/service/create', name: 'app_service_create')]
public function createAction(EntityManagerInterface $em): JsonResponse
{
$user = new UserService();
$user->setNom('Laurent');
$user->setAge('45');
$em->persist($user);
$em->flush();
return $this->json([
'message' => 'New user',
'value' => $user->getNom()
]);
}

#[Route('/service/search', name: 'app_service_search')]
    public function searchAction(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(UserService::class);
        // $users = $repo->find('1');
        // $users = $repo->findOneBy(['nom' => 'Laurent']);
        // $users = $repo->findBy(['nom' => 'Laurent']);
        $users = $repo->findAll();

        return $this->json([
            'message' => 'The Best',
            'value' => $users
        ]);
    }

    #[Route('/service/update', name: 'app_service_update')]
    public function updateAction(EntityManagerInterface $em): JsonResponse
    {
        $user = $em->getRepository(UserService::class)->find('1');
        $user->setNom('Laurent');
        $em->flush();
        return $this->json([
           'message' => 'Updated user',
            'value' => $user->getNom()
        ]);
    }

    #[Route('/service/delete', name: 'app_service_delete')]
    public function deleteAction(EntityManagerInterface $em): JsonResponse
    {
        $user = $em->getRepository(UserService::class)->find('1');
        $em->remove($user);
        $em->flush();
        return $this->json([
           'message' => 'Deleted user',
            'value' => $user->getNom()
        ]);
    }

}
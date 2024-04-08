<?php
namespace App\Service;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
/**
* Service de génération d'email
*/
class MailerService
{
private $mailer;
public function __construct(MailerInterface $mailer)
{
$this->mailer = $mailer;
}
/**
* @throws TransportExceptionInterface
*/
public function send(
    string $to,
    string $subject,
    string $templateTwig,
    array $context
    ): void {
    $email = (new TemplatedEmail())
    ->from(new Address('contact@monsite.com', 'Administration'))
    ->to($to)
    ->subject($subject)
    ->htmlTemplate("mails/$templateTwig")
    ->context($context);
    try {
    $this->mailer->send($email);
    } catch (TransportExceptionInterface $transportException) {
    throw $transportException;
    }
    }
}
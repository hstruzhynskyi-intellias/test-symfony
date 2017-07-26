<?php
/**
 * Created by PhpStorm.
 * User: hstruzhynskyi
 */

namespace TestApp\UserBundle\EventListener;


use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use TestApp\NotificationBundle\Service\MyMailer;
use TestApp\NotificationBundle\Service\MyMailerInterface;
use TestApp\UserBundle\Manager\MessageManager;


class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $mailer;
    protected $messageManager;
    protected $targetPath;

    public function __construct(MyMailerInterface $mailer, MessageManager $messageManager, $targetPath) // this is @service_container
    {
        $this->mailer = $mailer;
        $this->messageManager = $messageManager;
        $this->targetPath = $targetPath;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        $this->messageManager->addLoginMessage($user);
        $this->mailer->sendLoginEmailMessage($user);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        return new RedirectResponse($this->targetPath);
    }
}
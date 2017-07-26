<?php
/**
 * Created by PhpStorm.
 * User: hstruzhynskyi
 * Date: 7/22/2017
 * Time: 5:19 PM
 */

namespace TestApp\NotificationBundle\Service;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use FOS\UserBundle\Model\UserInterface;

class MyMailer implements MyMailerInterface
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var EngineInterface
     */
    protected $template;

    public function __construct($mailer, EngineInterface $template)
    {
        $this->mailer = $mailer;
        $this->template = $template;
    }

    public function sendLoginEmailMessage(UserInterface $user)
    {
        $rendered = $this->template->render('@TestAppNotification/Default/index.html.twig', array(
            'username' => $user->getUsernameCanonical()
        ));
        $this->sendEmailMessage($rendered, $user->getEmail());
    }

    /**
     * @param string $renderedTemplate
     * @param string $toEmail
     */
    protected function sendEmailMessage($renderedTemplate, $toEmail)
    {
        // Render the email, use the first line as the subject, and the rest as the body
        $renderedLines = explode("\n", trim($renderedTemplate));
        $subject = $renderedLines[0];
        $body = implode("\n", array_slice($renderedLines, 1));

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($toEmail)
            ->setBody($body);

        $this->mailer->send($message);
    }
}
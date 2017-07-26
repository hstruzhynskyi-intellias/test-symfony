<?php
/**
 * Created by PhpStorm.
 * User: hstruzhynskyi
 */

namespace TestApp\UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use TestApp\UserBundle\Entity\User;
use TestApp\UserBundle\Entity\Message;

class MessageManager
{
    private $em;
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function addLoginMessage(User $user)
    {
        $message = new Message();
        $message->setType('info');
        $message->setIsRead(false);
        $message->setText('Login success');
        $message->setUser($user);

        $this->em->persist($message);
        $this->em->flush();
    }

}
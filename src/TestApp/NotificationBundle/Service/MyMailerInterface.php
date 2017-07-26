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

interface MyMailerInterface
{
    public function sendLoginEmailMessage(UserInterface $user);
}
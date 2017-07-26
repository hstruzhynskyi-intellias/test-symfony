<?php

namespace TestApp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller  as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use TestApp\UserBundle\Entity\Message;

//use FOS\UserBundle\Controller\RegistrationController as BaseController;

class DefaultController extends BaseController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('TestAppUserBundle:Default:index.html.twig');
    }

    /**
     * @Route("/message-read/{message_id}", name="message_read")
     */
    public function readMessageAction($message_id)
    {
        $message = $this->getDoctrine()
            ->getRepository(Message::class)
            ->find($message_id);

        if (!$message) {
            throw $this->createNotFoundException(
                'No product found for id '.$message_id
            );
        }

        $message->setIsRead(true);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($message);
        $em->flush();

        return new JsonResponse(array('status' => 'ok'));
    }
}

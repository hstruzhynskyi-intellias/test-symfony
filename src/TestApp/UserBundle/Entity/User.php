<?php
namespace TestApp\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use TestApp\UserBundle\Entity\Message;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user")
     */
    private $messages;

    public function __construct()
    {
        parent::__construct();

        $this->messages = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('is_read', false));

        return $this->messages->matching($criteria);
    }

    public function addLoginMessage()
    {
        $message = new Message();
        $message->setType('info');
        $message->setIsRead(false);
        $message->setText('Login success');
        $this->addMessage($message);
    }

    public function addMessage(Message $message)
    {
        $message->setUser($this);
        $this->messages->add($message);
    }

}

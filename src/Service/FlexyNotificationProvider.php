<?php
namespace App\Service;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;



class FlexyNotificationProvider{

    private $em;
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;

    }

    public function set($title,$message){
        $notification = new Notification();
        $notification->setTitle($title);
        $notification->setMessage($message);
        $this->em->persist($notification);
        $this->em->flush();
    }

    public function getAll(){
        return $this->em->getRepository(Notification::class)->findAll();
    }
}
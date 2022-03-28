<?php
# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
 

    private $security;
    private $passwordEncoder;

    public function __construct(Security $security,UserPasswordEncoderInterface $passwordEncoder)
{
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['beforePersist'],
        ];
    }

    public function beforePersist(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        

                if ($entity instanceof User) {
                    
            $entity->setPassword(
                   $this->passwordEncoder->encodePassword(
                            $entity,
                            $entity->getPassword()
                ));
                
            
            
            
                
        }
    }
}
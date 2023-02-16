<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use App\Service\MailerService;

class EjemploSubscriber implements EventSubscriberInterface
{
    
    public function onAfterEntityPersistedEvent(AfterEntityPersistedEvent $event): void
    {

        $mailer = new MailerService();
        

        $mailer->sendEmail('<p>Hola</p>',$MailerInterface=new MailerInterface());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AfterEntityPersistedEvent::class => 'onAfterEntityPersistedEvent',
        ];
    }
}

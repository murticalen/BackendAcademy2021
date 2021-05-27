<?php


namespace App\Service\Listener;


use App\Entity\Company\Company;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class CompanyChangeListener implements AutoLoadedEventListener
{

    public function getSubscribedEvents()
    {
        return [Events::postUpdate];
    }

    public final function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof Company) {
            var_dump('test');
            //send mail to all fans
        }
    }
}

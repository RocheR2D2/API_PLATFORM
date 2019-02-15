<?php
/**
 * Created by PhpStorm.
 * User: rocher
 * Date: 12/02/19
 * Time: 11:59
 */

namespace App\EventListener;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;

class UserEventListener implements EventSubscriberInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function passwordEncode(GetResponseForControllerResultEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if(!$user instanceof User || Request::METHOD_POST !== $method) {
            return;
        }

        if ($user->getPlainPassword()) {
            /**
             * @var $encode UserPasswordEncoderInterface
             */
            $encoded = $this->encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);
            $user->eraseCredentials();
        }


    }



    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.

        return [
            KernelEvents::VIEW => ['passwordEncode', EventPriorities::POST_VALIDATE],
        ];
    }
}

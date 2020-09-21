<?php

namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Affichage du bloc utilisateur dans la barre du haut
 */
class NavbarShowUserListener
{
    private $tokenStorage;

    public function onShowUser(ShowUserEvent $event)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $event->setUser($user);
    }

    public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
}

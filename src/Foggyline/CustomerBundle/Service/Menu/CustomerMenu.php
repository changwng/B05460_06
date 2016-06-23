<?php

namespace Foggyline\CustomerBundle\Service\Menu;

class CustomerMenu
{
    private $token;
    private $router;

    public function __construct(
        $tokenStorage,
        \Symfony\Bundle\FrameworkBundle\Routing\Router $router
    )
    {
        $this->token = $tokenStorage->getToken();
        $this->router = $router;
    }

    public function getItems()
    {
        $items = array();
        $user = $this->token->getUser();

        if ($user instanceof \Foggyline\CustomerBundle\Entity\Customer) {
            // customer authentication
            $items[] = array(
                'path' => $this->router->generate('customer_account'),
                'label' => $user->getFirstName() . ' ' . $user->getLastName(),
            );
            $items[] = array(
                'path' => $this->router->generate('customer_logout'),
                'label' => 'Logout',
            );
        } else {
            $items[] = array(
                'path' => $this->router->generate('foggyline_customer_login'),
                'label' => 'Login',
            );
            $items[] = array(
                'path' => $this->router->generate('foggyline_customer_register'),
                'label' => 'Register',
            );
        }

        return $items;
    }
}

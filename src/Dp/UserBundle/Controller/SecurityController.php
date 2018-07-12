<?php

namespace Dp\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;


class SecurityController extends BaseController
{
    /**
     * For internal template use: Renders the TB Login ej. Header bar login.
     * No routing used.
     */
    public function tbLoginAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        $data =  array(
            'last_username' => $lastUsername,
            'csrf_token' => $csrfToken,
        );
        return $this->container->get('templating')->renderResponse('DpUserBundle:Security:tbLogin.html.twig', $data);
    }

    /**
     * For internal template use: Renders the Dropdown after authentication ej. Header bar for user.
     * No routing used.
     */
    public function tbAuthenticatedAction()
    {
        $data =  array();
        return $this->container->get('templating')
            ->renderResponse('DpUserBundle:Security:tbAuthenticated.html.twig', $data);
    }
}
?>
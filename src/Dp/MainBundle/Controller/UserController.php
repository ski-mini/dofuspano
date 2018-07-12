<?php

namespace Dp\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('DpMainBundle:Stuff:index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function controlPanelAction()
    {
        $stuffRepo = $this->getDoctrine()
                          ->getManager()
                          ->getRepository('DpMainBundle:Stuff');

        //Les stuffs de l'user
        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED'))
            $stuffList = $stuffRepo->findBy(array('user' => $this->getUser(), 'enable' => 1),  array('created' => 'desc'), 10);
        else
            $stuffList = NULL;

        $user = $this->getUser();

        return $this->render('DpMainBundle:User:controlPanel.html.twig', array(
                                                                                'stuffList'     => $stuffList,
                                                                                'user' => $user
                                                                            )
                            )
        ;
    }
}
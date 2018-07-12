<?php

namespace Dp\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dp\MainBundle\Form\Import;
use Dp\MainBundle\Form\Type\ImportType;
use Dp\MainBundle\Form\Type\StuffType;

use Dp\MainBundle\Entity\Stuff;

use Symfony\Component\HttpFoundation\Request;

class StuffController extends Controller
{
    public function indexAction(Request $request)
    {
        $importObj = new Import();
        $form = $this->createForm(new ImportType(), $importObj);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $importServiceObj = $this->container->get('dp_main.import.dofusbook');

            $importService = $importServiceObj->getAllEquipment($importObj->getUrl());

            return $this->render('DpMainBundle:Stuff:index.html.twig', array(
                'form' => $form->createView(),
                'import' => $importService
            ));
        }

        return $this->render('DpMainBundle:Stuff:index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function voirAction($stuffId)
    {

        $stuff = $this->getDoctrine()
                      ->getManager()
                      ->getRepository('DpMainBundle:Stuff')
                      ->find($stuffId);

        $stuffdetails = $this->getDoctrine()
                             ->getManager()
                             ->getRepository('DpMainBundle:Stuffdetail')
                             ->findAllCharacteristicsByStuff($stuffId);

        //bonuspano
        $calculStuffServiceObj = $this->container->get('dp_main.calcul.stuff');
        $bonusPanoply = $calculStuffServiceObj->getBonusPanoply($stuffdetails);

        $bonusCharacteristics = $calculStuffServiceObj->mergeCharacteristics($stuffdetails);

        if($stuff->getLvl() > 99)
            $basicCharacteristics = array('Vitalité' => array('min'=> 55+($stuff->getLvl()-1)*5, 'max' => 55+($stuff->getLvl()-1)*5), 'PM' => array('min'=> 3, 'max' => 3), 'PA' => array('min'=> 7, 'max' => 7));
        else
            $basicCharacteristics = array('Vitalité' => array('min'=> 55+($stuff->getLvl()-1)*5, 'max' => 55+($stuff->getLvl()-1)*5), 'PM' => array('min'=> 3, 'max' => 3), 'PA' => array('min'=> 6, 'max' => 6));

        $bonusStuffCharacteristics = $calculStuffServiceObj->mergeStuffCharacteristics($stuff->getStuffcharacteristics());

        $totalCharacteristics = $calculStuffServiceObj->getTotalCharacteristics(
                                                                                array(
                                                                                        0 => $bonusCharacteristics,
                                                                                        1 => $bonusPanoply,
                                                                                        2 => $basicCharacteristics,
                                                                                        3 => $bonusStuffCharacteristics
                                                                                    )
                                                                                );
        $spells = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('DpMainBundle:Spell')
                       ->findAll();

        if( $this->getUser() !== NULL) {
            $vote = $this->getDoctrine()
                         ->getManager()
                         ->getRepository('FbrVoteBundle:VoteStuff')
                         ->findOneBy(array('stuff' => $stuffId, 'user' => $this->getUser()->getId()));
            if($vote !== NULL)
                $vote = $vote->getValue();
            else
                $vote = NULL;
        }
        else {
            $vote = 0;
        }

        if( $this->getUser() !== NULL AND $this->getUser()->getId() == $stuff->getUser()->getId() ) {
            $stuffIsMine = TRUE;

            $form = $this->createForm(new StuffType(), $stuff);
            $form = $form->createView();
        }
        else {
            $stuffIsMine = FALSE;
            $form = NULL;
        }

        return $this->render('DpMainBundle:Stuff:voir.html.twig', array(
            'stuff' => $stuff,
            'spells'=> $spells,
            'vote' => $vote,
            'totalCharacteristics' => $totalCharacteristics,
            'stuffIsMine' => $stuffIsMine,
            'form' => $form,
            'verifForm' => NULL,
        ));
    }

    public function modifierAction(Request $request, $stuffId, $user) {

        $session = $request->getSession();

        $stuff = $this->getDoctrine()
                      ->getManager()
                      ->getRepository('DpMainBundle:Stuff')
                      ->find($stuffId);

        $form = $this->createForm(new StuffType(), $stuff);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stuff);
            $em->flush();
            $session->getFlashBag()->add('success', 'Les modifications ont étés correctement appliquées.');
        }
        else{
            $session->getFlashBag()->add('error', 'Il y a eu une erreur lors de la modification de vos informations, elles ne se sont pas correctement enregistrées.');
        }


        return $this->redirect($this->generateUrl('DpMainBundle_stuff_voir', array('stuffId' => $stuffId, 'user' => $user)));
    }
}
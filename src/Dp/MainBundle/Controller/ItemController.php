<?php

namespace Dp\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ItemController extends Controller
{
    public function indexAction($id, $name)
    {

        $ir = $this->getDoctrine()
                   ->getManager()
                   ->getRepository('DpMainBundle:Item');

        $item = $ir->findOneItemWithCharacteristics($id);

        if (!$item) {
            throw $this->createNotFoundException('L\'item n\'existe pas');
        }

        return $this->render('DpMainBundle:Item:index.html.twig', array('item' => $item));
    }

    public function listeAction($type, $minlvl, $maxlvl)
    {

        $er = $this->getDoctrine()
                   ->getManager()
                   ->getRepository('DpMainBundle:Itemtype');

        $itemtype = $er->findOneBy(array('name' => $type));

        if (!$itemtype) {
            throw $this->createNotFoundException('Ce type d\'item n\'existe pas');
        }

        $ir = $this->getDoctrine()
                   ->getManager()
                   ->getRepository('DpMainBundle:Item');

        $itemListe = $this->getDoctrine()
                          ->getManager()
                          ->getRepository('DpMainBundle:Item')
                          ->findItemListByItemtypeId($itemtype->getId(), $minlvl, $maxlvl);

        return $this->render('DpMainBundle:Item:liste.html.twig', array('equipmentListe' => $itemListe));
    }
}
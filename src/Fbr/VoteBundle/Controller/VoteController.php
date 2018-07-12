<?php

namespace Fbr\VoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VoteController extends Controller
{
    public function voteAction(Request $request)
    {
        $response = new JsonResponse();
        $response->setData(array(
            'value' => 0
        ));

        $data = $request->request;

        //TODO(àmoitiéfait) il faut vérifier que l'user est connecté et est authorisé à voter.
        //TODO(jefaisvraiment???) Ensuite on verif que le stuff existe.
        //TODO Si Puis on enregistre et si tout est ok on retourne 1 sinon 0 et rien ne change

        $voteRepo = $this->getDoctrine()
                         ->getManager()
                         ->getRepository('FbrVoteBundle:Vote'.$data->get('element'));
$securityContext = $this->container->get('security.context');
$user = $this->getUser();
        $array = array(
                        strtolower($data->get('element')).'_id' => $data->get('id'),
                        'user_id' => $user->getId(),
                        'created_at' => date("Y-m-d H:i:s"),
                        'value' => $data->get('value')
                    );

        $test = $voteRepo->editVote($data->get('element'), $array);

        // $classname = 'Vote'.$data->get('element');
        // $vote = new $classname;

        $stuff = false;
        // $securityContext = $this->container->get('security.context');
        // if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') && !$stuff){
        //     $user = $this->context->getToken()->getUser();

        //     $classname = 'Vote'.$data->get('element');
        //     $vote = new $classname; //fonctionne pas
        //     $vote->setStuff($stuff);
        //     $vote->setUser($user);
        //     $vote->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=5]//td[position()=4]")->item(0)->nodeValue);

        //     $this->em->persist($vote);
        // }

        return $response;
    }
}

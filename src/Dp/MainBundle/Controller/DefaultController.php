<?php

namespace Dp\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializerBuilder;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $stuffRepo = $this->getDoctrine()
                          ->getManager()
                          ->getRepository('DpMainBundle:Stuff');

        //les derniers stuffs ajoutés
        $lastStuffList = $stuffRepo->findBy(array('enable' => 1, 'online' => 1), array('created' => 'desc'), 10);

        //les meilleures notes
        $bestStuffList = $stuffRepo->findBy(array('enable' => 1, 'online' => 1), array('created' => 'desc'), 10);

        //pour faire beau
        // $itrep = $this->getDoctrine()
        //                      ->getManager()
        //                      ->getRepository('DpMainBundle:Itemtype');
        // $itemtypeList = $itrep->findAll();

        return $this->render('DpMainBundle:Default:index.html.twig', array(
                                                                            'lastStuffList' => $lastStuffList
                                                                            )
                            )
        ;
    }

    public function globalsearchAction(Request $post) {
        $keyword = $post->request->get('query');
        $finder = $this->get('fos_elastica.index.dp_globalsearch');

        $boolQuery = new \Elastica\Query\Bool();

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('name', $keyword);
        $fieldQuery->setFieldParam('name', 'analyzer', 'default');
        $fieldQuery->setFieldParam('name', 'boost', 5);
        $boolQuery->addShould($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('username', $keyword);
        $fieldQuery->setFieldParam('username', 'analyzer', 'default');
        $fieldQuery->setFieldParam('username', 'boost', 5);
        $boolQuery->addShould($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('description', $keyword);
        $fieldQuery->setFieldParam('description', 'analyzer', 'default');
        $fieldQuery->setFieldParam('description', 'boost', 3);
        $boolQuery->addShould($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('keyword', $keyword);
        $fieldQuery->setFieldParam('keyword', 'analyzer', 'default');
        $fieldQuery->setFieldParam('keyword', 'boost', 6);
        $boolQuery->addShould($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('lvl', $keyword);
        $fieldQuery->setFieldParam('lvl', 'analyzer', 'default');
        $boolQuery->addShould($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('body', $keyword);
        $fieldQuery->setFieldParam('body', 'analyzer', 'default');
        $boolQuery->addShould($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('classe_name', $keyword);
        $fieldQuery->setFieldParam('classe_name', 'analyzer', 'default');
        $boolQuery->addShould($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('online', TRUE);
        $boolQuery->addMust($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('enable', TRUE);
        $boolQuery->addMust($fieldQuery);

        $data = $finder->search($boolQuery);

        foreach ($data->getResults() as $key => $value) {
            $infos = $value->getSource();
            $fullname = $infos['name'].' '.$infos['keyword'].', par '.$infos['user']['username'];
            $retour[$key] = array(
                                    'id' => $value->getId(),
                                    'score' => $value->getScore(),
                                    'type' => $value->getType(),
                                    'fullname' => $fullname,
                                    'infos' => $infos
                                );
        }

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($retour, 'json');
        return new Response($reports);

    }
}
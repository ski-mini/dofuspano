<?php

namespace Dp\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializerBuilder;

class AdvancedSearchController extends Controller
{
    public function indexAction(Request $request){

        $k = $request->query->get('k');
        $c = $request->query->get('c');
        $u = $request->query->get('u');

        $finder = $this->get('fos_elastica.index.dp_globalsearch');

        $boolQuery = new \Elastica\Query\Bool();

        if(!empty($k)) {
            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('name', $k);
            $fieldQuery->setFieldParam('name', 'analyzer', 'default');
            $fieldQuery->setFieldParam('name', 'boost', 5);
            $boolQuery->addShould($fieldQuery);

            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('username', $k);
            $fieldQuery->setFieldParam('username', 'analyzer', 'default');
            $fieldQuery->setFieldParam('username', 'boost', 5);
            $boolQuery->addShould($fieldQuery);

            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('description', $k);
            $fieldQuery->setFieldParam('description', 'analyzer', 'default');
            $fieldQuery->setFieldParam('description', 'boost', 3);
            $boolQuery->addShould($fieldQuery);

            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('keyword', $k);
            $fieldQuery->setFieldParam('keyword', 'analyzer', 'default');
            $fieldQuery->setFieldParam('keyword', 'boost', 6);
            $boolQuery->addShould($fieldQuery);

            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('lvl', $k);
            $fieldQuery->setFieldParam('lvl', 'analyzer', 'default');
            $boolQuery->addShould($fieldQuery);

            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('body', $k);
            $fieldQuery->setFieldParam('body', 'analyzer', 'default');
            $boolQuery->addShould($fieldQuery);

            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('classe_name', $k);
            $fieldQuery->setFieldParam('classe_name', 'analyzer', 'default');
            $boolQuery->addShould($fieldQuery);
        }

        if(!empty($c)) {
            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('classe_id', $c);
            $boolQuery->addMust($fieldQuery);
        }

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('online', TRUE);
        $boolQuery->addMust($fieldQuery);

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('enable', TRUE);
        $boolQuery->addMust($fieldQuery);

        // $fieldQuery = new \Elastica\Query();
        // $fieldQuery->setSort(array('score' => 'asc'));

        $data = $finder->search($boolQuery);

        $retour = null;
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


        return $this->render('DpMainBundle:AdvancedSearch:index.html.twig', array(
                                                                            'retour' => $retour,
                                                                            'keyword' => $k,
                                                                            'classe' => $c,
                                                                            'user' => $u
                                                                            )
                            )
        ;
    }
}
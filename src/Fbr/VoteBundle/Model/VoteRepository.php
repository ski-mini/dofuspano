<?php

namespace Fbr\VoteBundle\Model;

use Doctrine\ORM\EntityRepository;

/**
 * VoteRepository
 */
class VoteRepository extends EntityRepository
{

    public function editVote($element, $array) {

        $query = '
                DELETE
                FROM vote_'.strtolower($element).'
                WHERE '.strtolower($element).'_id = '.$array[strtolower($element).'_id'].'
                AND user_id = '.$array['user_id'];
        $stmt = $this->_em->getConnection()->prepare($query);
        $params = array();
        $stmt->execute($params);


        $query = '
               INSERT INTO vote_'.strtolower($element).'
               (';

        foreach ($array as $key => $value) {
            $query .= '`'.$key.'`, ';
        }
        $query = mb_substr($query, 0, mb_strlen($query)-2) . ') VALUES (';

        foreach ($array as $value) {
            $query .= '\''.$value.'\', ';
        }
        $query = mb_substr($query, 0, mb_strlen($query)-2) . ') ';

        $stmt = $this->_em->getConnection()->prepare($query);
        $params = array();
        $stmt->execute($params);
        return true;

    }
}

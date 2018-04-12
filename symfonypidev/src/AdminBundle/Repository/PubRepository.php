<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/04/2018
 * Time: 11:38
 */

namespace AdminBundle\Repository;


class PubRepository extends \Doctrine\ORM\EntityRepository
{

    function findPubByText($text)

    {
        $query=$this->getEntityManager()
            ->createQuery("select pub from AdminBundle:Publication pub 
                                where pub.text LIKE :text ORDER BY pub.idPub DESC  ")
            ->setParameter('text','%'.$text.'%');
        return $query->getResult();
    }
}

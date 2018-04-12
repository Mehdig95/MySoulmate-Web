<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/04/2018
 * Time: 19:11
 */

namespace AdminBundle\Repository;


class RdvRepository extends \Doctrine\ORM\EntityRepository
{

    function findBynomrdv($nomrdv)

    {
        $query=$this->getEntityManager()
            ->createQuery("select rdv from AdminBundle:Rdv rdv 
                                where rdv.nomrdv LIKE :nomrdv   ")
            ->setParameter('nomrdv','%'.$nomrdv.'%');
        return $query->getResult();
    }
}

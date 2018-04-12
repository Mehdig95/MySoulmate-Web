<?php
/**
 * Created by PhpStorm.
 * User: CorpseRoot
 * Date: 3/29/2018
 * Time: 2:29 AM
 */

namespace QuizBundle\Repository;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

class UserRepository extends EntityRepository
{



    public function findMatches(User $user, $sexe, $from, $to)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT u FROM AppBundle:User u WHERE u.id != :userid AND u.type=:sexe AND (u.Age >= :Agefrom AND u.Age <= :Ageto) AND ((u.VieCouplePercent < :userVC1  AND u.VieCouplePercent > :userVC2) OR (u.SocialePercent < :userSo1 AND u.SocialePercent > :userSo2) OR (u.PhysiquePercent < :userPh1 AND u.PhysiquePercent > :userPh2) OR (u.PersonalitePercent < :userPe1 AND u.PersonalitePercent > :userPe2))")
            ->setParameter(':userid',$user->getId())
            ->setParameter('sexe', $sexe)
            ->setParameter('Agefrom', $from )
            ->setParameter('Ageto', $to)
            ->setParameter('userVC1', $user->getVieCouplePercent()+5)
            ->setParameter('userVC2', $user->getVieCouplePercent()-5)
            ->setParameter('userSo1', $user->getSocialePercent()+5)
            ->setParameter('userSo2', $user->getSocialePercent()-5)
            ->setParameter('userPh1', $user->getPhysiquePercent()+5)
            ->setParameter('userPh2', $user->getPhysiquePercent()-5)
            ->setParameter('userPe1', $user->getPersonalitePercent()+5)
            ->setParameter('userPe2', $user->getPersonalitePercent()-5);
        return $query->getResult();
    }


    public function findByName($name)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT u FROM AppBundle:User u WHERE u.username = :name")
            ->setParameter('name',$name);
        return $query->getResult();
    }

}
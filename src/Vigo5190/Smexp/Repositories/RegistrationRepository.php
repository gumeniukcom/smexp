<?php
/**
 * @author Stan Gumeniuk i@vigo.su
 */

namespace Vigo5190\Smexp\Repositories;

use \Doctrine\ORM\EntityRepository,
    Vigo5190\Smexp\Entities,
    \Doctrine\ORM\QueryBuilder;

class RegistrationRepository extends EntityRepository {

//    public function getAll() {
//        $qb = $this->_em->createQueryBuilder();
//
////        $filter[1] = $from;
////        $filter[2] = $to;
////
////        if (!$user) {
////            $varwhere = $qb->expr()->andX(
////                $qb->expr()->gte('um.DATE_ACTIVE_FROM', '?1'),
////                $qb->expr()->lte('um.DATE_ACTIVE_FROM', '?2')
////            );
////        } else {
////            $filter[3] = $user;
////            $varwhere = $qb->expr()->andX(
////                $qb->expr()->gte('um.DATE_ACTIVE_FROM', '?1'),
////                $qb->expr()->lte('um.DATE_ACTIVE_FROM', '?2'),
////                $qb->expr()->eq('um.USER_ID', '?3')
////            );
////        }
//
//        $qb->add('select', new \Doctrine\ORM\Query\Expr\Select(array('um')));
////            ->add('from', new \Doctrine\ORM\Query\Expr\From('Entities\UserMood', 'um'))
////            ->add('where', $varwhere)
////            ->add('orderBy', new \Doctrine\ORM\Query\Expr\OrderBy('um.DATE_ACTIVE_FROM', 'DESC'))
////            ->setParameters($filter);
//
//        return $qb->getQuery();
//    }

    public function getIds2($from, $to) {

        /** @var QueryBuilder $qb */
        $qb = $this->_em->createQueryBuilder();

        $filter[1] = $from;
        $filter[2] = $to;

        $varwhere = $qb->expr()->andX(
                       $qb->expr()->gte('um.id', '?1'),
                       $qb->expr()->lte('um.id', '?2')
        );

        $qb->add('select', new \Doctrine\ORM\Query\Expr\Select(array('id')))
           ->add('from', new \Doctrine\ORM\Query\Expr\From('\\Vigo5190\\Smexp\\Entities\\Registration', 'um'))
           ->add('where', $varwhere)
           ->setParameters($filter);

        return $qb->getQuery();

    }


}
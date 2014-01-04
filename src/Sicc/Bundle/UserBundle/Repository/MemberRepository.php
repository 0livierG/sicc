<?php

namespace Sicc\Bundle\UserBundle\Reposity;

use Doctrine\ORM\EntityRepository;


class MemberRepository extends EntityRepository
{
    public function findByCounted()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT COUNT(a) FROM SiccUserBundle:Member a')
            ->getResult();
    }
}

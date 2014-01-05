<?php

namespace Sicc\Bundle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RealisationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RealisationRepository extends EntityRepository
{
    public function findOneByCounted()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT COUNT(a) FROM SiccAdminBundle:Realisation a')
            ->getSingleScalarResult();
    }
}

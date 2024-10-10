<?php declare(strict_types=1);

namespace App\Agenda\Repositories;

use Doctrine\ORM\EntityRepository;

class AbstractRepository extends EntityRepository
{
    public function save(object $entity): void
    {
        $em = $this->getEntityManager();

        $em->persist($entity);
        $em->flush();
    }

    public function remove(object $entity): void
    {
        $em = $this->getEntityManager();

        $em->remove($entity);
        $em->flush();
    }
}

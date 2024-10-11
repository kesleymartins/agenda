<?php declare(strict_types=1);

namespace App\Agenda\Repositories;

use App\Agenda\Entities\Person;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<Person>
 */
class PersonRepository extends AbstractRepository
{
    public function getAll(array $filter)
    {
        $qb = $this->createQueryBuilder('p');

        if ($filter['name']) {
            $qb->where('LOWER(p.name) like :name')->setParameter('name', "%{$filter['name']}%");
        }

        return $qb->getQuery()->getResult();
    }
}

<?php declare(strict_types=1);

namespace App\Agenda\Repositories;

use App\Agenda\Entities\Person;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<Person>
 */
class PersonRepository extends EntityRepository
{
    public function save(Person $person): void
    {
        $em = $this->getEntityManager();

        $em->persist($person);
        $em->flush();
    }

    public function remove(Person $person): void
    {
        $em = $this->getEntityManager();

        $em->remove($person);
        $em->flush();
    }
}

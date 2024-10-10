<?php declare(strict_types=1);

namespace App\Agenda\Repositories;

use App\Agenda\Entities\Contact;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<Contact>
 */
class ContactRepository extends EntityRepository
{
    public function save(Contact $contact): void
    {
        $em = $this->getEntityManager();

        $em->persist($contact);
        $em->flush();
    }

    public function remove(Contact $contact): void
    {
        $em = $this->getEntityManager();

        $em->remove($contact);
        $em->flush();
    }
}

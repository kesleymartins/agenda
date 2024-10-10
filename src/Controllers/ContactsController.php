<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

use App\Agenda\Entities\Contact;
use App\Agenda\Repositories\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactsController extends AbstractController
{
    private ContactRepository $contactRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->contactRepository = $entityManager->getRepository(Contact::class);
    }

    public function index(int $person_id): void
    {
        $contacts = $this->contactRepository->findBy(['person' => $person_id]);

        echo $this->twig->render('index.twig', [
            'person_id' => $person_id,
            'contacts' => $contacts
        ]);
    }
}

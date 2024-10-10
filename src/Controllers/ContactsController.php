<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

use App\Agenda\Entities\Contact;
use App\Agenda\Entities\Person;
use App\Agenda\Repositories\ContactRepository;
use App\Agenda\Repositories\PersonRepository;
use App\Agenda\Types\ContactType;
use Doctrine\ORM\EntityManagerInterface;

class ContactsController extends AbstractController
{
    private ContactRepository $contactRepository;
    private PersonRepository $personRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->contactRepository = $entityManager->getRepository(Contact::class);
        $this->personRepository = $entityManager->getRepository(Person::class);
    }

    public function index(int $person_id): void
    {
        $contacts = $this->contactRepository->findBy(['person' => $person_id]);
        $person = $this->personRepository->find($person_id);

        echo $this->twig->render('index.twig', [
            'person' => $person,
            'contacts' => $contacts
        ]);
    }

    public function new(int $person_id): void
    {
        echo $this->twig->render('new.twig', [
            'person_id' => $person_id,
            'contact' => new Contact(),
            'types' => ContactType::cases()
        ]);
    }

    public function create(int $person_id): void
    {
        $person = $this->personRepository->find($person_id);

        $contact = new Contact();
        $contact->setType(ContactType::from((int) $_POST['type']));
        $contact->setDescription($_POST['description']);
        $contact->setPerson($person);

        $this->contactRepository->save($contact);

        header("Location: /people/$person_id/contacts");
    }

    public function edit(int $id): void
    {
        $contact = $this->contactRepository->find($id);

        echo $this->twig->render('edit.twig', [
            'contact' => $contact,
            'types' => ContactType::cases()
        ]);
    }

    public function update(int $id): void
    {
        $contact = $this->contactRepository->find($id);
        $contact->setType(ContactType::from((int) $_POST['type']));
        $contact->setDescription($_POST['description']);

        $this->contactRepository->save($contact);

        header("Location: /people/{$contact->getPerson()->getId()}/contacts");
    }
}

<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

use App\Agenda\Core\FlashMessage;
use App\Agenda\Entities\Contact;
use App\Agenda\Entities\Person;
use App\Agenda\Repositories\ContactRepository;
use App\Agenda\Repositories\PersonRepository;
use App\Agenda\Types\ContactType;
use App\Agenda\Types\FlashType;
use Doctrine\ORM\EntityManagerInterface;

class ContactsController extends AbstractController
{
    private ContactRepository $contactRepository;
    private PersonRepository $personRepository;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->contactRepository = $em->getRepository(Contact::class);
        $this->personRepository = $em->getRepository(Person::class);
    }

    public function index(int $person_id): void
    {
        $contacts = $this->contactRepository->findBy(['person' => $person_id]);
        $person = $this->personRepository->find($person_id);

        echo $this->response->render('index', [
            'person' => $person,
            'contacts' => $contacts
        ]);
    }

    public function new(int $person_id): void
    {
        echo $this->response->render('new', [
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

        $errors = $this->validator->validate($contact);

        if (count($errors) > 0) {
            FlashMessage::add(FlashType::Error, 'Verifique os campos antes de continuar.');
            $this->response->render('new', [
                'person_id' => $person_id,
                'contact' => $contact,
                'types' => ContactType::cases(),
                'formErrors' => $errors,
            ]);
        }

        $this->contactRepository->save($contact);

        FlashMessage::add(FlashType::Success, 'Contato criado.');
        $this->response->redirect("/people/$person_id/contacts");
    }

    public function edit(int $id): void
    {
        $contact = $this->contactRepository->find($id);

        echo $this->response->render('edit', [
            'contact' => $contact,
            'types' => ContactType::cases(),
        ]);
    }

    public function update(int $id): void
    {
        $contact = $this->contactRepository->find($id);
        $contact->setType(ContactType::from((int) $_POST['type']));
        $contact->setDescription($_POST['description']);

        $errors = $this->validator->validate($contact);

        if (count($errors) > 0) {
            FlashMessage::add(FlashType::Error, 'Verifique os campos antes de continuar.');
            $this->response->render('edit', [
                'contact' => $contact,
                'formErrors' => $errors,
                'types' => ContactType::cases()
            ]);
        }

        $this->contactRepository->save($contact);

        FlashMessage::add(FlashType::Success, 'Contato atualizado.');
        $this->response->redirect("/people/{$contact->getPerson()->getId()}/contacts");
    }

    public function destroy(int $id): void
    {
        $contact = $this->contactRepository->find($id);
        $this->contactRepository->remove($contact);

        FlashMessage::add(FlashType::Success, 'Contato removido.');
        $this->response->redirect("/people/{$contact->getPerson()->getId()}/contacts");
    }
}

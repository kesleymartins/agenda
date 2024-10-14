<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

use App\Agenda\Core\FlashMessage;
use App\Agenda\Entities\Person;
use App\Agenda\Repositories\PersonRepository;
use App\Agenda\Types\FlashType;
use Doctrine\ORM\EntityManagerInterface;

class PeopleController extends AbstractController
{
    private PersonRepository $personRepository;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->personRepository = $em->getRepository(Person::class);
    }

    public function index(): void
    {
        $filter = [
            'name' => urldecode($_GET['name'] ?? '')
        ];

        echo $this->response->render('index', [
            'filter' => $filter,
            'people' => $this->personRepository->getAll($filter)
        ]);
    }

    public function new(): void
    {
        echo $this->response->render('new', [
            'person' => new Person()
        ]);
    }

    public function create(): void
    {
        $person = new Person();
        $person->setName($_POST['name']);
        $person->setCpf($_POST['cpf']);

        $errors = $this->validator->validate($person);

        if (count($errors) > 0) {
            FlashMessage::add(FlashType::Error, 'Verifique os campos antes de continuar.');

            $this->response->render('new', [
                'person' => $person,
                'formErrors' => $errors
            ]);
        }

        $this->personRepository->save($person);

        FlashMessage::add(FlashType::Success, 'Pessoa criada.');
        $this->response->redirect('/people');
    }

    public function edit(int $id): void
    {
        $person = $this->personRepository->find($id);

        echo $this->response->render('edit', [
            'person' => $person
        ]);
    }

    public function update(int $id): void
    {
        $person = $this->personRepository->find($id);
        $person->setName($_POST['name']);
        $person->setCpf($_POST['cpf']);

        $errors = $this->validator->validate($person);

        if (count($errors) > 0) {
            FlashMessage::add(FlashType::Error, 'Verifique os campos antes de continuar.');

            $this->response->render('edit', [
                'person' => $person,
                'formErrors' => $errors
            ]);
        }

        $this->personRepository->save($person);

        FlashMessage::add(FlashType::Success, 'Pessoa Atualizada.');
        $this->response->redirect('/people');
    }

    public function destroy(int $id): void
    {
        $person = $this->personRepository->find($id);
        $this->personRepository->remove($person);

        FlashMessage::add(FlashType::Success, 'Pessoa Removida.');

        $this->response->redirect('/people');
    }
}

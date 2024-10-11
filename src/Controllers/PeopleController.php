<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

use App\Agenda\Entities\Person;
use App\Agenda\Repositories\PersonRepository;
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
            'name' => $this->request->getParam('name')
        ];

        echo $this->twig->render('index.twig', [
            'filter' => $filter,
            'people' => $this->personRepository->getAll($filter)
        ]);
    }

    public function new(): void
    {
        echo $this->twig->render('new.twig', [
            'person' => new Person()
        ]);
    }

    public function create(): void
    {
        $person = new Person();
        $person->setName($_POST['name']);
        $person->setCpf($_POST['cpf']);

        $this->personRepository->save($person);

        header('Location: /people');
    }

    public function edit(int $id): void
    {
        $person = $this->personRepository->find($id);

        echo $this->twig->render('edit.twig', [
            'person' => $person
        ]);
    }

    public function update(int $id): void
    {
        $person = $this->personRepository->find($id);
        $person->setName($_POST['name']);
        $person->setCpf($_POST['cpf']);

        $this->personRepository->save($person);

        header('Location: /people');
    }

    public function destroy(int $id): void
    {
        $person = $this->personRepository->find($id);
        $this->personRepository->remove($person);

        header('Location: /people');
    }
}

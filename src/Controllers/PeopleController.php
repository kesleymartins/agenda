<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

use App\Agenda\Entities\Person;
use App\Agenda\Repositories\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;

class PeopleController extends AbstractController
{
    private PersonRepository $personRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->personRepository = $entityManager->getRepository(Person::class);
    }

    public function index(): void
    {
        echo $this->twig->render('index.twig', [
            'people' => $this->personRepository->findAll()
        ]);
    }
}

<?php declare(strict_types=1);

namespace App\Agenda\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'contacts')]
class Contact
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int $id;

    #[Column(type: 'string')]
    private string $name;

    #[Column(type: 'string')]
    private string $cpf;

    #[ManyToOne(targetEntity: Person::class, inversedBy: 'contacts')]
    #[JoinColumn(name: 'person_id', referencedColumnName: 'id')]
    private Person $person;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPerson(): Person
    {
        return $this->person;
    }
}

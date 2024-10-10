<?php declare(strict_types=1);

namespace App\Agenda\Entities;

use App\Agenda\Repositories\ContactRepository;
use App\Agenda\Types\ContactType;
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

    #[Column(type: 'integer', enumType: ContactType::class)]
    private ContactType $type;

    #[Column(type: 'text')]
    private string $description;

    #[ManyToOne(targetEntity: Person::class, inversedBy: 'contacts')]
    #[JoinColumn(name: 'person_id', referencedColumnName: 'id')]
    private Person $person;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ContactType
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }
}

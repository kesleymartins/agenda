<?php declare(strict_types=1);

namespace App\Agenda\Entities;

use App\Agenda\Repositories\ContactRepository;
use App\Agenda\Types\ContactType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'contacts')]
#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'integer', enumType: ContactType::class)]
    private ?ContactType $type;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\ManyToOne(targetEntity: Person::class, inversedBy: 'contacts')]
    #[ORM\JoinColumn(name: 'person_id', referencedColumnName: 'id')]
    private Person $person;

    public function __construct()
    {
        $this->type = null;
        $this->description = '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?ContactType
    {
        return $this->type;
    }

    public function setType(ContactType $type): void
    {
        $this->type = $type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }
}

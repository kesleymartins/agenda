<?php declare(strict_types=1);

namespace App\Agenda\Types;

enum ContactType: int
{
    case PhoneNumber = 1;
    case Email = 2;

    public function label(): string
    {
        return match ($this) {
            self::Email => 'E-mail',
            self::PhoneNumber => 'Telefone'
        };
    }
}

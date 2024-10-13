<?php declare(strict_types=1);

namespace App\Agenda\Types;

enum FlashType: int
{
    case Success = 1;
    case Error = 2;

    public function color(): string
    {
        return match ($this) {
            self::Success => 'is-success',
            self::Error => 'is-danger',
        };
    }
}

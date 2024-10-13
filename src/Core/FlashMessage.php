<?php declare(strict_types=1);

namespace App\Agenda\Core;

use App\Agenda\Types\FlashType;

class FlashMessage
{
    public static function add(FlashType $type, string $message): void
    {
        if (false === isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }

        $_SESSION['flash_messages'][] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public static function get(): ?array
    {
        if (isset($_SESSION['flash_messages'])) {
            $messages = $_SESSION['flash_messages'];
            unset($_SESSION['flash_messages']);
            return $messages;
        }

        return null;
    }
}

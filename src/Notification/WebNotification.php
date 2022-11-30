<?php

declare(strict_types=1);

namespace App\Notification;

class WebNotification
{
    public static function add(string $message, string $type): void
    {
        $_SESSION[$type] = $message;
    }
    public static function show(): void
    {
        if (true === isset($_SESSION['success'])) {
            $type = 'success';
            $message = $_SESSION['success'];

            include '../Views/template/notification.phtml';
            unset($_SESSION['success']);

        }
        if (true === isset($_SESSION['danger'])) {
            $type = 'danger';
            $message = $_SESSION['danger'];

            include '../Views/template/notification.phtml';
            unset($_SESSION['danger']);
        }
    }
}

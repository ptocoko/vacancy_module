<?php

declare(strict_types=1);

namespace App\Models;


class User
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $type;

    public function __construct()
    {
        $this->id = (int)$_SESSION['id'];
        $this->type = $_SESSION['work'] === '2' || $_SESSION['work'] === '6' ? UserRoles::DIRECTOR : UserRoles::TEACHER;
    }

    public static function authenticate(): ?User
    {
        if (!empty($_SESSION['id'])) {
            return new User();
        }
        return null;
    }

}
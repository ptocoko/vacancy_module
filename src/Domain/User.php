<?php

declare(strict_types=1);

namespace App\Domain;


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

    /**
     * @var string
     */
    public $schoolid;


    public function __construct()
    {
        $this->type = $_SESSION['work'] === '2' || $_SESSION['work'] === '6' ? UserRoles::DIRECTOR : UserRoles::TEACHER;
    }

}
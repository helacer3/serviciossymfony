<?php
// src/Service/UsersService.php
namespace App\Service;

/**
 * Users Service
*/
class UserService
{

    /**
    * create User
    */
    public function hello($name)
    {
        return "hola: ".$name;
    }
}
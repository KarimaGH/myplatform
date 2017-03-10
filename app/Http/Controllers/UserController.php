<?php

namespace App\Http\Controllers;

use App\User;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends AbstractController
{
    protected $entity = User::class;
}

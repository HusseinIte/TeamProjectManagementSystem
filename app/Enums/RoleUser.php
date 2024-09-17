<?php

namespace App\Enums;

enum RoleUser :string
{
    case Admin = "Admin";
    case User= "User";
    case Manager = "Manager";
    case Developer="Developer";
    case Tester ="Tester";
}

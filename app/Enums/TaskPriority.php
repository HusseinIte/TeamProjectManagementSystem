<?php

namespace App\Enums;

enum TaskPriority :string
{
    case Low = 'Low';
    case High = 'High';
    case Medium = 'Medium';
}

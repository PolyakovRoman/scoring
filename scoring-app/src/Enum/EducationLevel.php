<?php
namespace App\Enum;

enum EducationLevel: string
{
    case SECONDARY = 'Среднее образование';
    case SPECIAL = 'Специальное образование';
    case HIGHER = 'Высшее образование';
}
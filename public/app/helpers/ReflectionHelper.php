<?php

namespace App\helpers;

use ReflectionClass;

class ReflectionHelper
{
    public function getClassConstants(string $className): array
    {
        $reflector = new ReflectionClass($className);

        return $reflector->getConstants();
    }
}

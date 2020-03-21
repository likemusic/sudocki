<?php

namespace App\helpers;

use App\Contracts\CustomerGroup\IdInterface as CustomerGroupIdEnum;
use \App\Contracts\CustomerGroup\Group1Interface;
use \App\Contracts\CustomerGroup\Group2Interface;
use \App\Contracts\CustomerGroup\Group3Interface;
use \App\Contracts\CustomerGroup\Group4Interface;
use \App\Contracts\CustomerGroup\Group5Interface;

class CustomerGroupHelper
{
    /** @var ReflectionHelper */
    private $reflectionHelper;

    public function __construct(ReflectionHelper $reflectionHelper)
    {
        $this->reflectionHelper = $reflectionHelper;
    }

    public function getKnownIds(): array
    {
        return $this->getClassConstants(CustomerGroupIdEnum::class);
    }

    public function getAll(): array
    {
        return [
            Group1Interface::class,
            Group2Interface::class,
            Group3Interface::class,
            Group4Interface::class,
            Group5Interface::class,
        ];
    }


    private function getClassConstants(string $className): array
    {
        return $this->reflectionHelper->getClassConstants($className);
    }
}

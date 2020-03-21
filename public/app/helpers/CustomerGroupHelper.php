<?php

namespace App\helpers;

use App\Contracts\CustomerGroup\IdInterface as CustomerGroupIdEnum;

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

    private function getClassConstants(string $className): array
    {
        return $this->reflectionHelper->getClassConstants($className);
    }
}

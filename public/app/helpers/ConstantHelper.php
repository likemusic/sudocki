<?php

namespace App\helpers;

use Illuminate\Database\Eloquent\Model;

class ConstantHelper
{

    // статусы ответа для сущностей CAR
    const ENTITY_CREATED='created';
    const ENTITY_UPDATED='updated';
    const ENTITY_DELETED='deleted';
    // пользовательские ошыбки для сущностей нужно для уведомляшки
    const ENTITY_WARNING='warning';

}

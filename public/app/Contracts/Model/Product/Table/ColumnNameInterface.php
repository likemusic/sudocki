<?php

namespace App\Contracts\Model\Product\Table;

interface ColumnNameInterface
{
    const ID = 'id';
    const NAME = 'name'; // Наименование
    const UUID = 'uuid'; // Ид
    const BARCODE = 'barcode'; // Штрихкод
    const SKU = 'sku'; // Артикул

    const WEIGHT = 'weight'; // Базовая единица > Пересчет > Дополнительные данные > Вес
    const VOLUME = 'volume'; // Базовая единица > Пересчет > Дополнительные данные > Объем

    const SORT = 'sort';
    const STATUS = 'status';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const CATEGORY_ID = 'id_category';

    const QUANTITY = 'quantity'; // Кол-во
    const UNIT_NAME = 'unit_name'; // Базовая единица > #text

    // prices for different customer groups
    const PRICE_1 = 'price_1';
    const PRICE_2 = 'price_2';
    const PRICE_3 = 'price_3';
    const PRICE_4 = 'price_4';
    const PRICE_5 = 'price_5';
}

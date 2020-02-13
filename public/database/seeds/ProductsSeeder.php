<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Post;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('cars')->delete();
        //factory(\App\Model\Entity\Car::class, 50)->create()->each(function($u) {
        // $u->posts()->save(factory(Car::class)->make());
        //});


        $heads=['id',
            'name', 'price', 'sort', 'status', 'created_at', 'updated_at',
            'id_category', // принадлежность к категории
            'type', //Контейнер/судок
            'application', // застосування Универсальное
            'material', //Пластик
            'form', //Прямоугольная
            'color',
            'volume', // Об`єм	500.0 (мл)
            'length', //Довжина	125.0 (мм)
            'width', //Ширина	105.0 (мм)
            'height', // Висота	55.0 (мм)
            'manufacturer', //Виробник  	Народный продукт
            'country', //Країна виробник	Украина
            'cap', // Крышка	есть
            'tem', //Максимально допустимая температура	110
            ];
// категории
//1	Судки
//2	Бокси з ручками
//3	Набори боксів
//4	Ємності для сипучих продуктів
//5	Ємності для дрібних сипучих та рідких продуктів
//6	Герметичні контейнери
//7	Набори для побуту
//8	Миски
//9	Круглі ємності
//10	Ланч бокси
//11	Аксесуари для кухні



        DB::table('products')->truncate();
        factory(\App\models\Product::class, 200)->create();


    }


}

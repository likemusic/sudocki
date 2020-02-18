<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    /**
     * Get the comments for the blog post.
     */
    public function products()
    {
        return $this->hasMany('App\models\Product','id_category','id');
    }
    public function attributelist()
    {
        return $this->hasMany('App\models\Product','id_category','id');
    }

    public function getHeadersList(){

        if(1){
             return $this->sudockhiHeaders();
        }
//        'name', 'price', 'sort', 'status', 'created_at', 'updated_at',
//            'id_category', // принадлежность к категории
//            'type', //Контейнер/судок
//            'application', // застосування Универсальное
//            'material', //Пластик
//            'form', //Прямоугольная
//            'color',
//            'volume', // Об`єм	500.0 (мл)
//            'length', //Довжина	125.0 (мм)
//            'width', //Ширина	105.0 (мм)
//            'height', // Висота	55.0 (мм)
//            'manufacturer', //Виробник  	Народный продукт
//            'country', //Країна виробник	Украина
//            'cap', // Крышка	есть
//            'tem', //Максимально допустимая температура	110


    }


    private function sudockhiHeaders($isAdmin=false){

        $result= [
            ['name'=>"Код", 'code'=>"sku",],['name'=>"Название", 'code'=>"name",], ['name'=>"Цвет", 'code'=>"color",],
            ['name'=>"Крышка", 'code'=>"cap",], ['name'=>"Форма", 'code'=>"form",], ['name'=>"Температура", 'code'=>"tem",],
            ['name'=>"Количество", 'code'=>"quantity",],
            ['name'=>"Цена", 'code'=>"price",],
            ];
        return $result;
    }


    public function getProductsList(){
        return $this->sudockhiProducts();
//        'name', 'price', 'sort', 'status', 'created_at', 'updated_at',
//            'id_category', // принадлежность к категории
//            'type', //Контейнер/судок
//            'application', // застосування Универсальное
//            'material', //Пластик
//            'form', //Прямоугольная
//            'color',
//            'volume', // Об`єм	500.0 (мл)
//            'length', //Довжина	125.0 (мм)
//            'width', //Ширина	105.0 (мм)
//            'height', // Висота	55.0 (мм)
//            'manufacturer', //Виробник  	Народный продукт
//            'country', //Країна виробник	Украина
//            'cap', // Крышка	есть
//            'tem', //Максимально допустимая температура	110


    }

    private function sudockhiProducts(){
        $products= $this->products;
        $tmp=[];
        foreach ($products as $product) {
             $tmp[]=[
                  'product'=>$product,
                  'atr1'=>$product->color, //color
                  'atr2'=>$product->cap,   //крышка
                  'atr3'=>$product->form,  //форм
                  'atr4'=>$product->temp,   //температура
             ];
        }
        return $tmp;
//        return [['name'=>"Название", 'code'=>"name",],
//            ['name'=>"Цвет", 'code'=>"color",],
//            ['name'=>"Крышка", 'code'=>"cap",],
//            ['name'=>"Форма", 'code'=>"form",],
//            ['name'=>"Температура", 'code'=>"tem",], ['name'=>"Цена", 'code'=>"price",],
//        ];
    }


}

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Entity\Car;
use App\models\Product;
use Faker\Generator as Faker;


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
    'temp', //Максимально допустимая температура	110
];
$factory->define(Product::class, function (Faker $faker) {

    $catId=random_int(1,11);
    switch ($catId) {
        case 1:
            return getSudok( $faker); break;
        case 2:
            return getBoxHandle( $faker); break;
        case 3:
            return getBoxComplete( $faker); break;
        case 4:
            return getEmnosti1( $faker); break;
        case 5:
            return getEmnosti2( $faker); break;
        case 6:
            return getGermetic( $faker); break;
        case 7:
            return getPobut( $faker); break;
        case 8:
            return getMiska( $faker); break;
        case 9:
            return getKrugli( $faker); break;
        case 10:
            return getLanchBox( $faker); break;
        case 11:
            return getAcsseuars( $faker); break;


    }




});


function getSudok(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $temList=[60,80,120,180,];
    return [
        'name' => 'Судок '. $faker->word,
        'id_category' => 1,
        'type' => 'Контейнер/судок',
        'application' => 'Универсальное',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'form' => $faker->randomElement($formList) ,
        'temp' => $faker->randomElement($temList) ,
        'price' => $faker->randomNumber(2),
    ];
}
function getBoxHandle(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $capList=['Есть','Нет'];
    $temList=[60,80,120,180,];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Бокс з ручкой '. $faker->word,
        'id_category' => 2,
        'type' => 'Бокс з ручкой',
        'application' => 'Универсальное',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
          'form' => $faker->randomElement($formList) ,
    ];
}
function getBoxComplete(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $temList=[60,80,120,180,];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Набор боксів '. $faker->word,
        'id_category' => 3,
        'type' => 'Набор боксів',
        'application' => 'Универсальное',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
          'form' => $faker->randomElement($formList) ,
    ];
}

function getEmnosti1(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $widthList=[125,150,175,190];
    $temList=[60,80,120,180,];
    $heightList=[55,77,88,100];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Ємнiсть для сипучих продуктів '. $faker->word,
        'id_category' => 4,
        'type' => 'Ємнiсть',
        'application' => 'для сипучих продуктів',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
          'form' => $faker->randomElement($formList) ,
    ];
}
function getEmnosti2(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $temList=[60,80,120,180,];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Ємнiсть для рiдких продуктів '. $faker->word,
        'id_category' => 5,
        'type' => 'Ємнiсть',
        'application' => 'для рiдких продуктів',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
          'form' => $faker->randomElement($formList) ,
    ];
}
function getGermetic(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $temList=[60,80,120,180,];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Герметичні контейнери '. $faker->word,
        'id_category' => 6,
        'type' => 'Ємнiсть',
        'application' => 'Герметичні контейнери',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
          'form' => $faker->randomElement($formList) ,
    ];
}
function getPobut(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $temList=[60,80,120,180,];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Набори для побуту '. $faker->word,
        'id_category' => 7,
        'type' => 'побут',
        'application' => 'Набори для побуту',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
        'length' => $faker->randomElement($lengthList) ,
          'form' => $faker->randomElement($formList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
    ];
}
function getMiska(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $temList=[60,80,120,180,];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Миски '. $faker->word,
        'id_category' => 8,
        'type' => 'побут',
        'application' => 'Миски',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
          'form' => $faker->randomElement($formList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
    ];
}
function getKrugli(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $widthList=[125,150,175,190];
    $temList=[60,80,120,180,];
    $heightList=[55,77,88,100];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Круглі ємності '. $faker->word,
        'id_category' => 9,
        'type' => 'побут',
        'application' => 'Круглі ємності',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
          'form' => $faker->randomElement($formList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
    ];
}
function getLanchBox(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $temList=[60,80,120,180,];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $capList=['Есть','Нет'];
    $formList=['Круглый','Квадратный','Овальный'];
    return [
        'name' => 'Ланч бокси '. $faker->word,
        'id_category' => 10,
        'type' => 'Ланч бокси',
        'application' => 'Ланч боксиі',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
          'form' => $faker->randomElement($formList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'cap' => $faker->randomElement($capList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
    ];
}
function getAcsseuars(Faker $faker){
    $colorList=['Прозрачный','Белый',"Матовый"];
    $volumeList=[250,500,750,1000];
    $lengthList=[125,150,175,190];
    $temList=[60,80,120,180,];
    $widthList=[125,150,175,190];
    $heightList=[55,77,88,100];
    $formList=['Круглый','Квадратный','Овальный'];

    return [
        'name' => 'Аксесуар '. $faker->word,
        'id_category' => 11,
        'type' => 'Аксесуари',
        'application' => 'Аксесуари для кухні',
        'material' => 'Пластик',
        'color' => $faker->randomElement($colorList) ,
        'volume' => $faker->randomElement($volumeList) ,
          'form' => $faker->randomElement($formList) ,
        'length' => $faker->randomElement($lengthList) ,
        'width' => $faker->randomElement($widthList) ,
        'height' => $faker->randomElement($heightList) ,
        'price' => $faker->randomNumber(2),
        'temp' => $faker->randomElement($temList) ,
    ];
}






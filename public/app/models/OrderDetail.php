<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    //
    public function withProductName($productID){
        $product=Product::where('id',$productID)->first();
        $this->name=$product->name;
        return $this;
    }
    public function withProductPrice($productID){
        $product=Product::where('id',$productID)->first();
        $this->price=$product->price;
        return $this;
    }
    //еще нет данных
    public function withProductCode($productID){
//        $product=Product::where('id',$productID)->first();
//        $this->price=$product->price;
        return $this;
    }
    public function withProductQuantity($count){
        $this->quantity=$count;
        return $this;
    }

}
//$table->integer('order_id')->nullable();
//$table->string('name')->nullable();
//$table->string('code')->nullable()->comment('Aртикул');
//$table->string('detail')->nullable()->comment('Текст');
//$table->decimal('price',9,2)->default(0)->comment('Цена');
//$table->integer('quantity')->default(0);
//$table->integer('status')->default(0);


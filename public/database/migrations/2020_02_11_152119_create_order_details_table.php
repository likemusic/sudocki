<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('order_id')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable()->comment('Aртикул');
            $table->string('detail')->nullable()->comment('Текст');
            $table->decimal('price',9,2)->default(0)->comment('Цена');
            $table->integer('quantity')->default(0);
            $table->integer('status')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}

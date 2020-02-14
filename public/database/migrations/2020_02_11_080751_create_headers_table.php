<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->nullable();
            $table->string('name');
            $table->integer('sort')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });



        Schema::table('users', function (Blueprint $table) {
            $table->text('phone')->nullable();
            $table->text('fname')->nullable();
            $table->text('sname')->nullable();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('headers');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('fname');
            $table->dropColumn('sname');
        });
    }
}

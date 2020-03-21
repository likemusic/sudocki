<?php

use App\Contracts\Model\Product\Table\ColumnNameInterface as ColumnNameEnum;
use App\Contracts\Model\Product\Table\TableNameInterface as EntityTableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePriceColumnInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            $table->renameColumn('price', ColumnNameEnum::PRICE_1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            $table->renameColumn(ColumnNameEnum::PRICE_1, 'price');
        });
    }
}

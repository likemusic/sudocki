<?php

use App\Contracts\Model\Product\Table\ColumnNameInterface as ColumnNameEnum;
use App\Contracts\Model\Product\Table\TableNameInterface as EntityTableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\Model\Product\Table\PriceColumnsParamsInterface;

class RenameAndFixFormatForPriceColumnInProductsTable extends Migration
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

        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            $table
                ->decimal(
                    ColumnNameEnum::PRICE_1,
                    PriceColumnsParamsInterface::TOTAL,
                    PriceColumnsParamsInterface::PLACES
                )
                ->nullable(false)
                ->change();
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

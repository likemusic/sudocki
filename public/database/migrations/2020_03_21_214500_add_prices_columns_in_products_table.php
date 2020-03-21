<?php

use App\Contracts\Model\Product\Table\PriceColumnsParamsInterface;
use App\Contracts\Model\Product\Table\TableNameInterface as EntityTableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricesColumnsInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            $prevColumnName = 'price_1';
            // 'price_1` already exists from renamed `price`
            for ($i = 2; $i < 5; $i++) {
                $columnName = "price_{$i}";
                $this->createPriceColumn($table, $columnName, $prevColumnName);
                $prevColumnName = $columnName;
            }
        });
    }

    private function createPriceColumn(Blueprint $table, string $columnName, string $prevColumnName)
    {
        $table
            ->decimal($columnName, PriceColumnsParamsInterface::TOTAL, PriceColumnsParamsInterface::PLACES)
            ->after($prevColumnName);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            for ($i = 2; $i < 5; $i++) {
                $tableName = "price_{$i}";
                $table->dropColumn($tableName);
            }
        });
    }
}

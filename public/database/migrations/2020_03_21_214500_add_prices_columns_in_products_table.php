<?php

use App\Contracts\Model\Product\Table\PriceColumnsParamsInterface;
use App\Contracts\Model\Product\Table\TableNameInterface as EntityTableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddPricesColumnsInProductsTable extends Migration
{
    const MAX_PRICE_INDEX = 6;

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
            for ($i = 2; $i < self::MAX_PRICE_INDEX; $i++) {
                $columnName = "price_{$i}";
                $this->createPriceColumn($table, $columnName, $prevColumnName);
                $prevColumnName = $columnName;
            }
        });

        $this->updatePricesColumns();
    }

    private function updatePricesColumns()
    {
        $prevColumnName = 'price_1';

        for ($i = 2; $i < self::MAX_PRICE_INDEX; $i++) {
            $columnName = "price_{$i}";
            $this->updatePriceColumn($columnName, $prevColumnName);
            $prevColumnName = $columnName;
        }
    }

    private function updatePriceColumn(string $columnName, string $prevColumnName)
    {
        DB::table(EntityTableName::VALUE)
            ->update([$columnName => DB::raw("`{$prevColumnName}` - 1")]);
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
            for ($i = 2; $i < self::MAX_PRICE_INDEX; $i++) {
                $tableName = "price_{$i}";
                $table->dropColumn($tableName);
            }
        });
    }
}

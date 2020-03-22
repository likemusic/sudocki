<?php

use App\Contracts\Model\Product\Table\TableNameInterface as EntityTableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Contracts\Model\Product\Table\ColumnNameInterface as ColumnNameEnum;

class ProductsTableActualizeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            $this->addColumns($table);
            $this->dropColumns($table);
        });
    }

    private function addColumns(Blueprint $table)
    {
        $table->string(ColumnNameEnum::UUID, 36)->nullable()->default(null)->unique();
        $table->string(ColumnNameEnum::BARCODE, 13)->nullable()->default(null)->unique();
        $table->string(ColumnNameEnum::UNIT_NAME)->nullable()->default(null);
        $table->float(ColumnNameEnum::WEIGHT, 8, 3)->nullable()->default(null);
    }

    private function dropColumns(Blueprint $table)
    {
        $deletedColumnsNames = [
            'type',
            'application',
            'material',
            'form',
            'color',
            'length',
            'width',
            'height',
            'manufacturer',
            'country',
            'cap',
            'temp',
        ];

        $this->deleteColumns($table, $deletedColumnsNames);
    }

    private function deleteColumns(Blueprint $table, array $columnsNames)
    {
        foreach ($columnsNames as $columnName) {
            $table->dropColumn($columnName);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            $deletedColumnsNames = [
                ColumnNameEnum::UUID,
                ColumnNameEnum::BARCODE,
                ColumnNameEnum::UNIT_NAME,
                ColumnNameEnum::WEIGHT,
            ];

            $this->deleteColumns($table, $deletedColumnsNames);
        });

        //todo: create deleted columns
    }
}

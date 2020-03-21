<?php

use App\Contracts\Model\User\Table\ColumnNameInterface;
use App\Contracts\Model\User\Table\TableNameInterface as EntityTableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\CustomerGroup\IdInterface as CustomerGroupIdEnum;

class AddCustomerGroupIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            $table->unsignedSmallInteger(ColumnNameInterface::CUSTOMER_GROUP_ID)
                ->default(CustomerGroupIdEnum::GROUP_0);

            $table->index(ColumnNameInterface::CUSTOMER_GROUP_ID);
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
            $table->dropColumn(ColumnNameInterface::CUSTOMER_GROUP_ID);
            // index will be dropped automatically
            // @see https://stackoverflow.com/questions/4341897/what-happens-if-i-drop-a-mysql-column-without-dropping-its-index-first
        });
    }
}

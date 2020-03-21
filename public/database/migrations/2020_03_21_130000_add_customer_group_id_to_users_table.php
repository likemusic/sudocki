<?php

use App\Contracts\CustomerGroup\IdInterface as CustomerGroupIdEnum;
use App\Contracts\Model\Role\RoleNamesInterface as RoleNamesEnum;
use App\Contracts\Model\Role\Table\ColumnNameInterface as RoleColumnNameEnum;
use App\Contracts\Model\User\Table\ColumnNameInterface as ColumnNameEnum;
use App\Contracts\Model\User\Table\TableNameInterface as EntityTableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use TCG\Voyager\Models\Role;

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
            $table->unsignedSmallInteger(ColumnNameEnum::CUSTOMER_GROUP_ID)->nullable();

            $table->index(ColumnNameEnum::CUSTOMER_GROUP_ID);
        });

        $this->updateCustomerGroupForCustomers();
    }

    private function updateCustomerGroupForCustomers()
    {
        $customerRoleId = $this->getCustomerRoleId();

        DB::table(EntityTableName::VALUE)
            ->where([ColumnNameEnum::ROLE_ID => $customerRoleId])
            ->update([ColumnNameEnum::CUSTOMER_GROUP_ID => CustomerGroupIdEnum::GROUP_1]);
    }

    private function getCustomerRoleId(): int
    {
        $role = $this->getRoleByName(RoleNamesEnum::USER);

        return $role->id;
    }

    private function getRoleByName(string $roleName): Role
    {
        return Role::firstWhere(RoleColumnNameEnum::NAME, $roleName);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(EntityTableName::VALUE, function (Blueprint $table) {
            $table->dropColumn(ColumnNameEnum::CUSTOMER_GROUP_ID);
            // index will be dropped automatically
            // @see https://stackoverflow.com/questions/4341897/what-happens-if-i-drop-a-mysql-column-without-dropping-its-index-first
        });
    }
}

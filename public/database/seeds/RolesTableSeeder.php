<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use App\Contracts\Model\Role\RoleNamesInterface as RoleNamesEnum;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => RoleNamesEnum::ADMIN]);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => __('voyager::seeders.roles.admin'),
                ])->save();
        }

        $role = Role::firstOrNew(['name' => RoleNamesEnum::USER]);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => __('voyager::seeders.roles.user'),
                ])->save();
        }
    }
}

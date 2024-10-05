<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'No Permissions',

            'list-role',
            'create-role',
            'show-role',
            'edit-role',
            'delete-role',

            'list-post',
            'create-post',
            'show-post',
            'edit-post',
            'delete-post',

            'list-category',
            'create-category',
            'show-category',
            'edit-category',
            'delete-category',

            'list-superadmin',
            'create-superadmin',
            'show-superadmin',
            'edit-superadmin',
            'delete-superadmin',

            'list-admin',
            'create-admin',
            'show-admin',
            'edit-admin',
            'delete-admin',

            'list-editor',
            'create-editor',
            'show-editor',
            'edit-editor',
            'delete-editor',

            'list-user',
            'create-user',
            'show-user',
            'edit-user',
            'delete-user',
        ];

        foreach ($permissions as $permission) {
            $thePermission = Permission::firstOrCreate(['name' => $permission]);
        }
    }
}

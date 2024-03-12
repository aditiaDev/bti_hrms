<?php

namespace Database\Seeders;

use App\Models\Conf\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
          'role_name' => 'ADMIN',
          'isactive' => 1,
        ]);

        Role::create([
          'role_name' => 'DEPT MANAGER',
          'isactive' => 1,
        ]);

        Role::create([
          'role_name' => 'DEPT ADMIN STAFF',
          'isactive' => 1,
        ]);

        Role::create([
          'role_name' => 'DEPT ADMIN DIVISION',
          'isactive' => 1,
        ]);

        Role::create([
          'role_name' => 'HR',
          'isactive' => 1,
        ]);

        Role::create([
          'role_name' => 'PAYROLL',
          'isactive' => 1,
        ]);
    }
}

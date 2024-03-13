<?php

namespace Database\Seeders;

use App\Models\Master\Departemen;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Departemen::create([
      'dept_name' => 'ASSEMBLY',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'FINANCE',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'HARDWARE',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'HEAD OFFICE',
      'note' => '',
      'prefix' => 'HQR',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'HRGA',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'INJECTION',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'IT',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'LAB/TEST CENTER',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'MARKETING',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'PCBA',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'PROCUREMENT',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'PROJECT',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'QC',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'RND',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'PMC',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'HR',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'GA',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'PM',
      'note' => 'Project Management',
      'prefix' => '',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'MOTOR',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'METAL COATING',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);

    Departemen::create([
      'dept_name' => 'PLASTIC SPRAYING',
      'note' => '',
      'prefix' => 'INA',
      'isactive' => 1,
    ]);
  }
}

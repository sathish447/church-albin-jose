<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::unprepared("TRUNCATE roles");

        $permission = [
            1 => "Admin",
            2 => "Super Admin",
            3 => "Father",
        ];

        foreach ($permission as $name => $slug) {
          DB::table('roles')->insert([
              'name' => $slug,
              'guard_name' => 'web',
              'created_at' => now(),
              'updated_at' => now(),
          ]);
      }
    }
}

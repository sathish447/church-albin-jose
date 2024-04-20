<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::unprepared("TRUNCATE role");

        $permission = [
            1 => "Admin",
            2 => "Super Admin",
            3 => "Father",
        ];

        foreach ($permission as $k => $v) {
            DB::unprepared("INSERT INTO role VALUES({$k}, '{$v}' , 1, '2021-07-07 07:55:06', '2021-07-07 07:55:06', NULL)");
        }

        DB::unprepared("INSERT INTO role_permission VALUES(17, 11)");
        DB::unprepared("INSERT INTO role_permission VALUES(18, 26)");
    }
}

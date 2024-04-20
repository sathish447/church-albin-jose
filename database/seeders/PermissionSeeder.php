<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::unprepared("TRUNCATE permissions");

$permissions = [
    "Dashboard" => "dashboard",
    "Role" => "role",
    "Role Create" => "role_create",
    "Role Delete" => "role_delete",
    "Language" => "language",
    "Service" => "service",
    "Settings" => "settings",
    "User" => "user",
    "User Create" => "user_create",
    "User Notification" => "user_notification",
    "Billing" => "billing",          
    "Events" => "events",
    "Events Create" => "events_create",
    "Events Edit" => "events_edit",
    "Events Delete" => "events_delete",
];

foreach ($permissions as $name => $slug) {
    DB::table('permissions')->insert([
        'name' => $name,
        'slug' => $slug,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

    }
}

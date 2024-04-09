<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $users = [
            1 => ['Admin','admin@church.com',bcrypt('12345678')]
        ];

        foreach ($users as $k => $v) {

        	try{

                User::create([
                    'name' => $v[0],
                    'email' => $v[1],
                    'password' => $v[2],
                ]);

        	}catch (\Exception $e) {

        		dd($e);

			    return $e->getMessage();
			}

        }
        
    }
}

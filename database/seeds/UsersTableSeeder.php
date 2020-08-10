<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class UsersTableSeeder extends Seeder {
 
    public function run()
    {
        User::create([
            'name' 		 => 'Administrador',
            'username'   => 'admin',
            'email'      => 'admin@admin.com',
            'password'   =>  Hash::make('admin1234')
        ]);
    }

}
 
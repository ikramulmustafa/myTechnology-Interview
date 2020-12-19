<?php

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
       User::insert([
            ['name' => 'Admin',
                'email' => 'admin@admin.com',
                'role_id' => $roles->where('slug','admin')->first()->id,
                'password' => Hash::make('password'),
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ], ['name' => 'User',
                'email' => 'user@user.com',
                'role_id' => $roles->where('slug','user')->first()->id,
                'password' => Hash::make('password')
               ,'created_at'=>\Carbon\Carbon::now(),
               'updated_at'=>\Carbon\Carbon::now()
            ]
        ]);
    }
}

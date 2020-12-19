<?php

use App\Models\Role;
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
        Role::insert([
            ['name' => 'Admin', 'slug'=> 'admin','created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()],
            ['name' => 'User', 'slug'=> 'user','created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]
        ]);
    }
}

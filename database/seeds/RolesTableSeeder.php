<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
        ]);

        Role::create([
            'name' => 'Chairman',
        ]);

        Role::create([
            'name' => 'Director',
        ]);

        Role::create([
            'name' => 'Manager',
        ]);

        Role::create([
            'name' => 'Paymaster',
        ]);

        Role::create([
            'name' => 'Accountant',
        ]);

        Role::create([
            'name' => 'Cashier',
        ]);

        Role::create([
            'name' => 'Customer Service',
        ]);

        Role::create([
            'name' => 'Customer',
        ]);

        Role::create([
            'name' => 'Subscriber',
        ]);
    }
}

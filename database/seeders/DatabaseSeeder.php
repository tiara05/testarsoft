<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'      => 'admin',
                'username'  => 'admin@admin.com',
                'password'  => '12345',
            ]
        ];

        foreach ($user as $key => $value) {
            Admin::create($value);
        }
    }
}

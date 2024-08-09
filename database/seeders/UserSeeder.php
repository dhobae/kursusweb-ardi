<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // nama role
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $admin = User::create([
            'name' => 'Ridho Saputra',
            'email' => 'ridhosaputs2nd@gmail.com',
            'password' => Hash::make('admin')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Kujou Alya',
            'email' => 'ridhosaputs77@gmail.com',
            'password' => Hash::make('user')
        ]);

        $user->assignRole('user');
    }
}

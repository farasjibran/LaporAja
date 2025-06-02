<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@laporaja.com',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Government User',
                'email' => 'government@laporaja.com',
                'password' => 'password',
                'role' => 'goverment',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );

            $role = Roles::where('name', $userData['role'])->first();

            if ($role) {
                UserRoles::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'role_id' => $role->id,
                    ],
                    []
                );
            }
        }
    }
}

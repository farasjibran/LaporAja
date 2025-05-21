<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'goverment',
        ];

        foreach ($roles as $role) {
            Roles::create([
                'name' => $role,
            ]);
        }
    }
}

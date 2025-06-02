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
            ['name' => 'admin'],
            ['name' => 'goverment'],
        ];

        foreach ($roles as $roleData) {
            Roles::firstOrCreate(
                ['name' => $roleData['name']]
            );
        }
    }
}

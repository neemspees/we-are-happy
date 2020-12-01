<?php

namespace Database\Seeders;

use App\Constants\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            ['name' => 'Employee 1', 'email' => 'employee1@happy.test', 'password' => 'pass', 'api_token' => 'EMPLOYEE1_TEST_TOKEN', 'role' => Roles::EMPLOYEE],
            ['name' => 'Employee 2', 'email' => 'employee2@happy.test', 'password' => 'pass', 'api_token' => 'EMPLOYEE2_TEST_TOKEN', 'role' => Roles::EMPLOYEE],
            ['name' => 'Employee 3', 'email' => 'employee3@happy.test', 'password' => 'pass', 'api_token' => 'EMPLOYEE3_TEST_TOKEN', 'role' => Roles::EMPLOYEE],
            ['name' => 'Manager 1', 'email' => 'manager1@happy.test', 'password' => 'pass', 'api_token' => 'MANAGER1_TEST_TOKEN', 'role' => Roles::MANAGER],
            ['name' => 'Manager 2', 'email' => 'manager2@happy.test', 'password' => 'pass', 'api_token' => 'MANAGER1_TEST_TOKEN', 'role' => Roles::MANAGER]
        ];

        foreach ($users as $user) {
            $exists = User::query()->where('email', $user['email'])->exists();

            if ($exists) {
                continue;
            }

            /** @var User $newUser */
            $newUser = User::query()->create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'api_token' => hash('sha256', $user['api_token'])
            ]);

            $roleName = $user['role'];

            if (!$newUser->hasRole($roleName)) {
                $newUser->assignRole($roleName);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Constants\AccountTypePrefixConstants;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!empty(env('ADMIN_EMAIL'))){
            $user = User::updateOrCreate(
                ['email' => env('ADMIN_EMAIL')],
                [
                    'name' => env('ADMIN_NAME') ?? 'Admin',
                    'email' => env('ADMIN_EMAIL'),
                    'account_type' => AccountTypePrefixConstants::ADMIN,
                    'email_verified_at' => now(),
                    'password' => Hash::make(env('ADMIN_PASSWORD') ?? 'admin'),
                ]
            );
        }
    }
}

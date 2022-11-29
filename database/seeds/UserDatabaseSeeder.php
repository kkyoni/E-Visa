<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\User::create([
            'name' => 'Admin User',
            'email' => 'e-visa@admin.com',
            'mobile' => '8128273971',
            'password' => \Hash::make('demo@1234'),
            'role_id' => '1',
            'user_type' => 'superadmin',
            'passport' => '1234564566',
            'passport_issue_date' => \Carbon\Carbon::now()->toDateString(),
            'passport_expiry_date' => \Carbon\Carbon::now()->toDateString(),
            'wpmobile' => '8128273971',
            'status' => 'active',
        ]);

        User::create([
    		'name' => 'BO Level 1',
    		'email' => 'bolevel1@aistechnolabs.xyz',
    		'email_verified_at' => now(),
    		'role_id' => '3',
    		'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
    		'encrypt_password' => base64_encode('123456'),
    		'remember_token' => Str::random(10),
    		'user_type' => 'bo_user'
    		]);

    	User::create([
    		'name' => 'BO Level 2',
    		'email' => 'bolevel2@aistechnolabs.xyz',
    		'email_verified_at' => now(),
    		'role_id' => '4',
    		'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
    		'encrypt_password' => base64_encode('123456'),
    		'remember_token' => Str::random(10),
    		'user_type' => 'bo_user'
    		]);

    	User::create([
    		'name' => 'BO Level 3',
    		'email' => 'bolevel3@aistechnolabs.xyz',
    		'email_verified_at' => now(),
    		'role_id' => '5',
    		'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
    		'encrypt_password' => base64_encode('123456'),
    		'remember_token' => Str::random(10),
    		'user_type' => 'bo_user'
    		]);
        
        User::create([
            'name' => 'BO Level 4',
            'email' => 'bolevel4@aistechnolabs.xyz',
            'email_verified_at' => now(),
            'role_id' => '6',
            'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
            'encrypt_password' => base64_encode('123456'),
            'remember_token' => Str::random(10),
            'user_type' => 'bo_user'
            ]);

        User::create([
            'name' => 'BO Level 5',
            'email' => 'bolevel5@aistechnolabs.xyz',
            'email_verified_at' => now(),
            'role_id' => '7',
            'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
            'encrypt_password' => base64_encode('123456'),
            'remember_token' => Str::random(10),
            'user_type' => 'bo_user'
            ]);

        User::create([
            'name' => 'BO Level 6',
            'email' => 'bolevel6@aistechnolabs.xyz',
            'email_verified_at' => now(),
            'role_id' => '8',
            'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
            'encrypt_password' => base64_encode('123456'),
            'remember_token' => Str::random(10),
            'user_type' => 'bo_user'
            ]);
        
        User::create([
            'name' => 'BO Level 7',
            'email' => 'bolevel7@aistechnolabs.xyz',
            'email_verified_at' => now(),
            'role_id' => '9',
            'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
            'encrypt_password' => base64_encode('123456'),
            'remember_token' => Str::random(10),
            'user_type' => 'bo_user'
            ]);

        User::create([
            'name' => 'BO Level 8',
            'email' => 'bolevel8@aistechnolabs.xyz',
            'email_verified_at' => now(),
            'role_id' => '10',
            'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
            'encrypt_password' => base64_encode('123456'),
            'remember_token' => Str::random(10),
            'user_type' => 'bo_user'
            ]);

        User::create([
            'name' => 'BO Level 9',
            'email' => 'bolevel9@aistechnolabs.xyz',
            'email_verified_at' => now(),
            'role_id' => '11',
            'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
            'encrypt_password' => base64_encode('123456'),
            'remember_token' => Str::random(10),
            'user_type' => 'bo_user'
            ]);

        User::create([
            'name' => 'BO Level 10',
            'email' => 'bolevel10@aistechnolabs.xyz',
            'email_verified_at' => now(),
            'role_id' => '12',
            'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
            'encrypt_password' => base64_encode('123456'),
            'remember_token' => Str::random(10),
            'user_type' => 'bo_user'
            ]);
    }
}

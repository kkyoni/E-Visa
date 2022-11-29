<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsTableSeeder::class);
        $this->call(CmsTableSeeder::class);
        $this->call(EmailTemplateTableSeeder::class);
        $permissions = $this->defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms['name'],'module_name'=>$perms['module_name']]);
        }

        $this->command->info('Default Permissions added.');

        $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);

        if( $role->name == 'admin' ) {
            $this->createUser($role);
            $role->syncPermissions(Permission::all());
            $this->command->info('Admin granted all the permissions');
        }

        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'back Office 1']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'back Office 2']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'back Office 3']);
        $this->command->info('Added only default user role.');

        $this->command->info('Data seeded.');
        $this->command->warn('All done :)');
        $this->call(PermissionTableSeeder::class);
        $this->call(UserDatabaseSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(CountryTableSeeder::class);
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {
        $user = factory(\App\User::class)->create();
        $user->assignRole($role->name);

        if( $role->name == 'Admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "123456"');
        }
    }

    private function defaultPermissions(){
        return [

            ['name'=>'user-list','module_name'=>'User Management'],
            ['name'=>'user-create','module_name'=>'User Management'],
            ['name'=>'user-edit','module_name'=>'User Management'],
            ['name'=>'user-delete','module_name'=>'User Management'],


            ['name'=>'emb-list','module_name'=>'Embassy Management'],
            ['name'=>'emb-create','module_name'=>'Embassy Management'],
            ['name'=>'emb-edit','module_name'=>'Embassy Management'],
            ['name'=>'emb-delete','module_name'=>'Embassy Management'],


            ['name'=>'visa-list','module_name'=>'Visa Management'],
            ['name'=>'visa-create','module_name'=>'Visa Management'],
            ['name'=>'visa-edit','module_name'=>'Visa Management'],
            ['name'=>'visa-delete','module_name'=>'Visa Management'],

            ['name'=>'visatype-list','module_name'=>'VisaType Management'],
            ['name'=>'visatype-create','module_name'=>'VisaType Management'],
            ['name'=>'visatype-edit','module_name'=>'VisaType Management'],
            ['name'=>'visatype-delete','module_name'=>'VisaType Management'],


            ['name'=>'country-list','module_name'=>'Country Management'],
            ['name'=>'country-create','module_name'=>'Country Management'],
            ['name'=>'country-edit','module_name'=>'Country Management'],
            ['name'=>'country-delete','module_name'=>'Country Management'],



            ['name'=>'role-list','module_name'=>'Role Management'],
            // ['name'=>'role-create','module_name'=>'Role Management'],
            ['name'=>'role-edit','module_name'=>'Role Management'],
            // ['name'=>'role-delete','module_name'=>'Role Management'],



            ['name'=>'countrywisevisa-list','module_name'=>'Country Wise Visa Management'],
            ['name'=>'countrywisevisa-create','module_name'=>'Country Wise Visa Management'],
            ['name'=>'countrywisevisa-edit','module_name'=>'Country Wise Visa Management'],
            ['name'=>'countrywisevisa-delete','module_name'=>'Country Wise Visa Management'],



            ['name'=>'price-list','module_name'=>'Price Management'],
            ['name'=>'price-create','module_name'=>'Price Management'],
            ['name'=>'price-edit','module_name'=>'Price Management'],
            ['name'=>'price-delete','module_name'=>'Price Management'],



            ['name'=>'referral-list','module_name'=>'Referral Management'],
            // ['name'=>'referral-create','module_name'=>'Referral Management'],
            // ['name'=>'referral-edit','module_name'=>'Referral Management'],
            // ['name'=>'referral-delete','module_name'=>'Referral Management'],

            ['name'=>'question-list','module_name'=>'Question Management'],
            ['name'=>'question-create','module_name'=>'Question Management'],
            ['name'=>'question-edit','module_name'=>'Question Management'],
            ['name'=>'question-delete','module_name'=>'Question Management'],


            ['name'=>'email-template-list','module_name'=>'Email Templates'],
            // ['name'=>'email-template-create','module_name'=>'Email Templates'],
            ['name'=>'email-template-edit','module_name'=>'Email Templates'],
            // ['name'=>'email-template-delete','module_name'=>'Email Templates'],


            ['name'=>'transaction-list','module_name'=>'Report Management'],


            ['name'=>'cms-list','module_name'=>'Cms Management'],
            // ['name'=>'cms-create','module_name'=>'Cms Management'],
            ['name'=>'cms-edit','module_name'=>'Cms Management'],
            // ['name'=>'cms-delete','module_name'=>'Cms Management'],

            ['name'=>'faq-list','module_name'=>'Faq'],
            ['name'=>'faq-create','module_name'=>'Faq'],
            ['name'=>'faq-edit','module_name'=>'Faq'],
            ['name'=>'faq-delete','module_name'=>'Faq'],



            ['name'=>'setting-list','module_name'=>'Setting Management'],
            // ['name'=>'setting-create','module_name'=>'Setting Management'],
            ['name'=>'setting-edit','module_name'=>'Setting Management'],
            // ['name'=>'setting-delete','module_name'=>'Setting Management'],

            // ['name'=>'script-list','module_name'=>'Script Management'],
            // ['name'=>'script-create','module_name'=>'Script Management'],
            ['name'=>'script-edit','module_name'=>'Script Management'],
            //  ['name'=>'script-delete','module_name'=>'Script Management'],

            ['name'=>'blog-list','module_name'=>'Blog Management'],
            ['name'=>'blog-create','module_name'=>'Blog Management'],
            ['name'=>'blog-edit','module_name'=>'Blog Management'],
            ['name'=>'blog-delete','module_name'=>'Blog Management'],
        ];
    }
}

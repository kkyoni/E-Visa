<?php

use Illuminate\Database\Seeder;
use App\Cms;

class CmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cms::create([
            'slug'	       	=>  str_slug('popular_destinations'),
            'title'	    	=>  'Popular Destinations',
            'description'	=>  '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'status'		=>  'active',
            ]);
        Cms::create([
            'slug'	   	    =>  str_slug('about_us'),
            'title'	    	=>  'About us',
            'description'	=>  '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'status'		=>  'active',
            ]);
        Cms::create([
            'slug'	     	=>  str_slug('privacy_policy'),
            'title'	    	=>  'Privacy Policy',
            'description'	=>  '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'status'		=>  'active',
            ]);
        Cms::create([
            'slug'	   	    =>  str_slug('payment_terms'),
            'title'	    	=>  'Payment Terms',
            'description'	=>  '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'status'		=>  'active',
            ]);
        Cms::create([
            'slug'	     	=>  str_slug('terms_condition'),
            'title'	    	=>  'Terms and condition',
            'description'	=>  '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'status'		=>  'active',
            ]);

        \App\SiteSetting::create([ 'meta_key' => 'site_maintenance', 'meta_value' => '0' ]);
        
        \App\VisaType::create([ 'visa_type' => 'On Arrival Visa', 'status' => 'active' ]);
        \App\VisaType::create([ 'visa_type' => 'Business Visa', 'status' => 'active' ]);
        \App\VisaType::create([ 'visa_type' => 'Tourist Visa', 'status' => 'active' ]);
        \App\VisaType::create([ 'visa_type' => 'Student Visa', 'status' => 'active' ]);

        \App\VisaTypeEntry::create([ 'visa_type_entry' => 'Single', 'status' => 'active' ]);
        \App\VisaTypeEntry::create([ 'visa_type_entry' => 'Double', 'status' => 'active' ]);
        \App\VisaTypeEntry::create([ 'visa_type_entry' => 'Multiple', 'status' => 'active' ]);

        \App\EmailTemplates::create(['title' => 'Marketing PDF attached','description' => '<p>Marketing PDF attached</p>','status' => 'active',]);
        \App\EmailTemplates::create(['title' =>  'Social Share link','description' => '<p>Social Share link</p>','status' => 'active',]);
        \App\EmailTemplates::create(['title' =>  'Order Status - Approved','description' => '<p>Order Status - Approved</p>','status' => 'active',]);
        \App\EmailTemplates::create(['title' =>  'Order Status - Rejected','description' => '<p>Order Status - Rejected</p>','status' => 'active',]);
        \App\EmailTemplates::create(['title' =>  'Complete Payment','description' => '<p>Complete Payment</p>','status'		=>  'active',]);

        \App\Script::create([
            'header_script' => 'Lorem Ipsum',
            'body_script' => 'Lorem Ipsum',
            'footer_script' => 'Lorem Ipsum',
            ]);
    }
}

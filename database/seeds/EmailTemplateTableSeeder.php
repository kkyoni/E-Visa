<?php

use Illuminate\Database\Seeder;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\EmailTemplates::create([
            'slug'         =>  'marketing_pdf_attached',
            'title'	    	=>  'Marketing PDF attached',
            'description'	=>  '<p>Marketing PDF attached</p>',
            'status'		=>  'active',
            ]);

        \App\EmailTemplates::create([
            'slug'         =>  'social_share_link',
            'title'	    	=>  'Social Share link',
            'description'	=>  '<p>Social Share link</p>',
            'status'		=>  'active',
            ]);
        \App\EmailTemplates::create([
            'slug'         =>  'complete_payment',
            'title'	    	=>  'Complete Payment',
            'description'	=>  '<p>Complete Payment</p>',
            'status'		=>  'active',
            ]);
        \App\EmailTemplates::create([
            'slug'         =>  'order_status_reject',
            'title'	    	=>  'Order status - Reject',
            'description'	=>  '<p>Order status - Reject</p>',
            'status'		=>  'active',
            ]);
        \App\EmailTemplates::create([
            'slug'         =>  'order_status_approved',
            'title'	    	=>  'Order status - Approved',
            'description'	=>  '<p>Order status - Approved</p>',
            'status'		=>  'active',
            ]);
        \App\EmailTemplates::create([
            'slug'	    	=>  'order_status_pending',
            'title'         =>  'Order status - Pending',
            'description'	=>  '<p>Order status - Pending</p>',
            'status'		=>  'active',
            ]);
        \App\EmailTemplates::create([
            'slug'         =>  'informative_links',
            'title'	    	=>  'Informative Links',
            'description'	=>  '<p>Informative Links</p>',
            'status'		=>  'active',
            ]);
    }
}

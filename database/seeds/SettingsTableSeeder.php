<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'code'   => 'site_logo',
            'type'   => 'FILE',
            'label'  => 'Site Logo',
            'value'  => 'site_logo.png',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'project_title',
            'type'   => 'TEXT',
            'label'  => 'Project Title',
            'value'  => 'URGENT E-VISA',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'favicon_logo',
            'type'   => 'FILE',
            'label'  => 'favicon Logo',
            'value'  => 'favicon_logo.jpg',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'fb_link',
            'type'   => 'TEXT',
            'label'  => 'Facebook Link',
            'value'  => 'https://www.Facebook.com/',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'twitter_link',
            'type'   => 'TEXT',
            'label'  => 'Twitter Link',
            'value'  => 'https://www.Twitter.com/',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'instagram_link',
            'type'   => 'TEXT',
            'label'  => 'Instagram Link',
            'value'  => 'https://www.Instagram.com/',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'linkedin_link',
            'type'   => 'TEXT',
            'label'  => 'Linkedin Link',
            'value'  => 'https://www.Linkedin.com/',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'address',
            'type'   => 'TEXT',
            'label'  => 'address',
            'value'  => '1600, Pennsylvania Ave NW, Washington, USA',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'whatsapp_number',
            'type'   => 'NUMBER',
            'label'  => 'whatsapp_number',
            'value'  => '9714568465',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'footer_text',
            'type'   => 'TEXT',
            'label'  => 'footer_text',
            'value'  => 'Urgentevisa.com. All rights reserved. Urgentevisa and Urgentevisa logo are registered trademarks of Urgentevisa.com.',
            'hidden' => '0'
            ]);

        \App\Setting::create([
            'code'   => 'slider_logo',
            'type'   => 'FILE',
            'label'  => 'Slider Logo',
            'value'  => 'slider_logo.png',
            'hidden' => '0'
            ]);

    }
}


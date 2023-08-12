<?php

namespace Tests\Feature;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminSettingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_store_setting(){
        $data = [
            'website_name' => 'smart bd LTd',
            'website_email' => 'website@mail.com',
            'website_email_2' => 'website_email_2@gmail.com',
            'website_phone' => '01344566', 
            'phone_2' => '01344566',
            'phone' => '01344566',
        ];
        $response = $this->call('POST','/api/admin/setting/store',$data);

        $response->assertStatus(200);
    }

    public function test_admin_update_setting(){
        $id  = Setting::first()->id;
        $data = [
            'website_name' => 'smart bd LTd update',
            'website_email' => 'website@mail.com',
            'website_email_2' => 'website_email_2@gmail.com',
            'website_phone' => '01344566', 
            'phone_2' => '01344566',
            'phone' => '01344566',
        ];

        $setting = $this->call('PUT','/api/admin/setting/update/'. $id, $data);
        $setting->assertStatus(200);
    }
}

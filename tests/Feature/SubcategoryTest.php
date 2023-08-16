<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubcategoryTest extends TestCase
{
    
    public function test_it_can_create_a_subcategory(){
        $data = [
            'subcategory_title' => 'test',
            'category_ids' => [1,4,5],
        ];

        $response = $this->call('POST','/api/admin/subcategories/store',$data);

        // $this->assertEquals(201,$response->getStatusCode());
        dd($response->getContent());
    }
}

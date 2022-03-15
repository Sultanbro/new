<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostTest extends TestCase
{

    /**
     * @test
     */
    public function index_test()
    {
        $response = $this->get('api/post');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store_test()
    {
        $response = $this->post('api/post', [
            'name' => 'post_n',
            'description' => 'post_d',
            'text' => 'post_t',
            'date' => '2022-02-01',
            'active' => 1,
            'image' => null,
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment(['name' => 'post_n',
            'description' => 'post_d',
            'text' => 'post_t',
            'date' => '2022-02-01',
            'active' => 1,
            'image' => null,]);

        $del = $this->delete('api/post/' . $response->json()['data']['id']);
        $del->assertStatus(200);
    }
}

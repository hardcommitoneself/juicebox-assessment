<?php

namespace Tests\Unit\Post;

use App\Models\User;
use Tests\TestCase;

class PostAllControllerTest extends TestCase
{
    /**
     * PostAll api should return 401 unauthorized error without access token.
     */
    public function testPostAllApiReturnsUnauthenticatedErrorWithoutAccessToken(): void
    {
        $this->json('get', 'api/posts')
            ->assertStatus(401);
    }

    /**
     * PostAll api should return valid json format.
     */
    public function testPostAllApiReturnsValidJsonFormat(): void
    {
        $user = User::first();

        $this->actingAs($user);

        $this->json('get', 'api/posts')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'description',
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active',
                        ],
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }
}

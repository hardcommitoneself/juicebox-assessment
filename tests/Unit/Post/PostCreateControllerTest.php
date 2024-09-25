<?php

namespace Tests\Unit\Post;

use App\Models\User;
use Tests\TestCase;

class PostCreateControllerTest extends TestCase
{
    /**
     * PostCreate api should return 401 unauthorized error without access token.
     */
    public function testPostCreateApiReturnsUnauthenticatedErrorWithoutAccessToken(): void
    {
        $this->json('post', 'api/posts')
            ->assertStatus(401);
    }

    /**
     * PostCreate api should return 400 validation error with missed payload
     */
    public function testPostCreateApiReturnValidationErrorWithMissedPayload(): void
    {
        $user = User::first();

        $this->actingAs($user);

        $payload = [
            'title' => 'Test Post',
        ];

        $this->json('post', 'api/posts', $payload)
            ->assertStatus(401);
    }

    /**
     * PostCreate api should be working fine in the other cases
     */
    public function testPostCreateApiShouldBeOk(): void
    {
        $user = User::first();

        $this->actingAs($user);

        $payload = [
            'title' => 'Test Post',
            'description' => 'Test Description',
        ];

        $this->json('post', 'api/posts', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                ],
            ]);
    }
}

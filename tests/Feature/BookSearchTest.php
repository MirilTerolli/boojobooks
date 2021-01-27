<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BookSearchTest extends TestCase
{
    use DatabaseTransactions, HasFactory;

    /**
     * @test
     */
    public function it_redirects_unauthenticated_users()
    {
        $this->get('/api/search-book/remax')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_fails_on_empty_input()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/api/search-book/ ')
            ->assertStatus(400)
            ->assertJson(['success' => false, 'items' => []]);
    }

    /**
     * @test
     */
    public function it_searches_for_a_given_book()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get('/api/search-book/re/max')
            ->assertStatus(200)
            ->assertSee('success')
            ->assertJson(['success' => true])
            ->assertJsonCount(10, 'items')
            ->assertSeeText('RE\/MAX');
    }
}

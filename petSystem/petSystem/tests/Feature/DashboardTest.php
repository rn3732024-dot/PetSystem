<?php

namespace Tests\Feature;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_see_current_pet_dashboard_totals(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        Pet::create(['pet_id' => 'PET-001', 'name' => 'Bantay', 'species' => 'Dog', 'status' => 'available']);
        Pet::create(['pet_id' => 'PET-002', 'name' => 'Muning', 'species' => 'Cat', 'status' => 'adopted']);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSeeText('Total Registered Pets');
        $response->assertSeeText('2');
        $response->assertSeeText('Bantay');
        $response->assertSeeText('Muning');
    }

    public function test_dashboard_includes_a_profile_link(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee(route('profile.edit'), false);
    }

    public function test_an_authenticated_user_can_add_a_pet_from_the_dashboard_form(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->post(route('pets.store'), [
            'pet_id' => 'PET-003',
            'name' => 'Snowy',
            'species' => 'Rabbit',
            'status' => 'available',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('pets', [
            'pet_id' => 'PET-003',
            'name' => 'Snowy',
            'species' => 'Rabbit',
            'status' => 'available',
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_can_see_current_pet_dashboard_totals(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        Pet::create(['pet_id' => 'PET-001', 'name' => 'Bantay', 'species' => 'Dog', 'status' => 'available']);
        Pet::create(['pet_id' => 'PET-002', 'name' => 'Muning', 'species' => 'Cat', 'status' => 'adopted']);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSeeText('Total Registered Pets');
        $response->assertSeeText('2');
        $response->assertSeeText('Bantay');
        $response->assertSeeText('Muning');
    }

    public function test_non_admins_are_redirected_away_from_the_dashboard(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertRedirect(route('profile.edit'));
    }

    public function test_an_admin_can_add_a_pet_from_the_dashboard_form(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('pets.store'), [
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

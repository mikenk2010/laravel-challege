<?php

namespace Tests\Feature\Backend\Loan;

use App\Domains\Auth\Models\Loan;
use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_approve_loan_page()
    {
        $this->loginAsAdmin();

        $this->get('/admin/auth/loan')->assertOk();
    }

    /** @test */
    public function an_admin_can_approve_loan()
    {
        $this->loginAsAdmin();

        // Create User
        $user = factory(User::class)->create([
            'name' => 'Bao Bao',
        ]);

        $amount = 1000;
        $term = 2;

        // Create loan
        $loan = factory(Loan::class)->create([
            'user_id' => $user->id,
            'amount' => $amount,
            'term' => $term,
            'status' => 0,
        ]);

        $this->get("/admin/auth/loan/view/{$loan->id}")->assertOk();

        // Update
        $loan->status = 1;
        $loan->save();

        $this->assertDatabaseHas('loans', [
            'id' => $loan->id,
            'user_id' => $user->id,
            'amount' => 1000,
            'status' => 1,
        ]);
    }
}

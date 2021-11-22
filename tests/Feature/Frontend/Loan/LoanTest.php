<?php

namespace Tests\Feature\Frontend\Loan;

use App\Domains\Auth\Models\Loan;
use App\Domains\Auth\Models\LoanTransactions;
use App\Domains\Auth\Models\User;
use Tests\TestCase;

class LoanTest extends TestCase
{
    /** @test */
    public function only_authenticated_users_can_access_loan_page()
    {
        $this->get('/loan')->assertRedirect('/login');

        $this->actingAs(factory(User::class)->state('user')->create());

        $this->get('/loan')->assertOk();
    }

    /** @test */
    public function only_authenticated_users_can_access_apply_loan_page()
    {
        $this->get('/loan/apply')->assertRedirect('/login');

        $this->actingAs(factory(User::class)->state('user')->create());

        $this->get('/loan/apply')->assertOk();
    }

    /** @test */
    public function a_user_can_apply_loan()
    {
        $user = factory(User::class)->create([
            'name' => 'Bao Bao',
        ]);

        $amount = 1000;
        $term = 2;
        $loan = factory(Loan::class)->create([
            'user_id' => $user->id,
            'amount' => $amount,
            'term' => $term,
            'status' => 0,
        ]);

        $this->assertDatabaseHas('loans', [
            'id' => $loan->id,
            'user_id' => $user->id,
            'amount' => 1000,
            'term' => 2,
        ]);


        $total_transaction = (int) $term * 4; // Weekly
        // @Todo, round 1st to n-1 term, and sum the last
        $amountTerm = (float) $amount / $total_transaction;
        // Calculate due date
        $current_date = date('Y-m-d');

        for ($i = 0; $i < $total_transaction; $i++) {
            $date = ($i + 1) * 7;
            $due_date = date('Y-m-d', strtotime($current_date . "+{$date} days"));

            $loanTransaction = factory(LoanTransactions::class)->create([
                'loan_id' => $loan->id,
                'amount' => $amountTerm,
                'remain' => 0,
                'status' => 1,
                'due_date' => $due_date,
            ]);

            $this->assertDatabaseHas('loan_transaction', [
                'id' => $loanTransaction->id,
                'loan_id' => $loan->id,
            ]);
        }
    }
}

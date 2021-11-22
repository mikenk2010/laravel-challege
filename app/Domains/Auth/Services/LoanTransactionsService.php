<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\Loan;
use App\Domains\Auth\Models\LoanTransactions;
use App\Domains\Auth\Models\User;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class LoanTransactionsService.
 */
class LoanTransactionsService extends BaseService
{
    /**
     * LoanTransactionsService constructor.
     *
     * @param LoanTransactions loanTransactions
     */

    /**
     * The repository model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $user;

    /**
     * @var \App\Domains\Auth\Models\LoanTransactions
     */
    private $loanTransactions;
    /**
     * @var \App\Domains\Auth\Models\Loan
     */
    private $loan;


    public function __construct(Loan $loan, User $user, LoanTransactions $loanTransactions)
    {
        $this->model = $loanTransactions;
        $this->user = $user;
        $this->loan = $loan;
    }


    public function getTransactionById($id)
    {
        return $this->model::where('id', $id)->first();
    }

    /**
     * @param array $data
     *
     * @return LoanTransactions
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Loan
    {
        DB::beginTransaction();

        try {
            $loan = $this->updateLoanTransaction($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this loan. Please try again.'));
        }

        // Add Event here

        DB::commit();

        return $loan;
    }

    protected function updateLoanTransaction(array $data = []): Loan
    {
        // 1. Update Loan Transaction
        $loanTransaction = $this->getTransactionById($data['transaction_id']);
        $loanTransaction->status = 2; // Paid
        $loanTransaction->save();

        // 2. Update Loan parent, to mark it on progress paying
        $loan = $this->loan::where('id', $data['loan_id'])->first();
        $loan->status = 2; // On-going
        $loan->save();

        return $loan;
    }

}

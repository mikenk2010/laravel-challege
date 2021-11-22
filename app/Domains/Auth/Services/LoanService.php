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
 * Class LoanService.
 */
class LoanService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param Loan $loan
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


    public function __construct(Loan $loan, User $user, LoanTransactions $loanTransactions)
    {
        $this->model = $loan;
        $this->user = $user;
        $this->loanTransactions = $loanTransactions;
    }

    /**
     * @param $type
     * @param bool|int $perPage
     *
     * @return mixed
     */
    public function getByType($type, $perPage = false)
    {
        if (is_numeric($perPage)) {
            return $this->user::byType($type)->paginate($perPage);
        }

        return $this->user::byType($type)->get();
    }

    public function getLoan()
    {
        return $this->model::where('user_id', auth()->id())->orderBy('id')->get();
    }

    public function getCurrentTransactions($loan_id)
    {
        return $this->loanTransactions::where('loan_id', $loan_id)
            ->orderBy('id')->get();
    }

    /**
     * @param array $data
     *
     * @return Loan
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Loan
    {
        DB::beginTransaction();

        try {
            $loan = $this->createLoan($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this loan. Please try again.'));
        }

        // @Todo Add Event here

        DB::commit();

        return $loan;
    }

    public function approve(array $data = []): Loan
    {
        DB::beginTransaction();

        try {
            $loan = $this->approveLoan($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this loan. Please try again.'));
        }

        // @Todo Add Event here

        DB::commit();

        return $loan;

    }

    protected function approveLoan(array $data = []): Loan
    {
        // 2. Update Loan parent, to mark it on progress paying
        $loan = $this->model::where('id', $data['loan_id'])->first();
        $loan->status = 1; // Approved
        $loan->save();

        return $loan;
    }

    /**
     * @param array $data
     *
     * @return Loan
     */
    protected function createLoan(array $data = []): Loan
    {
        // 1. Create Loan
        $loan = $this->model::create([
            'user_id' => auth()->id(),
            'amount' => $data['amount'],
            'term' => $data['term'],
            'status' => 0,
        ]);

        $total_transaction = (int) $data['term'] * 4; // Weekly

        // @Todo, round 1st to n-1 term, and sum the last
        $amount = (float) $data['amount'] / $total_transaction;

        // Calculate due date
        $current_date = date('Y-m-d');

        for ($i = 0; $i < $total_transaction; $i++) {
            $date = ($i + 1) * 7;
            $due_date = date('Y-m-d', strtotime($current_date . "+{$date} days"));

            $this->loanTransactions::create([
                'loan_id' => $loan->id,
                'amount' => $amount,
                'remain' => 0,
                'status' => 1,
                'due_date' => $due_date,
            ]);
        }

        // 2. Create Transactions
        return $loan;
    }
}

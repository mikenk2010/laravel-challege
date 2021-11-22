<?php

namespace App\Http\Controllers\Frontend\User;

use App\Domains\Auth\Http\Requests\Frontend\User\StoreLoanRequest;
use App\Domains\Auth\Http\Requests\Frontend\User\StoreLoanTransactionRequest;
use App\Domains\Auth\Models\Loan;
use App\Domains\Auth\Services\LoanService;
use App\Domains\Auth\Services\LoanTransactionsService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccountController.
 */
class LoanController extends Controller
{
    /**
     * @var \App\Domains\Auth\Services\LoanService
     */
    private $loanService;

    /**
     * @var \App\Http\Controllers\Frontend\User\LoanTransactionsService
     */
    private $loanTransactionsService;

    /**
     * UserController constructor.
     * @param \App\Domains\Auth\Services\LoanService $loanService
     * @param \App\Domains\Auth\Services\LoanTransactionsService $loanTransactionsService
     */
    public function __construct(LoanService $loanService, LoanTransactionsService $loanTransactionsService)
    {
        $this->loanService = $loanService;
        $this->loanTransactionsService = $loanTransactionsService;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('frontend.user.loan.index');
    }

    public function show(Loan $loan)
    {
        $loans = $this->loanService->getCurrentTransactions($loan->id);

        return view('frontend.user.loan.current', ['loans' => $loans, 'loan' => $loan]);
    }

    public function preview(Loan $loan, $transaction_id)
    {
        $transaction = $this->loanTransactionsService->getTransactionById($transaction_id);

        return view('frontend.user.loan.preview', ['loan' => $loan, 'transaction' => $transaction]);
    }

    public function apply()
    {
        return view('frontend.user.loan.apply');
    }

    public function store(StoreLoanRequest $request)
    {
        $this->loanService->store($request->validated());

        return redirect()->route('frontend.user.loan', ['#success'])->withFlashSuccess(__('Congrats!. Your loan have been sent to us, please wait for approval.'));
    }

    public function repay(StoreLoanTransactionRequest $request)
    {
        $loan = $this->loanTransactionsService->store($request->validated());

        return redirect()->route('frontend.user.loan.show', $loan)->withFlashSuccess(__("Congrats!. You have paid on time!"));
    }

}

<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Loan;

use App\Domains\Auth\Http\Requests\Backend\Role\UpdateLoanRequest;
use App\Domains\Auth\Models\Loan;
use App\Domains\Auth\Services\LoanService;
use App\Http\Controllers\Controller;

/**
 * Class LoanController.
 */
class LoanController extends Controller
{
    /**
     * @var \App\Domains\Auth\Services\LoanService
     */
    private $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.loan.index');
    }

    public function show(Loan $loan)
    {
        return view('backend.auth.loan.approve', ['loan' => $loan]);
    }

    public function approve()
    {
        return view('backend.auth.loan.approve');
    }

    public function update(UpdateLoanRequest $request)
    {
        $this->loanService->approve($request->validated());

        return redirect()->route('admin.auth.loan.index')->withFlashSuccess(__('The loan was successfully approved.'));
    }
}

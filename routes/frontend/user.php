<?php

use App\Domains\Auth\Models\Loan;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\LoanController;
use App\Http\Controllers\Frontend\User\ProfileController;
use Tabuna\Breadcrumbs\Trail;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */
Route::group([
    'as' => 'user.',
    'middleware' => [
        'auth', 'password.expires',
        config('boilerplate.access.middleware.verified'),
    ],
], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('is_user')
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Dashboard'), route('frontend.user.dashboard'));
        });

    Route::get('account', [AccountController::class, 'index'])
        ->name('account')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Account'), route('frontend.user.account'));
        });

    Route::get('loan', [LoanController::class, 'index'])
        ->middleware('is_user')
        ->name('loan')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Loan'), route('frontend.user.loan'));
        });

    Route::group([
        'as' => 'loan.',
        'middleware' => [
            'auth', 'password.expires',
            config('boilerplate.access.middleware.verified'),
        ],
    ], function () {
        Route::get('/', [LoanController::class, 'index'])
            ->name('loan')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('frontend.index')
                    ->push(__('Loan'), route('frontend.user.loan'));
            });

        Route::get('loan/view/{loan}', [LoanController::class, 'show'])
            ->name('show')
            ->breadcrumbs(function (Trail $trail, Loan $loan) {
                $trail->parent('frontend.index')
                    ->push(__('Loan'), route('frontend.user.loan.show', $loan));
            });

        Route::get('loan/apply', [LoanController::class, 'apply'])
            ->middleware('is_user')
            ->middleware('able_apply_loan')
            ->name('apply')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('frontend.index')
                    ->push(__('Apply Loan'), route('frontend.user.loan.apply'));
            });

        Route::post('/loan/store', [LoanController::class, 'store'])->name('store');
        Route::post('/loan/repay', [LoanController::class, 'repay'])->name('repay');

        Route::get('loan/view/{loan}/repay/{transaction_id}/preview', [LoanController::class, 'preview'])
            ->name('repay.preview')
            ->breadcrumbs(function (Trail $trail, Loan $loan) {
                $trail->parent('frontend.index')
                    ->push(__('Repay'), route('frontend.user.loan.repay.preview', $loan));
            });
    });


    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\Loan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class LoansTable.
 */
class LoansTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'id';

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        if (auth()->user()->isAdmin()) {
            return Loan::query();
        } else {
            return Loan::query()->where('user_id', auth()->id());
        }


    }

    /**
     * @return array
     */
    public function columns(): array
    {
        $action = 'frontend.user.loan.actions';
        if (auth()->user()->isAdmin()) {
            $action = 'backend.auth.loan.actions';
        }


        return [
            Column::make(__('Amount')),
            Column::make(__('Term')),
            Column::make(__('Status')),
            Column::make(__('Actions'))->view($action),
        ];
    }
}

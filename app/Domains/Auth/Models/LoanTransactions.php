<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User.
 */
class LoanTransactions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'loan_transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loan_id',
        'amount',
        'remain',
        'status',
        'due_date',
    ];

}

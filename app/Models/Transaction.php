<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'money_flow',
        'transaction_type',
        'amount',
        'transaction_id',
        'description',
        'currency',
        'tx_hash',
        'payment_id',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uid',
        'name',
        'email',
        'number',
        'address',
        'transaction_total',
        'transaction_status',
    ];
    protected $hidden = [];

    // use HasFactory;

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}

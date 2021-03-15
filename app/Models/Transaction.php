<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id', 'name', 'email', 'address', 'phone', 'courier',' payment', 'payment_url', 'total_price', 'status'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}

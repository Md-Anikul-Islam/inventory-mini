<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_no',
        'chalan_no',
        'serial_no',
        'category_id',
        'customer_id',
        'product_id',
        'product_name',
        'quantity',
        'details',
        'total',
        'payment_type',
        'bank_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

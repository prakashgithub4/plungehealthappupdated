<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StiTestResult extends Model
{
    use HasFactory;
    protected $table = 'lab_test_results';
    public function getCustomer()
    {
        return $this->belongsTo(Customer::class, 'lab_test_user_id','id');
    }
}

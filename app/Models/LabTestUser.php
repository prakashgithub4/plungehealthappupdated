<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTestUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'lab_test_users';
    public function test()
    {
        return $this->belongsTo(Test::class, 'lab_test_id', 'id');
    }
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id', 'id');
    }   
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}

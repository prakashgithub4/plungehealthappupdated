<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $table = 'lab_tests';
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id', 'id');
    }
}

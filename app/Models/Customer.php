<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Customer  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    protected $table =  'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'country_code',
        'address',
        'dob',
        'profile_image_url',
        'status',
        'gender_id',
        'email_verified_at',
        'mobile_verified',
    ];
}

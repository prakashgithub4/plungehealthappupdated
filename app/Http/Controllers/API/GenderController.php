<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Traits\ApiResponseTrait;


class GenderController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $genders = Gender::all();
        return $this->successResponse($genders, 'Genders retrieved successfully.');
    }
}

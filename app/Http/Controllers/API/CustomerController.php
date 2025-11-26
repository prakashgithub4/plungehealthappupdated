<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\MobileVerifyRequest;
use App\Models\Temp;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\MobileVerifyResource;
use App\Http\Resources\EmailVerifyResource;
use App\Http\Requests\Customer\EmailVerifyRequest;
use App\Http\Requests\Customer\MobileVerifiedRequest;
use App\Http\Requests\Customer\EmailVerifiedRequest;
use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    use ApiResponseTrait;

    public function verifyPhone(MobileVerifyRequest $request)
    {
        try {
            $temp = Temp::create($request->validated() + [
                'otp' => random_int(100000, 999999),
            ]);

            return $this->successResponse(new MobileVerifyResource($temp), 'OTP sent successfully.');
        } catch (\Throwable $e) {
            return $this->errorResponse('Server error.', 500);
        }
    }
    public function verifyEmail(EmailVerifyRequest $request)
    {
        try {
            $temp = Temp::find($request->temp_id);

            if (!$temp) {
                return $this->errorResponse('Invalid temp id.', 400);
            }

            $temp->update([
                'email'           => $request->email,
                'otp'             => random_int(100000, 999999),
            ]);

            return $this->successResponse(
                new EmailVerifyResource($temp),
                'OTP sent successfully to your email id.'
            );
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return $this->errorResponse('Something went wrong.', 500);
        }
    }
    public function mobileVerifyRequest(MobileVerifiedRequest $request)
    {
        if (Temp::where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->exists()
        ) {
            Temp::where('otp', $request->otp)
                ->where('phone', $request->phone)
                ->update(['mobile_verified' => 1]);
            return $this->successResponse([], 'Mobile number verified successfully.');
        } else {
            return $this->errorResponse('Invalid OTP.', 400);
        }
    }
    public function emailVerifyRequest(EmailVerifiedRequest $request)
    {
        if (Temp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->exists()
        ) {
            Temp::where('otp', $request->otp)
                ->where('email', $request->email)
                ->update(['email_verified' => 1]);
            return $this->successResponse([], 'Email verified successfully.');
        } else {
            return $this->errorResponse('Invalid OTP.', 400);
        }
    }
    public function register(RegisterRequest $request)
    {
        try {
            // Get latest temp entry (as you did before)
            $temp = Temp::latest()->first();

            if (!$temp) {
                return $this->errorResponse('No temp record found.', 400);
            }

            // Create customer
            $customer = Customer::create($request->validated() + [
                'email_verified_at' => $temp->email_verified,
                'mobile_verified'   => $temp->mobile_verified,
            ]);

            // Clean entire temp table
            Temp::truncate();  // <<< clean table fully

            return $this->successResponse(
                new CustomerResource($customer),
                'Customer registered successfully.'
            );
        } catch (\Throwable $e) {
            return $this->errorResponse('Something went wrong.', 500);
        }
    }
}
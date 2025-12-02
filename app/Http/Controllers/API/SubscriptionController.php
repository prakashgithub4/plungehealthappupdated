<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class SubscriptionController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        // Get all subscriptions
        $subscriptions = \App\Models\Subscription::all();

        // Add premium_descriptions as a custom property (NOT saved to DB)
        $premiumDescriptions = [
            [
                "description" => "Plunge verifies and validates STI test results from certified laboratories so subscribers can make informed decisions with the click of a button !"
            ],
            [
                "description" => "Plunge verifies and validates STI test results from certified laboratories so subscribers can make informed decisions with the click of a button !"
            ],
            [
                "description" => "Plunge verifies and validates STI test results from certified laboratories so subscribers can make informed decisions with the click of a button !"
            ],
        ];

        // Attach it to the response, not the collection object directly
        $data = [
            'subscriptions' => $subscriptions,
            'premium_descriptions' => $premiumDescriptions
        ];

        return $this->successResponse($data, 'Subscriptions retrieved successfully', 200);
    }
}

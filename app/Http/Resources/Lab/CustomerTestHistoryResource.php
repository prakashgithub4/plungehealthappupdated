<?php

namespace App\Http\Resources\Lab;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerTestHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "test_date" => $this->test_date,
            "patient_id" => $this->patient_id,
            "lab" => $this->lab->name,
            "test" => $this->test->name,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'countryName'=> $this->name,
            'states' => $this->whenLoaded('states', function () {
                return $this->states->map(function ($state) {
                    return [
                        'id' => $state->id,
                        'name' => $state->name,
                        'cities' => $state->relationLoaded('cities')
                            ? $state->cities->map(function ($city) {
                                return [
                                    'id' => $city->id,
                                    'name' => $city->name,
                                ];
                            })
                            : [],
                    ];
                });
            }),
        ];
    }
}

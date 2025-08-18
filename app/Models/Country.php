<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\State;


class Country extends Model
{
  use HasFactory;
  protected $table ='countries';
  protected $fillable = [
    'name'
  ];
  public function states() {
    return $this->hasMany(State::class,);
  }





}


  // protected $table = 'country';
//   protected $casts = [
//     'state_ids' => 'array'
//   ];

//   protected $fillable = [
//     'name',
//     'state_ids'
//   ];


//    public function getStatesWithCitiesAttribute()
//     {
//         $states = State::whereIn('id', $this->state_ids ?? [])->get();

//         return $states->map(function ($state) {
          
//             if (!empty($state->city_id)) {
//                 $city = City::find($state->city_id);
//                 $state->cities = $city ? [$city] : [];
//             }

           
//             if (!empty($state->city_ids)) {
//                 $state->cities = City::whereIn('id', $state->city_ids)->get();
//             }

//             return $state;
//         });
//     }
// }

  // public function states()
  // {
  //   return $this->hasMany(State::class, 'country_id');
  // }

  // public function cities()
  // {
  //   return $this->hasManyThrough(
  //     City::class,
  //     State::class,
  //     'id',         // Local key on the countries table...
  //     'id'          // Local key on the states table...
  //   );
  


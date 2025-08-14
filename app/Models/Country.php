<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  public  function states()
  {
    return $this->hasMany(State::class);
  }
  public function city()
  {
    return $this->hasManyThrough(City::class, State::class);
  }
}

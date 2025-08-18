<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model

{
    use HasFactory;

    protected $table = 'state';
    protected $casts = [
    'city_ids' => 'array',
];



    protected $fillable = [
        'name',
        'city_id'

    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'id', 'city_id');
    }
}

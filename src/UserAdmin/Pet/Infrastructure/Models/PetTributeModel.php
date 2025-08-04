<?php

namespace Peludors\UserAdmin\Pet\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class PetTributeModel extends Model
{
    protected $table = 'pet_tribute';

    protected $fillable = [
        'userID',
        'name',
        'type',
        'breed',
        'birthDate',
        'deathDate',
        'mixedBreed',
        'biography',
        'farewell',
        'photo'
    ];

    public $timestamps = false;
}

<?php

namespace Peludors\Core\Pet\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class PetModel extends Model
{
    protected $table = 'pet';

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

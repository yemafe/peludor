<?php

namespace Peludors\UserAdmin\User\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

/** para evitar advertencias del ide
 * @method static \Illuminate\Database\Eloquent\Builder where(string $column, mixed $value)
 * @method static \Illuminate\Database\Eloquent\Model|null first()
 */
class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'surname',
        'avatar',
        'email',
        'source',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}


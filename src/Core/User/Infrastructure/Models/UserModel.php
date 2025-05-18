<?php

namespace Peludors\Core\User\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

/** para evitar advertencias del ide
 * @method static \Illuminate\Database\Eloquent\Builder where(string $column, mixed $value)
 * @method static \Illuminate\Database\Eloquent\Model|null first()
 */
class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
}


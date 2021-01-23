<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string|null $alamat
 * @property string|null $email
 * @property string|null $no_hp
 * @property string|null $username
 * @property string|null $password
 * @property int $status
 * @property int $level
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'status' => 'int',
		'level' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'alamat',
		'email',
		'no_hp',
		'username',
		'password',
		'status',
		'level'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}

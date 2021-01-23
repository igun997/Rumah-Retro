<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property int $user_id
 * @property float $total
 * @property string|null $notes
 * @property float|null $additional_price
 * @property int $status
 * @property string|null $bukti
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';

	protected $casts = [
		'user_id' => 'int',
		'total' => 'float',
		'additional_price' => 'float',
		'status' => 'int'
	];

	protected $fillable = [
		'user_id',
		'total',
		'notes',
		'additional_price',
		'status',
		'bukti'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}
}

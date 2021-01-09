<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * 
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Product $product
 * @property Order $order
 *
 * @package App\Models
 */
class OrderItem extends Model
{
	protected $table = 'order_items';

	protected $casts = [
		'order_id' => 'int',
		'product_id' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'order_id',
		'product_id',
		'price'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}

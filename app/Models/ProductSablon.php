<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductSablon
 * 
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property float|null $price
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class ProductSablon extends Model
{
	protected $table = 'product_sablons';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'product_id',
		'name',
		'price'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}

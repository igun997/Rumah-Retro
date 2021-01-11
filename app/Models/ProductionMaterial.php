<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductionMaterial
 * 
 * @property int $id
 * @property float $qty
 * @property int|null $product_id
 * @property int $production_id
 * 
 * @property Production $production
 * @property Product $product
 *
 * @package App\Models
 */
class ProductionMaterial extends Model
{
	protected $table = 'production_materials';
	public $timestamps = false;

	protected $casts = [
		'qty' => 'float',
		'product_id' => 'int',
		'production_id' => 'int'
	];

	protected $fillable = [
		'qty',
		'product_id',
		'production_id'
	];

	public function production()
	{
		return $this->belongsTo(Production::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}

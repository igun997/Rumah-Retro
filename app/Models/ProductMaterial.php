<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductMaterial
 * 
 * @property int $id
 * @property int $material_id
 * @property float $qty
 * @property int $product_id
 * 
 * @property Material $material
 * @property Product $product
 *
 * @package App\Models
 */
class ProductMaterial extends Model
{
	protected $table = 'product_materials';
	public $timestamps = false;

	protected $casts = [
		'material_id' => 'int',
		'qty' => 'float',
		'created_at' => 'datetime',
		'product_id' => 'int'
	];

	protected $fillable = [
		'material_id',
		'qty',
		'product_id'
	];

	public function material()
	{
		return $this->belongsTo(Material::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}

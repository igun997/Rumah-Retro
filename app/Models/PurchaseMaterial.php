<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseMaterial
 * 
 * @property int $id
 * @property int $purchase_id
 * @property int $material_id
 * @property float $qty
 * @property float $price
 * 
 * @property Purchase $purchase
 * @property Material $material
 *
 * @package App\Models
 */
class PurchaseMaterial extends Model
{
	protected $table = 'purchase_materials';
	public $timestamps = false;

	protected $casts = [
		'purchase_id' => 'int',
		'material_id' => 'int',
		'qty' => 'float',
		'price' => 'float'
	];

	protected $fillable = [
		'purchase_id',
		'material_id',
		'qty',
		'price'
	];

	public function purchase()
	{
		return $this->belongsTo(Purchase::class);
	}

	public function material()
	{
		return $this->belongsTo(Material::class);
	}
}

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
 * @property int|null $suplier_id
 * @property float $qty
 * @property float $price
 * 
 * @property Purchase $purchase
 * @property Material $material
 * @property Suplier $suplier
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
		'suplier_id' => 'int',
		'qty' => 'float',
		'price' => 'float'
	];

	protected $fillable = [
		'purchase_id',
		'material_id',
		'suplier_id',
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

	public function suplier()
	{
		return $this->belongsTo(Suplier::class);
	}
}

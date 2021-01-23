<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string|null $deskripsi
 * @property string|null $img
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|OrderItem[] $order_items
 * @property Collection|Material[] $materials
 * @property Collection|ProductionMaterial[] $production_materials
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'price' => 'float'
	];

	protected $fillable = [
		'name',
		'price',
		'deskripsi',
		'img'
	];

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}

	public function materials()
	{
		return $this->belongsToMany(Material::class, 'product_materials')
					->withPivot('id', 'qty');
	}

	public function production_materials()
	{
		return $this->hasMany(ProductionMaterial::class);
	}
}

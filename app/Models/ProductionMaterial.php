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
 * @property int $material_id
 * @property float $qty
 * @property int $production_id
 * 
 * @property Material $material
 * @property Production $production
 *
 * @package App\Models
 */
class ProductionMaterial extends Model
{
	protected $table = 'production_materials';
	public $timestamps = false;

	protected $casts = [
		'material_id' => 'int',
		'qty' => 'float',
		'production_id' => 'int'
	];

	protected $fillable = [
		'material_id',
		'qty',
		'production_id'
	];

	public function material()
	{
		return $this->belongsTo(Material::class);
	}

	public function production()
	{
		return $this->belongsTo(Production::class);
	}
}

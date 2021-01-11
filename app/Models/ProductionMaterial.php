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
 * @property int $production_id
 * 
 * @property Production $production
 *
 * @package App\Models
 */
class ProductionMaterial extends Model
{
	protected $table = 'production_materials';
	public $timestamps = false;

	protected $casts = [
		'qty' => 'float',
		'production_id' => 'int'
	];

	protected $fillable = [
		'qty',
		'production_id'
	];

	public function production()
	{
		return $this->belongsTo(Production::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Production
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $notes
 * @property Carbon|null $due_date
 * @property float $total
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ProductionMaterial[] $production_materials
 *
 * @package App\Models
 */
class Production extends Model
{
	protected $table = 'productions';

	protected $casts = [
		'total' => 'float',
		'status' => 'int'
	];

	protected $dates = [
		'due_date'
	];

	protected $fillable = [
		'name',
		'notes',
		'due_date',
		'total',
		'status'
	];

	public function production_materials()
	{
		return $this->hasMany(ProductionMaterial::class);
	}
}

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
 * @property int $qty
 * @property Carbon|null $due_date
 * @property float $total
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Material[] $materials
 *
 * @package App\Models
 */
class Production extends Model
{
	protected $table = 'productions';

	protected $casts = [
		'qty' => 'int',
		'total' => 'float',
		'status' => 'int'
	];

	protected $dates = [
		'due_date'
	];

	protected $fillable = [
		'name',
		'notes',
		'qty',
		'due_date',
		'total',
		'status'
	];

	public function materials()
	{
		return $this->belongsToMany(Material::class, 'production_materials')
					->withPivot('id', 'qty');
	}
}

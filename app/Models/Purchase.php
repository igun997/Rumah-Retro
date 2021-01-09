<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Purchase
 * 
 * @property int $id
 * @property Carbon|null $po_date
 * @property float $total
 * @property string|null $notes
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Material[] $materials
 *
 * @package App\Models
 */
class Purchase extends Model
{
	protected $table = 'purchases';

	protected $casts = [
		'total' => 'float',
		'status' => 'int'
	];

	protected $dates = [
		'po_date'
	];

	protected $fillable = [
		'po_date',
		'total',
		'notes',
		'status'
	];

	public function materials()
	{
		return $this->belongsToMany(Material::class, 'purchase_materials')
					->withPivot('id', 'qty', 'price');
	}
}

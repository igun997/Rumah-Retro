<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Size
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Material[] $materials
 *
 * @package App\Models
 */
class Size extends Model
{
	protected $table = 'sizes';

	protected $fillable = [
		'name'
	];

	public function materials()
	{
		return $this->hasMany(Material::class);
	}
}

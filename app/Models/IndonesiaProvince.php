<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IndonesiaProvince
 * 
 * @property string $id
 * @property string $name
 * @property string|null $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|IndonesiaCity[] $indonesia_cities
 *
 * @package App\Models
 */
class IndonesiaProvince extends Model
{
	protected $table = 'indonesia_provinces';
	public $incrementing = false;

	protected $fillable = [
		'name',
		'meta'
	];

	public function indonesia_cities()
	{
		return $this->hasMany(IndonesiaCity::class, 'province_id');
	}
}

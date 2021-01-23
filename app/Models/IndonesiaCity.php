<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IndonesiaCity
 * 
 * @property string $id
 * @property string $province_id
 * @property string $name
 * @property string|null $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property IndonesiaProvince $indonesia_province
 * @property Collection|IndonesiaDistrict[] $indonesia_districts
 *
 * @package App\Models
 */
class IndonesiaCity extends Model
{
	protected $table = 'indonesia_cities';
	public $incrementing = false;

	protected $fillable = [
		'province_id',
		'name',
		'meta'
	];

	public function indonesia_province()
	{
		return $this->belongsTo(IndonesiaProvince::class, 'province_id');
	}

	public function indonesia_districts()
	{
		return $this->hasMany(IndonesiaDistrict::class, 'city_id');
	}
}

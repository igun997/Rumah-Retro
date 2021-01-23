<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IndonesiaDistrict
 * 
 * @property string $id
 * @property string $city_id
 * @property string $name
 * @property string|null $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property IndonesiaCity $indonesia_city
 * @property Collection|IndonesiaVillage[] $indonesia_villages
 *
 * @package App\Models
 */
class IndonesiaDistrict extends Model
{
	protected $table = 'indonesia_districts';
	public $incrementing = false;

	protected $fillable = [
		'city_id',
		'name',
		'meta'
	];

	public function indonesia_city()
	{
		return $this->belongsTo(IndonesiaCity::class, 'city_id');
	}

	public function indonesia_villages()
	{
		return $this->hasMany(IndonesiaVillage::class, 'district_id');
	}
}

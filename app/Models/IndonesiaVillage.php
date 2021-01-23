<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IndonesiaVillage
 * 
 * @property string $id
 * @property string $district_id
 * @property string $name
 * @property string|null $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property IndonesiaDistrict $indonesia_district
 *
 * @package App\Models
 */
class IndonesiaVillage extends Model
{
	protected $table = 'indonesia_villages';
	public $incrementing = false;

	protected $fillable = [
		'district_id',
		'name',
		'meta'
	];

	public function indonesia_district()
	{
		return $this->belongsTo(IndonesiaDistrict::class, 'district_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Suplier
 * 
 * @property int $id
 * @property string $name
 * @property string $alamat
 * @property string $no_hp
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Suplier extends Model
{
	protected $table = 'supliers';

	protected $fillable = [
		'name',
		'alamat',
		'no_hp'
	];
}

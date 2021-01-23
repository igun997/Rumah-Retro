<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rekening
 * 
 * @property int $id
 * @property string $name
 * @property string $nomor
 *
 * @package App\Models
 */
class Rekening extends Model
{
	protected $table = 'rekening';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'nomor'
	];
}

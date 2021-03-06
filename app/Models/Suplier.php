<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
 * @property Collection|PurchaseMaterial[] $purchase_materials
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

	public function purchase_materials()
	{
		return $this->hasMany(PurchaseMaterial::class);
	}
}

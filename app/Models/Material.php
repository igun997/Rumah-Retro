<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Material
 * 
 * @property int $id
 * @property string $name
 * @property string $img
 * @property float $stok
 * @property string|null $deskripsi
 * @property int $size_id
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Size $size
 * @property Collection|Product[] $products
 * @property Collection|Purchase[] $purchases
 *
 * @package App\Models
 */
class Material extends Model
{
	protected $table = 'materials';

	protected $casts = [
		'stok' => 'float',
		'size_id' => 'int',
		'price' => 'int'
	];

	protected $fillable = [
		'name',
		'img',
		'stok',
		'deskripsi',
		'size_id',
		'price'
	];

	public function size()
	{
		return $this->belongsTo(Size::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_materials')
					->withPivot('id', 'qty');
	}

	public function purchases()
	{
		return $this->belongsToMany(Purchase::class, 'purchase_materials')
					->withPivot('id', 'suplier_id', 'qty', 'price');
	}
    public function sisa()
    {
        $used = 0;
        $_a = ProductMaterial::where(["material_id"=>$this->id])->get();
        foreach ($_a as $index => $item) {
            $used += $item->qty;
        }
        return $this->stok - $used;
    }
}

<?php
namespace App\Model\Domain;

class Device extends ModelBase
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'devices';

    /**
    * The database primary key value.
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     * @var array
     */
    protected $fillable = ['IMEI1', 'IMEI2', 'EAN', 'condition', 'description', 'returnOrderId', 'name', 'shop_id', 'products_pid', 'final_price', 'webshop_product_id'];

	protected $rules =
	[
        'IMEI1' => 'required|numeric|min:3',
        'IMEI2' => 'required|numeric|min:3',
        'EAN'  => 'required',
		'condition' => 'required',
		'description' => 'required',
		'returnOrderId' => 'required',
		'shop_id' => 'required',
		'name' => 'required',
		'final_price' => 'required',
		'webshop_product_id' => 'required'
    ];

	public function images()
    {
        return $this->hasMany('App\Model\Domain\Image');
    }

	public function order()
	{
		return $this->hasOne('App\Model\Domain\Order');
	}

	public function shop()
	{
		return $this->belongsTo('App\Model\Domain\Shop');
	}
}

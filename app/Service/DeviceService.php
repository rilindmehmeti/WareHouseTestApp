<?php
namespace App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Domain\Device;
use App\Model\Domain\Image;
use App\Helper\IOHelper;
use App\Model\Domain\Enum\DeviceConditionEnum;
use App\Helper\HttpClient;

/**
 * DeviceService short summary.
 *
 * DeviceService description.
 *
 * @version 1.0
 *
 */
class DeviceService
{
	public static function listItems($shops, $keyword = "", $perPage = 25, $orderby = 'id', $sort = 'desc')
	{
		if(empty($sort))
			$sort = 'desc';
		if(empty($orderby))
			$orderby = 'id';

		$GLOBALS['_kv'] = $keyword;
        if (!empty($keyword))
		{
            $devices = Device::where(
					function($query) {
						$query->where('IMEI1', 'LIKE', "%{$GLOBALS['_kv']}%")
						->orWhere('IMEI2', 'LIKE', "%{$GLOBALS['_kv']}%")
						->orWhere('EAN', 'LIKE', "%{$GLOBALS['_kv']}%")
						->orWhere('condition', 'LIKE', "%{$GLOBALS['_kv']}%")
						->orWhere('description', 'LIKE', "%{$GLOBALS['_kv']}%")
						->orWhere('returnOrderId', 'LIKE', "%{$GLOBALS['_kv']}%")
						->orWhere('name', 'LIKE', "%{$GLOBALS['_kv']}%");
					}
				)->whereIn('shop_id', $shops);
        }
		else
		{
            $devices = Device::whereIn('shop_id', $shops);
        }
		return $devices->orderBy($orderby, $sort)
			->paginate($perPage);
	}

	public static function insert(Request $request, $shops)
	{
		if(!$request->files->has("images"))
		    throw new \Exception("Please provide image field");
		$model = new Device();
		$data = $request->toArray();
		if(!in_array($data['shop_id'], $shops))
			throw new \Exception("Unauthorized access!");

		$data = array_merge($data, self::validateOrderId($data['returnOrderId']));

		$model->fill($data);
		$model->condition = DeviceConditionEnum::getVal($model->condition);
		if(!$model->validate())
			throw new \Exception("Please fill all data field");
		$files = $request->files->get('images');
		$length = count($files);
		$stamp = time();
		$model->save();
		for ($i = 0; $i < $length; $i++)
		{
			$image = new Image();
			$res = IOHelper::writeFile($files[$i], "public/devImgs", "{$stamp}{$i}");
			$image->path = $res;
			$model->images()->save($image);
		}
		Session::flash('flash_message', 'Device added!');
	}

	public static function update(Request $request, $id, $shops)
	{

		$requestData = $request->toArray();
        $model = Device::findOrFail($id);
		$requestData['condition'] = DeviceConditionEnum::getVal($requestData['condition']);
		if(!in_array($requestData['shop_id'], $shops))
			throw new \Exception("Unauthorized access!");

		$requestData = array_merge($requestData, self::validateOrderId($requestData['returnOrderId']));

		if(!$model->validate($requestData))
			throw new \Exception("Invalid data field");
		$model->update($requestData);
		$model->save();

		if($request->files->has("images"))
		{
			$files = $request->files->get('images');
			$length = count($files);
			$stamp = time();
			for ($i = 0; $i < $length; $i++)
			{
				$image = new Image();
				$res = IOHelper::writeFile($files[$i], "public/devImgs", "{$stamp}{$i}");
				$image->path = $res;
				$model->images()->save($image);
			}
		}

        Session::flash('flash_message', 'Device updated!');
	}

	public static function get($id, $shops)
	{
		$model = Device::findOrFail($id);
		if(!in_array($model->shop_id, $shops))
			throw new \Exception("Unauthorized Access");
		$model->fill(['condition' => DeviceConditionEnum::getNum($model->condition)]);
		return $model;
	}

	public static function delete($id, $shops)
	{
		$device = Device::findOrFail($id);
		if(!in_array($device->shop_id, $shops))
			throw new \Exception("Unauthorized Access");
		$length = count($device->images);
		for ($i = 0; $i < $length; $i++)
		{
			$img = $device->images[$i];
			IOHelper::deleteFile($img->path);
			$img->forceDelete();
		}
		if(isset($device->order))
			$device->order->forceDelete();
		$device->forceDelete();
		Session::flash('flash_message', 'Device deleted!');
	}

	public static function deleteImage($id)
	{
		$model = Image::findOrFail($id);
		if (count($model->device->images) <= 1)
			throw new \Exception("Model must have at least one image!");
		IOHelper::deleteFile($model->path);
		$model->forceDelete();
	}

	public static function listShops(Request $request)
	{
		$data = [];
		$shops = $request->user()->managingShops()->where('active', '=', 1)->get();
		foreach ($shops as $shop)
		{
			$data[$shop->id] = $shop->name;
		}
		return $data;
	}


	public static function listShopIds(Request $request)
	{
		$data = [];
		$shops = $request->user()->managingShops()->where('active', '=', 1)->get();
		foreach ($shops as $shop)
		{
			$data[] = $shop->id;
		}
		return $data;
	}

	public static function validateOrderId($id)
	{
		$response = HttpClient::GET("http://bestcena.pl/ordersExport.php?action=orders&orders_id={$id}");
		$data = json_decode($response, true);
		if(empty($data))
			throw new \Exception("Invalid Order ID");

		$data = array_first($data);
		return [
			'products_pid' => $data['products'][0]['products_pid'],
			'name' => $data['products'][0]['name'],
			'final_price' => $data['products'][0]['final_price'],
			'webshop_product_id' => $data['products'][0]['id']
			];
	}
}

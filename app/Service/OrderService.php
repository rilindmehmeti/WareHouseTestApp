<?php
namespace App\Service;
use App\Model\Domain\Order;
use App\Model\Domain\Device;
use App\Model\View\AddressViewModel;
use App\Model\View\OrderCustomerViewModel;
use App\Model\View\OrderInfoViewModel;
use App\Model\View\OrderTotalViewModel;
use App\Model\View\ProductViewModel;
use App\Helper\HttpClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Model\Domain\Enum\OrderStateEnum;

class OrderService
{
	public static function listItems($shops, $keyword = "", $perPage = 25, $from = '', $to = '', $orderby = 'orders.id', $sort = 'desc')
	{
		if(empty($sort))
			$sort = 'desc';
		if(empty($orderby))
			$orderby = 'orders.id';

		$GLOBALS['_kv'] = $keyword;
        if (!empty($keyword))
		{
            $orders = Order::join('devices', 'devices.id', '=', 'orders.device_id')->where(
					function($query) {
						$query->where('devices.returnOrderId', 'LIKE', "%{$GLOBALS['_kv']}%")
						->orWhere('orders.status', 'LIKE', "%{$GLOBALS['_kv']}%")
						->orWhere('orders.saleOrderId', 'LIKE', "%{$GLOBALS['_kv']}%");
					}
				)->whereIn('devices.shop_id', $shops);
        }
		else
		{
            $orders = Order::join('devices', 'devices.id', '=', 'orders.device_id')->whereIn('devices.shop_id', $shops);
        }

		if(!empty($from))
			$orders = $orders->whereDate('orders.created_at', '>=', $from);

		if(!empty($to))
			$orders = $orders->whereDate('orders.created_at', '<=', $to);

		return $orders->select(['orders.*', 'devices.returnOrderId', 'devices.IMEI1'])
			->orderBy($orderby, $sort)
			->paginate($perPage);
	}

	public static function searchDevice($request)
	{
		$ids = [];
		$shops = $request->user()->managingShops()->where('active', '=', 1)->get();
		foreach ($shops as $shop)
		{
			$ids[] = $shop->id;
		}

		$GLOBALS['_kv'] = $request->get('term');
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
				)->whereIn('shop_id', $ids)->get();
		$data = [];
		foreach($devices as $dev)
		{
			if (isset($dev->order))
				continue;
			$data[] = ['label' => $dev->name.' - '.$dev->IMEI1, 'value' => $dev->name.' - '.$dev->IMEI1, 'hidden' => $dev->id];
		}

		if (count($data) == 0)
			throw new \Exception("Not Found");
		return $data;
	}

	public static function insert(Request $request)
	{
		$device = Device::findOrFail($request->get('device_id'));
		$model = new Order();
		$model->fill($request->toArray());
		if($model->status == OrderStateEnum::Sold && empty($model->saleOrderId))
			throw new \Exception('Please fill "Sale Order No" field when the status of the order is "Sold"');
		if(!$model->validate())
			throw new \Exception("Please fill the required fields!");
		if($model->device_id <= 0)
			throw new \Exception("Please use one of the autocomplete fields!");

		$model->status = OrderStateEnum::getVal($model->status);

		$model->device()->associate($device);
		$model->save();
        Session::flash('flash_message', 'Order added!');
	}

	public static function get($id)
	{
		$model = Order::findOrFail($id);
		$model->fill(["status" => OrderStateEnum::getNum($model->status)]);
		return $model;
	}

	public static function update(Request $request, $id)
	{
        $model = Order::findOrFail($id);
		$requestData = $request->toArray();
		if($requestData['status'] == OrderStateEnum::Sold && empty($requestData['saleOrderId']))
			throw new \Exception('Please fill "Sale Order No" field when the status of the order is "Sold"');
		if($requestData['device_id'] <= 0)
			throw new \Exception("Please use one of the autocomplete fields!");
		if(!$model->validate($requestData))
			throw new \Exception("Invalid data field");

		$requestData['status'] = OrderStateEnum::getVal($requestData['status']);
		$model->update($requestData);
		$model->save();

        Session::flash('flash_message', 'Order updated!');
	}

	public static function delete($id)
	{
		$model = Order::findOrFail($id);
		$model->device()->dissociate();
		$model->forceDelete();
		Session::flash('flash_message', 'Order deleted!');
	}

	public static function invoiceModel($id, $data = [])
	{
		if(empty($data))
		{
			$device = Device::findOrFail($id);
			$product = new ProductViewModel([
				'name' => $device->name,
				'products_pid' => $device->products_pid,
				'imei1' => $device->IMEI1,
				'imei2' => $device->IMEI2,
				'final_price' => $device->final_price
			]);

			$response =
				HttpClient::GET("http://bestcena.pl/ordersExport.php?action=orders&orders_id={$device->returnOrderId}");
			$data = json_decode($response, true);
			if(empty($data))
				throw new \Exception("Invalid Order ID");

			$data = array_first($data);
		}
		else
		{
			$product = new ProductViewModel([
				'name' => $data['product']['name'],
				'products_pid' => $data['product']['products_pid'],
				'imei1' => $data['product']['IMEI1'],
				'imei2' => $data['product']['IMEI2'],
				'final_price' => $data['product']['final_price']
			]);
		}

		$order = new OrderInfoViewModel([
			'id' => $id,
			'orders_id' => $data['info']['orders_id'],
			'date_purchased' => $data['info']['date_purchased'],
			'payment_method' => $data['info']['payment_method'],
			'shipping_method' => $data['info']['shipping_method']
		]);

		$order->stockProduct = $product;

		$order->orderCustomer = new OrderCustomerViewModel([
			'telephone' => $data['customer']['telephone'],
			'email_address' => $data['customer']['email_address']
		]);

		$order->orderBillingAddress = new AddressViewModel([
			'company' => $data['billing']['company'],
			'name' => $data['billing']['name'],
			'street_address' => $data['billing']['street_address'],
			'suburb' => $data['billing']['suburb'],
			'postcode' => $data['billing']['postcode'],
			'city' => $data['billing']['city'],
			'state' => $data['billing']['state'],
			'country' => $data['billing']['country']
		]);

		$order->orderShippingAddress = new AddressViewModel([
			'company' => $data['delivery']['company'],
			'name' => $data['delivery']['name'],
			'street_address' => $data['delivery']['street_address'],
			'suburb' => $data['delivery']['suburb'],
			'postcode' => $data['delivery']['postcode'],
			'city' => $data['delivery']['city'],
			'state' => $data['delivery']['state'],
			'country' => $data['delivery']['country']
		]);

		$order->orderTotal = [];
		for ($i = 0; $i < count($data['totals']); $i++)
		{
			$order->orderTotal[$i] = new OrderTotalViewModel([
				'title' => $data['totals'][$i]['title'],
				'text' => $data['totals'][$i]['text'],
				'value' => $data['totals'][$i]['value'],
				'class' => $data['totals'][$i]['class']
			]);
		}

		return $order;
	}
}
?>
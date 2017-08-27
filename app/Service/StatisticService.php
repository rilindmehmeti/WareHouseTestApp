<?php
namespace App\Service;
use App\Model\Domain\User;
use Illuminate\Support\Facades\DB;
use App\Model\Domain\Device;
use App\Model\Domain\Shop;
use App\Model\Domain\Order;
use Illuminate\Http\Request;


/**
 * DeviceService short summary.
 *
 * DeviceService description.
 *
 * @version 1.0
 *
 */
class StatisticService
{
    public static function getStats($request)
    {
        $result = [];
        $shops = $request->user()->managingShops();
        $shop_ids = $shops->pluck('id');
        $available_conditions = Device::whereIn('shop_id', $shop_ids)->distinct('condition')->orderBy('condition', 'desc')->pluck('condition');
        $devices = Device::all()->whereIn('shop_id', $shop_ids);
        $orders = Order::all()->whereIn('device_id', $devices->pluck('id'));
        $counted_orders = Order::whereIn('device_id', $devices->pluck('id'))->groupBy('status')->select('status as name', DB::raw('count(id)/(select count(*) from orders) + "0.0" as y'))->get();
        $devices_by_condition = Device::whereIn('shop_id', $shop_ids)->groupBy('EAN', 'condition')->select('EAN', 'condition', DB::raw('count(id) as total'))->orderBy('condition', 'asc')->get();
        $devices_to_be_returned = [];
        $structured_devices_to_be_returned = [];
        foreach ($devices_by_condition as $device) {
            $devices_to_be_returned[$device['EAN']][$device['condition']] = $device['total'];
        }
        foreach ($devices_to_be_returned as $key => $value) {
            foreach ($available_conditions as $condition){
                if(!array_key_exists($condition, $value))
                    $devices_to_be_returned[$key][$condition] = 0;
            }
            ksort($devices_to_be_returned[$key]);
        }
        foreach ($devices_to_be_returned as $key => $value){
            array_push($structured_devices_to_be_returned, ['name'=> (string)$key, 'data' => array_values($value)]);
        }
        $available_ean = array_keys($devices_to_be_returned);
        sort($available_ean);
        $devices_by_condition_to_be_returned =[];
        $structured_devices_by_condition = [];
        foreach ($devices_by_condition as $device) {
            $devices_by_condition_to_be_returned[$device['condition']][$device['EAN']] = $device['total'];
        }

        foreach ($devices_by_condition_to_be_returned as $key => $value) {
            foreach ($available_ean as $ean){
                if(!array_key_exists($ean, $value))
                    $devices_by_condition_to_be_returned[$key][$ean] = 0;
            }
            ksort($devices_by_condition_to_be_returned[$key]);
        }
        foreach ($devices_by_condition_to_be_returned as $key => $value){
            array_push($structured_devices_by_condition, ['name'=> (string)$key, 'data' => array_values($value)]);
        }
        $result['devices'] = $devices;
        $result['devices_no'] = $devices->count();
        $result['shops'] = $shops->get();
        $result['shops_no'] = $shops->count();
        $result['orders'] = $orders;
        $result['orders_no'] = $orders->count();
        $result['counted_orders'] = $counted_orders;
        $result['available_conditions'] = $available_conditions;
        $result['devices_by_condition'] = \GuzzleHttp\json_encode($structured_devices_to_be_returned);
        $result['available_ean'] = \GuzzleHttp\json_encode($available_ean);
        $result['devices_by_condition_total'] = \GuzzleHttp\json_encode($structured_devices_by_condition);
        return $result;
    }
}
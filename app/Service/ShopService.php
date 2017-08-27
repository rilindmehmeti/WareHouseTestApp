<?php
namespace App\Service;
use App\Model\Domain\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

/**
 * DeviceService short summary.
 *
 * DeviceService description.
 *
 * @version 1.0
 *
 */
class ShopService
{
    public static function listItems($keyword='', $orderby = 'id', $sort = 'desc', $perPage = 25)
    {

        if(empty($orderby))
            $orderby = 'id';

        if(empty($sort))
            $sort = 'desc';

        if (!empty($keyword)) {
            if(strtolower($keyword) == 'yes' ||  strtolower($keyword) == 'no' )
            {
                $keyword = $keyword == 'yes' ? '1' : '0';
                $shops = Shop::Where('active', '=', "$keyword");
            }
            else
            {
                $shops = Shop::where('name', 'LIKE', "%$keyword%")
                    ->orWhere('country', 'LIKE', "%$keyword%")
                    ->orWhere('city', 'LIKE', "%$keyword%")
                    ->orWhere('id', 'LIKE', "%$keyword%");
            }
            $shops = $shops->orderBy($orderby, $sort)->paginate($perPage);
        } else {
            $shops = Shop::orderBy($orderby, $sort)->paginate($perPage);
        }

        return $shops;

    }

    public static function insert(Request $request)
    {
        $model = new shop();
        $model->fill($request->toArray());
        if(!$model->validate())
            throw new \Exception('Please fill all the data!');
        $model->save();
        Session::flash('flash_message', 'Shop added!');
    }

    public static function get($id)
    {
        $shop = Shop::findOrFail($id);
        return $shop;
    }

    public static function update(Request $request, $id)
    {
        $requestData = $request->all();
        $model = Shop::findOrFail($id);
        if(!$model->validate($requestData))
            throw new \Exception('Data are invalid!');
        $model->update($requestData);
        Session::flash('flash_message', 'Shop updated!');
    }

    public static function delete($id)
    {
        Shop::destroy($id);
        Session::flash('flash_message', 'Shop deleted!');
    }



}

<?php
namespace App\Http\Controllers\Device;
use App\Http\Controllers\Controller;
use App\Service\DeviceService;
use App\Model\Domain\Device;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
		$shops = DeviceService::listShopIds($request);
        $devices = DeviceService::listItems($shops, $request->get('search'), 25,$request->get('orderby', 'id'), $request->get('sort', 'desc'));
        return view('devices.index', ['devices' => $devices,'search' => $request->get('search')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
		$shops = DeviceService::listShops($request);
        return view('devices.create', ["shops" => $shops]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
		try
		{
			$shops = DeviceService::listShopIds($request);
			DeviceService::insert($request, $shops);
			return redirect('devices');
		}
		catch (\Exception $ex)
		{
			return redirect()->back()->withInput($request->toArray())->withErrors($ex->getMessage());
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
		try
		{
			$shops = DeviceService::listShopIds($request);
			$device = Device::findOrFail($id);
			if(!in_array($device->shop_id, $shops))
				throw new \Exception("Unauthorized Access!");
			return view('devices.show', compact('device'));
		}
		catch (\Exception $ex)
		{
			return redirect('devices')->withErrors($ex->getMessage());
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
		try
		{
			$shops = DeviceService::listShops($request);
			$ids = DeviceService::listShopIds($request);
			$device = DeviceService::get($id, $ids);
			return view('devices.edit', ['device' => $device, 'shops' => $shops]);
		}
		catch (\Exception $ex)
		{
			return redirect('devices')->withErrors($ex->getMessage());
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
		try
		{
			$shops = DeviceService::listShopIds($request);
			DeviceService::update($request, $id, $shops);
			return redirect('devices');
		}
		catch (\Exception $ex)
		{
			return redirect()->back()->withInput($request->toArray())->withErrors($ex->getMessage());
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
		try
		{
			$shops = DeviceService::listShopIds($request);
			DeviceService::delete($id, $shops);
			return redirect('devices');
		}
		catch (\Exception $ex)
		{
			return redirect('devices')->withErrors($ex->getMessage());
		}
    }

	public function deleteImage($id)
	{
		try
		{
			DeviceService::deleteImage($id);
			return "Image deleted successfully";
		}
		catch (\Exception $ex)
		{
			return response()->json("Could not delete the image", 400);
		}
	}
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Container;
use App\Models\Container_type;

class LendController extends Controller
{
    public function index($slug)
    {
        $vendor = Vendor::where('slug', $slug)->first();
        return view('lend')
            ->with('vendor', $vendor);
    }

    public function addmember($slug)
    {
        $vendor = Vendor::where('slug', $slug)->first();
        return view('addmember')
            ->with('vendor', $vendor);
    }

    public function lendPhoneCheck(request $request, $slug)
    {
        if ($request->phone)
        {
            if ($customer = Customer::where('phone', $request->phone)
                ->first())
            {
                return \Response::json(['success' => '會員確認'], 200);
            }
            else
            {
                return \Response::json(['error' => '此手機號碼尚未加入會員，是否直接註冊？'], 404);
            }
        }
        else
        {
            return \Response::json(['error' => '請填寫手機號碼'], 404);
        }
    }

    public function customerCreate(request $request, $slug)
    {

        if ($request->phone != null)
        {
            $customer = new Customer;
            $customer->phone = $request->phone;

            if ($customer->save())
            {
                return \Response::json(['success' => '註冊成功！'], 200);
            }
            else
            {
                return \Response::json(['error' => '發生錯誤'], 500);
            }
        }
        else
        {
            return \Response::json(['error' => '請填寫手機號碼'], 500);
        }

    }

    public function lendContainerCreate(request $request, $slug)
    {

        $container = Container::where('number', $request->number)
            ->where('status', 1)
            ->latest()
            ->first();
            
        $recover_container = Container::where('number', $request->number)
            ->where('status', 0)
            ->latest()
            ->first();


        if (($recover_container && $recover_container->created_at < $container->created_at))
        {
            return \Response::json(['error' => '杯杯編號 :<br> ' . $container->number . ' 已被借走'], 500);
        }

        if (!$recover_container && $container)
        {
            return \Response::json(['error' => '杯杯編號 :<br> ' . $container->number . ' 已被借走'], 500);
        }

        if ($request->phone && $request->number)
        {
            $vendor = Vendor::where('slug', $slug)->first();
            $customer = Customer::where('phone', $request->phone)
                ->first();
            $container_type = Container_type::find($request->number);

            if (!$container_type)
            {
                return \Response::json(['error' => '編號' . $request->number . '的杯杯不存在'], 404);
            }

            $n_container = new Container;
            $n_container->vendor_id = $vendor->id;
            $n_container->customer_id = $customer->id;
            $n_container->number = $request->number;
            $n_container->vendor_name = $vendor->name;
            $n_container->customer_phone = $customer->phone;
            $n_container->container_type_id = $container_type->id;
            $n_container->status = 1;

            if ($n_container->save())
            {
                return \Response::json(['success' => '杯子編號 :<br> ' . $n_container->number . ' 紀錄成功'], 200);
            }
            else
            {
                return \Response::json(['error' => '發生錯誤'], 500);
            }
        }
        else
        {
            return \Response::json(['error' => '請填寫杯子編號'], 500);
        }

    }

}


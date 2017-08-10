<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vendor;
use App\Customer;
use App\Container;

class RecoverController extends Controller
{
    //
    public function index($slug){
		$vendor = Vendor::where('slug', $slug)->first();
    	return view('recover')->with('vendor',$vendor);


    }
    public function recoverContainer(request $request, $slug){

    	$container = Container::where('number', $request->number)->where('status',1)->latest()->first();

        $recover_container = Container::where('number', $request->number)->where('status',0)->latest()->first();

        if($recover_container){
            if($recover_container->created_at > $container->created_at){
                return \Response::json(['error' => '杯子編號 : <br>'.$container->number.' 已經被歸還過'], 500);
            }
        }

    	if($container){
                $vendor = Vendor::where('slug',$slug)->first();
                $customer = Customer::find($container->customer_id);

                $o_container = new Container;
                $o_container->vendor_id = $vendor->id;
                $o_container->customer_id = $customer->id;
                $o_container->number = $request->number; 
                $o_container->vendor_name = $vendor->name; 
                $o_container->customer_phone = $customer->phone; 
                $o_container->status = 0;
                
                if($o_container->save()){
    		return \Response::json(['success' => '杯子編號 : <br>'.$container->number.' 回收完成'], 200);
                }
    	}
    	else {
    		return \Response::json(['error' => '杯子編號 : <br>'.$request->number.' 沒有被租借'], 404);
    	}
    }
}
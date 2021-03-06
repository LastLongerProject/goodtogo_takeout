<?php
namespace App\Http\Controllers;

use Excel;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Container_type;
use App\Models\Container;
use App\Models\Vendor;
use App\Models\Customer;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function vendorlist()
    {
        $list = Vendor::all();
        return view('vendorlist')->with('lists', $list);
    }

    public function importFile()
    {
        $container = Container_type::all()->count();
        return view('import')->with('container', $container);
    }

    public function importaction(Request $request){

        $file = $request->file('file');
        if ($file->isValid()) {
            $file->move('uploads', $file->getClientOriginalName());
        }
        


        $fileName = $file->getClientOriginalName();
        $status = "成功";

        $allexcel = Excel::load('public/uploads/' . $fileName, function ($reader)
        {
        })->get();

        Excel::filter('chunk')
            ->load('public/uploads/' . $fileName)->chunk(100, function ($results)
        {
            foreach ($results as $row)
            {
                if ($row->編號 == null)
                {
                    $status = "失敗，有可能是多出來的欄位。";
                    break;
                }

                $container_type = Container_type::firstOrCreate(['id' => $row->編號]);
                $container_type->id = $row->編號;
                $container_type->type = $row->類型;
                $container_type->decoration = $row->樣式;
                $container_type->status = ($row->狀態 == "可用" ? 1 : 0);

                if ($container_type->save())
                {
                    continue;
                }
                else
                {
                    $status = "失敗";
                    break;
                }
            }

        });
        return view("container_type")->with('status', $status);
    }

    public function exportFile()
    {

        Excel::create('ContainerHistory-' . Carbon::now() , function ($excel)
        {
            $excel->setTitle('好盒器容器使用紀錄');

            $excel->setCreator('Steven Ho')
                ->setCompany('好盒器');

            $excel->sheet('Sheet 1', function ($sheet)
            {

                $containers = Container::all();
                foreach ($containers as $container)
                {
                    $container_type = Container_type::find($container->number)->decoration;
                    $data[] = array(
                        $container->id,
                        $container->number,
                        $container_type,
                        $container->vendor_name,
                        $container->customer_phone,
                        ($container->status == 1 ? '出借' : '歸還') ,
                        $container->created_at,
                    );
                }
                $sheet->fromArray($data, null, 'A1', false, false);
                $headings = array(
                    '資料代號',
                    '杯子號碼',
                    '杯子容量',
                    '店家名稱',
                    '顧客手機',
                    '杯子狀態',
                    '租借用時間'
                );
                $sheet->prependRow(1, $headings);
                $sheet->setAutoSize(true);
            });
        })
            ->download('csv');
    }

    public function record()
    {
        $container = Container::orderBy('created_at', 'desc')->paginate(15);
        return view('record')->with('container', $container);
    }

    public function status()
    {
        $vendor = Vendor::all()->count() - 1;
        $container_lend = Container::where('status', '=', 1)->count();
        $container_recover = Container::where('status', '=', 0)->count();
        $container_type = Container_type::all()->count() - 10;
        $customer = Customer::all()->count();

        return view('bstatus', compact('vendor', 'container_lend', 'container_recover', 'container_type', 'customer'));
    }

    public function update()
    {
        $vendor = Vendor::all();
        return view('update')->with('vendor', $vendor);
    }

    public function updateVendor(Request $request)
    {
        $vendor = Vendor::find($request->vendor_id);

        $vendor->possess_480 = $request->vendor_480;
        $vendor->possess_360 = $request->vendor_360;

        if ($vendor->touch())
        {
            return \Response::json(['sucess' => '修改成功'], 200);
        }
        else
        {
            return \Response::json(['error' => '修改失敗'], 500);
        }
    }

    public function zxrecord(){
        return view('zxrecord');
    }
    public function importzx(Request $request)
    {
        $file = $request->file('file');
        if ($file->isValid()) {
            $file->move('uploads', $file->getClientOriginalName());
        }
        
        $fileName = $file->getClientOriginalName();
        $status = "成功";

        $allexcel = Excel::load('public/uploads/' . $fileName, function ($reader)
        {
        })->get();

        Excel::filter('chunk')
            ->load('public/uploads/' . $fileName)->chunk(100, function ($results)
        {
            foreach ($results as $row)
            {
                if ($row->編號 == null)
                {
                    $status = "失敗，有可能是多出來的欄位。";
                    break;
                }

                if($row->狀態 == "借出"){
                    $cstatus = 1;
                }
                elseif ($row->狀態 == "歸還") {
                    $cstatus = 0;
                }
                
                $container = new Container();
                $container->number = str_pad($row->編號,4,"0",STR_PAD_LEFT);
                $container->vendor_name = "正興杯杯計畫";
                $container->vendor_id = 0;
                $container->customer_id = 1;
                $container->customer_phone = "0900000000";
                $container->container_type_id = $row->編號;
                $container->status = $cstatus;

                if ($container->save())
                {
                    continue;
                }
                else
                {
                    $status = "失敗";
                    break;
                }
            }

        });
         return view("container_type")->with('status', $status);
    }

}


<?php

namespace App\Http\Controllers\Front;

use App\Models\Dispatch;
use App\Models\Interfaces\DispatchInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class DispatchController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    /*public function groceryIndex(Request $request)
    {

        $statusId = $request->statusId;
        $orderId = $request->orderId;
        $phoneNo = $request->phoneNo;

        $dispatchOrders = Dispatch::join('sprint__sprints', 'dispatch.sprint_id', '=', 'sprint__sprints.id')
            ->join('sprint__tasks', 'sprint__sprints.id', '=', 'sprint__tasks.sprint_id')
            ->join('sprint__contacts', 'sprint__tasks.contact_id', '=', 'sprint__contacts.id')
            ->join('vendors', 'sprint__sprints.creator_id', '=', 'vendors.id');
        if($orderId > 0)
        {
            $dispatchOrders->where('dispatch.order_id',$orderId);
        }
        elseif ($statusId != null)
        {
            $dispatchOrders->where('dispatch.status',$statusId);
        }
        elseif ($phoneNo != null)
        {
            $dispatchOrders->where('sprint__contacts.phone',$phoneNo);
        }
        $dispatchOrders = $dispatchOrders->orderBy('dispatch.id','DESC')
            ->orderBy('sprint__tasks.id','DESC')
            ->where('sprint__tasks.type','dropoff')
            ->select('dispatch.*','vendors.name as vendor_name','sprint__contacts.name as customer_name','sprint__contacts.phone as customer_phone','sprint__contacts.email as customer_email')
            ->paginate(50);
        //dd($dispatchOrders);

        return view('front.dispatch.dispatch-orders',compact('dispatchOrders'));

    }*/

    /**
     * Grocery Dispatch View
     *
     */
    public function groceryIndex(Request $request)
    {
//        dd($request);
        return view('front.dispatch.dispatch-orders');
    }

    /**
     * Grocery Dispatch data
     *
     */
    public function groceryData(DataTables $datatables, Request $request): JsonResponse
    {
//        dd($request->statusId);
        $statusId = $request->statusId;
        $orderId = $request->orderId;
        $phoneNo = $request->phoneNo;
        $stuck = $request->stuck;

        /*if ($request->ajax()) {
            $data = Dispatch::join('sprint__sprints', 'dispatch.sprint_id', '=', 'sprint__sprints.id')
                ->join('sprint__tasks', 'sprint__sprints.id', '=', 'sprint__tasks.sprint_id')
                ->join('sprint__contacts', 'sprint__tasks.contact_id', '=', 'sprint__contacts.id')
                ->join('vendors', 'sprint__sprints.creator_id', '=', 'vendors.id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }*/

//        $mock = Dispatch::all();

        $query = Dispatch::join('sprint__sprints', 'dispatch.sprint_id', '=', 'sprint__sprints.id')
            ->join('sprint__tasks', 'sprint__sprints.id', '=', 'sprint__tasks.sprint_id')
            ->join('sprint__contacts', 'sprint__tasks.contact_id', '=', 'sprint__contacts.id')
            ->join('vendors', 'sprint__sprints.creator_id', '=', 'vendors.id');

//        dd($mock->count());


        if($orderId > 0)
        {
            $query->where('dispatch.order_id',$orderId);
        }
        if ($statusId != null)
        {
            $query->where('dispatch.status',$statusId);
        }
        if ($phoneNo != null)
        {
            $query->where('sprint__contacts.phone', '+'.$phoneNo);
        }

        $query = $query->select('dispatch.*','vendors.name as vendor_name','sprint__contacts.name as customer_name','sprint__contacts.phone as customer_phone','sprint__contacts.email as customer_email');
        return $datatables->eloquent($query)
            ->setRowId(static function ($record) {
                return $record->id;
            })
            ->editColumn('date', static function ($record) {
                return ConvertTimeZone($record->date,'America/Toronto','UTC');
                //return $record->vendor_name;
            })
            ->editColumn('dropoff_etc', static function ($record) {
                return ConvertTimeZone($record->date,'America/Toronto','UTC');
                //return $record->vendor_name;
            })
            ->editColumn('distance', static function ($record) {
                return $record->distance.' km';
            })
            ->editColumn('vendor_name', static function ($record) {
                return $record->vendor_name;
            })
            ->editColumn('customer_name', static function ($record) {
                $btn = '<ul class="no-list attr-list">
																<li><i class="icofont-user-alt-7"></i>
																'.$record->customer_name.'
																</li>
																<li><i class="icofont-phone"></i>
																	 '.$record->customer_phone.'
																</li>
																<li><i class="icofont-google-map"></i>
																	'.$record->customer_email.'
																</li>
															</ul>';
                return $btn;
            })
            ->editColumn('status', static function ($record) {
                return getStatusCodesWithKey('status_labels.'.$record->status);
            })
            ->addColumn('action', static function ($record) {
                return view('front.dispatch.action');
            })
            ->rawColumns(['vendor_name', 'customer_name', 'customer_email', 'customer_phone'])
            ->make(true);

    }

    /*public function groceryIndex(Request $request)
    {

        $statusId = $request->statusId;
        $orderId = $request->orderId;
        $phoneNo = $request->phoneNo;

        $dispatchOrders = Dispatch::orderBy('id','DESC');

        if($orderId > 0)
        {
            $dispatchOrders->where('dispatch.order_id',$orderId);
        }
        elseif ($statusId != null)
        {
            $dispatchOrders->where('dispatch.status',$statusId);
        }
        elseif ($phoneNo != null)
        {
            $dispatchOrders->where('sprint__contacts.phone',$phoneNo);
        }
        $dispatchOrders = $dispatchOrders->paginate(10);

        return view('front.dispatch.dispatch-orders',compact('dispatchOrders'));

    }*/

    /**
     * E-Commerce Dispatch View
     *
     */
    public function eCommerceIndex()
    {
        return view('front.dispatch.dispatch-map-view');

    }

    /**
     * Dispatch Map View
     *
     */
    public function dispatchMap()
    {
        return view('front.dispatch.dispatch-map-view');

    }



}

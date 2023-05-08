<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $merchants = Merchant::paginate(10);
        return view('dashboard.merchant.index', compact('merchants'));
    }

    public function create()
    {
        $governorates = Governorate::all();
        $cities = City::all();
        // $unique_id = random_int(100000, 999999);
        return view('dashboard.merchant.create', compact('cities', 'governorates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'governorate_id' => 'required|numeric|gt:0',
            'operator_id' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'الاسم مطلوب',
            'governorate_id.required' => ' المحافظة مطلوبة',
            'governorate_id.numeric' => ' المحافظة مطلوبة',
            'governorate_id.gt' => ' المحافظة مطلوبة',
            'operator_id.required' => ' رقم المشغل مطلوب ',
            'mobile.required' => ' الهاتف مطلوب ',
            'address.required' => ' العنوان مطلوب ',


        ]);
        $request['user_id']=Auth::user()->id;
        $input = $request->all();

        $saved = Merchant::create($input);
        return response()->json(['success' => true, 'message' => 'تمت الاضافه بنجاح']);
    }
    public function edit(Request $request)
    {
        $merchant = Merchant::findOrFail($request->id);
        $governorates = Governorate::all();
        $cities = City::all();
        return view('dashboard.merchant.edit', compact('merchant', 'governorates', 'cities'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'governorate_id' => 'required|numeric|gt:0',
            'operator_id' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'الاسم مطلوب',
            'governorate_id.required' => ' المحافظة مطلوبة',
            'governorate_id.numeric' => ' المحافظة مطلوبة',
            'governorate_id.gt' => ' المحافظة مطلوبة',
            'operator_id.required' => ' رقم المشغل مطلوب ',
            'mobile.required' => ' الهاتف مطلوب ',
            'address.required' => ' العنوان مطلوب ',
        ]);
        $input = $request->all();
        $merchant = Merchant::findOrFail($request->id);

        $merchant->update([
            'name' => $input['name'],
            'governorate_id' => $input['governorate_id'],
            'operator_id'=>$input['operator_id'],
            'mobile'=>$input['mobile'],
            'address'=>$input['address'],
            'city_id'=>$input['city_id'],

        ]);
        return response()->json(['success' => true, 'message' => 'تمت التعديل بنجاح']);
    }
    public function get_merchant(Request $request)
    {
        $merchant = Merchant::findOrFail($request->merchant_id);

     

        $response_array = [
            'success' => true,
            'merchant' => $merchant,
         'causes'=>$merchant->causes()->get()
        ];
        return response()->json($response_array, 200);
        // return view('dashboard.city.edit', compact('cities', 'governorate'));
    }
    public function causes(Request $request)
    {
        $merchant = Merchant::findOrFail($request->id);
        $governorates = Governorate::all();
        $cities = City::all();
        $data=$merchant->causes()->paginate(10);
        return view('dashboard.merchant.causes', compact('merchant', 'governorates', 'cities','data'));
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Merchant;
use App\Models\Seizures;
use App\Models\SeizureUnit;
use Illuminate\Http\Request;

class SeizureController extends Controller
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
        $data = Seizures::paginate(10);
        return view('dashboard.seizure.index', compact('data'));
    }

    public function create(Request $request)
    {
        $merchant = null;
        $merchants = Merchant::all();

        if($request->has('id')){
        $merchant = Merchant::findOrFail($request->id);
        } 
        return view('dashboard.seizure.create', compact('merchant','merchants'));


    }

    public function store(Request $request)
    {
    //    return $request->all();
        $request->validate([

            'bailiff_number'      => 'required|string|max:255',

            'case_book_number' => 'required',

            'merchant_id' => 'required|numeric|gt:0',

            "units"    => "required",
            'cause_id'=> 'required|numeric|gt:0|unique:seizures,cause_id',

        ], [

            'bailiff_number.required' => 'رقم المحضر مطلوب',

            'case_book_number.required' => ' رقم دفتر الضبط مطلوب ',

            'merchant_id.required' => 'التاجر مطلوب',

            'merchant_id.numeric' => 'التاجر مطلوب',

            'merchant_id.gt' => 'التاجر مطلوب',

            'units.required'=>'الاصناف مطلوبه',

            'cause_id.required' => 'القضية مطلوب',

            'cause_id.numeric' => 'القضية مطلوب',

            'cause_id.gt' => 'القضية مطلوب',

            'cause_id.unique'=>'تم تحرير مضبوطات مسبقة لنفس القضية'

        ]);

        $input = $request->except(['_token', 'units']);

        $seizure = Seizures::create($input);

        if ($request->has('units')) {

            $data = json_decode($request->units, true);

            foreach ($data as $f_key) {

                $user_key = SeizureUnit::create([

                    'seizures_id' => $seizure->id,
                    'unit_name' => $f_key['unit_name'],
                    'quantity' => $f_key['quantity'],
                    'weight' => $f_key['weight'],
                    'unit_type' => $f_key['unit_type'],
                 
                ]);
            }
        }
        return response()->json(['success' => true, 'message' => 'تمت الاضافه بنجاح']);
    }
    public function edit(Request $request)
    {
        $seizure = Seizures::findOrFail($request->id);
        $merchant = Merchant::findOrFail( $seizure->merchant_id);
        return view('dashboard.seizure.edit', compact('seizure','merchant'));
    }

    public function update(Request $request)
    {
        $request->validate([

            "units"    => "required",

        ], [

            'units.required'=>'الاصناف مطلوبه'

        ]);

        $seizure = Seizures::findOrFail($request->seizure_id);
  
        
        if ($request->has('units')) {
            
            foreach ($seizure->units  as $unit) $unit->delete();

            $data = json_decode($request->units, true);

            foreach ($data as $f_key) {

                $user_key = SeizureUnit::create([

                    'seizures_id' => $seizure->id,
                    'unit_name' => $f_key['unit_name'],
                    'quantity' => $f_key['quantity'],
                    'weight' => $f_key['weight'],
                    'unit_type' => $f_key['unit_type'],
                 
                ]);
            }
        }
        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);
    }
}

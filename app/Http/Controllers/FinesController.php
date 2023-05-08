<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\City;
use App\Models\Fines;
use App\Models\Governorate;
use App\Models\Merchant;
use Illuminate\Http\Request;

class FinesController extends Controller
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
        $data = Fines::paginate(10);
        return view('dashboard.fines.index', compact('data'));
    }

    public function create(Request $request)
    {
        $merchant = null;
        $merchants = Merchant::all();

        if($request->has('id')){
        $merchant = Merchant::findOrFail($request->id);
        } 
        return view('dashboard.fines.create', compact('merchant','merchants'));


    }

    public function store(Request $request)
    {
       
        $request->validate([

            'bailiff_number'      => 'required|string|max:255',

            'price' => 'required',

            'merchant_id' => 'required|numeric|gt:0',

            'cause_id' => 'required|numeric|gt:0'

        ], [

            'bailiff_number.required' => 'رقم وصل الغرامة ',

            'price.required' => ' المبلغ   ',

            'cause_id.required' => ' رقم القضيه مطلوب ',

          
            'merchant_id.required' => 'التاجر مطلوب',
            'merchant_id.numeric' => 'التاجر مطلوب',
            'merchant_id.gt' => 'التاجر مطلوب',

        ]);

        $cause=Cause::findOrFail($request->cause_id);
        $seizure=$cause->seizures;
        $request['seizures_id']= $seizure->id;
        $input = $request->all();

        $saved = Fines::create($input);

        return response()->json(['success' => true, 'message' => 'تمت الاضافه بنجاح']);
    }
    public function edit(Request $request)
    {
        $fines = Fines::findOrFail($request->id);
        $merchant = Merchant::findOrFail( $fines->merchant_id);
        return view('dashboard.fines.edit', compact('fines','merchant'));
    }

    public function update(Request $request)
    {
        $request->validate([

            'bailiff_number'      => 'required|string|max:255',

            'price' => 'required',

            'merchant_id' => 'required|numeric|gt:0',

            'cause_id' => 'required|numeric|gt:0'

        ], [

            'bailiff_number.required' => 'رقم وصل الغرامة ',

            'price.required' => ' المبلغ   ',

            'cause_id.required' => ' رقم القضيه مطلوب ',
          
            'merchant_id.required' => 'التاجر مطلوب',

            'merchant_id.numeric' => 'التاجر مطلوب',
            
            'merchant_id.gt' => 'التاجر مطلوب',

        ]);

        $fines=Fines::findOrFail($request->fines_id);
      
        $input = $request->all();

        $fines->update([

            'price' => $input['price'],

        ]);
        return response()->json(['success' => true, 'message' => 'تمت التعديل بنجاح']);
    }
}

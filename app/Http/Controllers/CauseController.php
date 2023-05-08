<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CauseController extends Controller
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
        $data = Cause::paginate(10);
        return view('dashboard.cause.index', compact('data'));
    }

    public function create(Request $request)
    {
        $merchant = null;
        $merchants = Merchant::all();

        if($request->has('id')){
        $merchant = Merchant::findOrFail($request->id);
        } 
        return view('dashboard.cause.create', compact('merchant','merchants'));


    }

    public function store(Request $request)
    {
       
        $request->validate([

            'bailiff_number'      => 'required|string|max:255',

            'case_book_number' => 'required',

            'case_book_place' => 'required',

            'case_type_id' => 'required',

            'violation_type_id' => 'required',

            'goods_type_id' => 'required',
            
            'merchant_id' => 'required|numeric|gt:0'


        ], [

            'bailiff_number.required' => 'رقم المحضر مطلوب',

            'case_book_number.required' => ' رقم دفتر الضبط مطلوب ',

            'case_book_place.required' => ' مكان الضبط مطلوب ',

            'case_type_id.required' => ' نوع القضيه مطلوب ',

            'violation_type_id.required' => ' نوع المخالفه مطلوب ',

            'goods_type_id.required' => ' نوع البضاعه مطلوب ',
            'merchant_id.required' => 'التاجر مطلوب',
            'merchant_id.numeric' => 'التاجر مطلوب',
            'merchant_id.gt' => 'التاجر مطلوب',

        ]);

        $input = $request->all();

        $saved = Cause::create($input);

        if ($request->hasFile('picture')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/causes/'; // upload path
            $photo = $request->file('picture');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $saved->update(['picture' => 'uploads/causes/' . $name]);
        }

        return response()->json(['success' => true, 'message' => 'تمت الاضافه بنجاح']);
    }
    public function edit(Request $request)
    {
        $cause = Cause::findOrFail($request->id);
        $merchant = Merchant::findOrFail( $cause->merchant_id);
        return view('dashboard.cause.edit', compact('cause','merchant'));
    }

    public function update(Request $request)
    {
        $request->validate([

            'bailiff_number'      => 'required|string|max:255',

            'case_book_number' => 'required',

            'case_book_place' => 'required',

            'case_type_id' => 'required',

            'violation_type_id' => 'required',

            'goods_type_id' => 'required',

        ], [

            'bailiff_number.required' => 'رقم المحضر مطلوب',

            'case_book_number.required' => ' رقم دفتر الضبط مطلوب ',

            'case_book_place.required' => ' مكان الضبط مطلوب ',

            'case_type_id.required' => ' نوع القضيه مطلوب ',

            'violation_type_id.required' => ' نوع المخالفه مطلوب ',

            'goods_type_id.required' => ' نوع البضاعه مطلوب ',

        ]);

        $input = $request->all();
        $cause = Cause::findOrFail($request->cause_id);


        $cause->update([
            'bailiff_number' => $input['bailiff_number'],
            'case_book_number' => $input['case_book_number'],
            'case_book_place' => $input['case_book_place'],
            'case_type_id' => $input['case_type_id'],
            'violation_type_id' => $input['violation_type_id'],
            'goods_type_id' => $input['goods_type_id'],
            'merchant_id' => $input['merchant_id'],
            'action_token' => $input['action_token'],
            'notes' => $input['notes'],



        ]);
        if ($request->hasFile('picture')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/causes/'; // upload path
            $photo = $request->file('picture');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path

            Storage::disk('local')->put('/uploads/causes' . '/' . $name, $photo, 'public');

            $cause->update(['picture' => 'uploads/causes/' . $name]);
        }
        return response()->json(['success' => true, 'message' => 'تمت التعديل بنجاح']);
    }
    public function get_cause(Request $request)
    {
        $cause = Cause::findOrFail($request->cause_id);

        $response_array = [
            'success' => true,
            'cause' => $cause,
     
        ];
        return response()->json($response_array, 200);
        // return view('dashboard.city.edit', compact('cities', 'governorate'));
    }
    public function seizure(Request $request)
    {
        $cause = Cause::findOrFail($request->id);
        $data=$cause->seizures()->paginate(10);
        return view('dashboard.cause.seizure', compact('data','cause'));
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
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
        $cities = City::paginate(10);
        return view('dashboard.city.index', compact('cities'));
    }

    public function create()
    {
        $governorates = Governorate::all();
        return view('dashboard.city.create', compact('governorates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'governorate_id' => 'required|numeric|gt:0'
        ], [
            'name.required' => 'الاسم مطلوب',
            'governorate_id.required' => ' المحافظة مطلوبة',
            'governorate_id.numeric' => ' المحافظة مطلوبة',
            'governorate_id.gt' => ' المحافظة مطلوبة',

        ]);

        $input = $request->all();

        $saved = City::create($input);
        return response()->json(['success' => true, 'message' => 'تمت الاضافه بنجاح']);
    }
    public function edit(Request $request)
    {
        $city = City::findOrFail($request->id);
        $governorates = Governorate::all();
        return view('dashboard.city.edit', compact('city', 'governorates'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'governorate_id' => 'required|numeric|gt:0'
        ], [
            'name.required' => 'الاسم مطلوب',
            'governorate_id.required' => ' المحافظة مطلوبة',
            'governorate_id.numeric' => ' المحافظة مطلوبة',
            'governorate_id.gt' => ' المحافظة مطلوبة',

        ]);
        $input = $request->all();
        $city = City::findOrFail($request->id);

        $city->update([
            'name' => $input['name'],
            'governorate_id' => $input['governorate_id'],
        ]);
        return response()->json(['success' => true, 'message' => 'تمت التعديل بنجاح']);
    }
    public function get_cities(Request $request)
    {
        $governorate = Governorate::findOrFail($request->governorate_id);

        $cities = $governorate->cities()->get() ;

        $response_array = [
            'success' => true,
            'cities' => $cities,
         
        ];
        return response()->json($response_array, 200);
        // return view('dashboard.city.edit', compact('cities', 'governorate'));
    }
    
}

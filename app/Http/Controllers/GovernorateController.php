<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
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
        $governorates=Governorate::paginate(10);
        return view('dashboard.governorate.index',compact('governorates'));
    }

    public function create()
    {
        
        return view('dashboard.governorate.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
        ],[
            'name.required'=>'الاسم مطلوب',
        ]);

        $input = $request->all();

        $saved = Governorate::create($input);
        return response()->json(['success'=>true, 'message'=>'تمت الاضافه بنجاح']);
    }
    public function edit(Request $request)
    {
        $governorate = Governorate::findOrFail($request->id);
        
        return view('dashboard.governorate.edit',compact('governorate'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
        ],[
            'name.required'=>'الاسم مطلوب',
        ]);

        $input = $request->all();
        $governorate = Governorate::findOrFail($request->id);

        $governorate->update(['name'=>$input['name']]);
        return response()->json(['success'=>true, 'message'=>'تمت التعديل بنجاح']);
    }
}

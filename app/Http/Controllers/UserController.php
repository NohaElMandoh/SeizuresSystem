<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
        $users = User::paginate(10);
        return view('dashboard.user.index', compact('users'));
    }

    public function create()
    {
        $governorates = Governorate::all();
        $cities = City::all();

        return view('dashboard.user.create', compact('cities', 'governorates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'الاسم مطلوب',
            'governorate_id.required' => ' المحافظة مطلوبة',
            'governorate_id.numeric' => ' المحافظة مطلوبة',
            'governorate_id.gt' => ' المحافظة مطلوبة',
            'email.required' => ' البريد الاليكترونى  مطلوب ',
            'password.confirmed' => ' كلمه السر غير متطابقة  ',
            'password.required' => ' كلمه السر مطلوبة   ',


        ]);

        if ($request->has('password')) {
            $request['password'] = Hash::make($request['password']);
        }
        $input = $request->all();

        $saved = User::create($input);
        return response()->json(['success' => true, 'message' => 'تمت الاضافه بنجاح']);
    }
    public function edit(Request $request)
    {
        $user = User::findOrFail($request->id);
        $governorates = Governorate::all();
        $cities = City::all();
        return view('dashboard.user.edit', compact('user', 'governorates', 'cities'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
            'password' => $request->id ? '' : 'required|confirmed',

        ], [
            'name.required' => 'الاسم مطلوب',
            'governorate_id.required' => ' المحافظة مطلوبة',
            'governorate_id.numeric' => ' المحافظة مطلوبة',
            'governorate_id.gt' => ' المحافظة مطلوبة',
            'email.required' => ' البريد الاليكترونى  مطلوب ',
            'password.confirmed' => ' كلمه السر غير متطابقة  ',


        ]);
        $user = User::findOrFail($request->id);

        // if($request->has('password'))
        // {
        //     $request[ 'password']= Hash::make($request['password']);

        // }else  $request[ 'password']= $user->password;

        $input = $request->all();

        $user->update([
            'name' => $input['name'],
            'email' => $input['email'],
            'governorate_id' => $input['governorate_id'],
            'phone' => $input['phone'],
            // 'password'=>$input['password'],
            'role_id' => $input['role_id'],

        ]);
        return response()->json(['success' => true, 'message' => 'تمت التعديل بنجاح']);
    }
    public function get_merchant(Request $request)
    {
        $merchant = Merchant::findOrFail($request->merchant_id);



        $response_array = [
            'success' => true,
            'merchant' => $merchant,
            'causes' => $merchant->causes()->get()
        ];
        return response()->json($response_array, 200);
        // return view('dashboard.city.edit', compact('cities', 'governorate'));
    }

    public function merchants(Request $request)
    {
        $user = User::findOrFail($request->id);
        $merchants = $user->merchants()->paginate(10);
        return view('dashboard.user.merchants', compact('user', 'merchants'));
    }
}

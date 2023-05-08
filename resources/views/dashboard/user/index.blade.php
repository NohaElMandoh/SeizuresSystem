@extends('dashboard.layouts.app')

@section('content')
<div class="row ">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2 text-dir-ltr">
        <a href="{{route('user.create')}}" class="btn btn-success flat fnt-xxs " style="width: fit-content;">إضافة جديد<div class="ripple-container"></div></a>
    </div>
</div>
<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2">
        <div class="card shade h-100">
            <div class="card-body">
                <h5 class="card-title">المستخدمين</h5>

                <hr>
                <table class="table table-striped" id='myTable'>
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:right">#</th>

                            <th scope="col" style="text-align:right">الاسم</th>
                            <th scope="col" style="text-align:right">البريد الاليكترونى </th>
                            <th scope="col" style="text-align:right">المحافظة</th>
                            <th scope="col" style="text-align:right">الهاتف</th>
                            <th scope="col" style="text-align:right">الصلاحية</th>

                            <th scope="col" style="text-align:right">الاحداث</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>

                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->governorate->name ?? '' }}</td>
                            <td>{{ $user->phone}}</td>
                            <td>@if($user->role_id ==1 ) مشرف @elseif($user->role_id ==2) مدير فرع @endif</td>
                            <td>
                                <a href="{{route('user.edit',['id'=> $user->id])}}" class="btn btn-primary flat fnt-xxs  " style="width: fit-content;">تعديل <div class="ripple-container"></div>
                                </a>
                                <a href="{{route('user.merchants',['id'=> $user->id])}}" class="btn btn-info flat fnt-xxs  " style="width: fit-content;">التجار <div class="ripple-container"></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div align="right" id="paglink">{{$users->appends(request()->input())->links('pagination::bootstrap-4')}}</div>

            </div>

        </div>
    </div>
</div>

@endsection
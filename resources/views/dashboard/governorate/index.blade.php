@extends('dashboard.layouts.app')

@section('content')
<div class="row ">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2 text-dir-ltr">
        <a href="{{route('governorate.create')}}" class="btn btn-success flat fnt-xxs " style="width: fit-content;">إضافة جديد<div class="ripple-container"></div></a>
    </div>
</div>
<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2">
        <div class="card shade h-100">
            <div class="card-body">
                <h5 class="card-title">المحافظات</h5>

                <hr>
                <table class="table table-striped" id='myTable'>
                    <thead>
                        <tr >
                            <th scope="col" style="text-align:right">#</th>
                            <th scope="col" style="text-align:right">الاسم</th>

                            <th scope="col" style="text-align:right">الاحداث</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($governorates as $governorate)
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <td>{{ $governorate->name}}</td>
                            <td><a href="{{route('governorate.edit',['id'=> $governorate->id])}}" class="btn btn-primary flat fnt-xxs " style="width: fit-content;">تعديل <div class="ripple-container"></div></a>
            </div>
            </td>

            </tr>
            @endforeach
            </tbody>
            </table>
            <div align="right" id="paglink">{{$governorates->appends(request()->input())->links('pagination::bootstrap-4')}}</div>

        </div>

    </div>
</div>
</div>

@endsection
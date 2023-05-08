@extends('dashboard.layouts.app')

@section('content')
<div class="row ">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2 text-dir-ltr">
        <a href="{{route('city.create')}}" class="btn btn-success flat fnt-xxs " style="width: fit-content;">إضافة جديد<div class="ripple-container"></div></a>
    </div>
</div>
<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2">
        <div class="card shade h-100">
            <div class="card-body">
                <h5 class="card-title">المدن</h5>

                <hr>
                <table class="table table-striped" id='myTable'>
                    <thead>
                        <tr >
                            <th scope="col" style="text-align:right">#</th>
                            <th scope="col" style="text-align:right">الاسم</th>
                            <th scope="col" style="text-align:right">المحافظة</th>
                            <th scope="col" style="text-align:right">الاحداث</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cities as $city)
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <td>{{ $city->name}}</td>
                            <td>{{ $city->governorate->name}}</td>

                            <td><a href="{{route('city.edit',['id'=> $city->id])}}" class="btn btn-primary flat fnt-xxs " style="width: fit-content;">تعديل <div class="ripple-container"></div></a>
            </div>
            </td>

            </tr>
            @endforeach
            </tbody>
            </table>
            <div align="right" id="paglink">{{$cities->appends(request()->input())->links('pagination::bootstrap-4')}}</div>

        </div>

    </div>
</div>
</div>

@endsection
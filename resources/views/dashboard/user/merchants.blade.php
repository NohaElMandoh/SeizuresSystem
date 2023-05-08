@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2">
        <div class="card shade h-100">
            <div class="card-body">
                <h5 class="card-title">التجار اللذين تم اضافتهم بواسطة {{$user->name}}</h5>

                <hr>
                <table class="table table-striped" id='myTable'>
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:right">#</th>
                            <th scope="col" style="text-align:right">رقم الهوية </th>
                            <th scope="col" style="text-align:right">الاسم</th>
                            <th scope="col" style="text-align:right">رقم المشغل </th>
                            <th scope="col" style="text-align:right">المحافظة</th>
                            <th scope="col" style="text-align:right">المدينة</th>
                            <th scope="col" style="text-align:right">الهاتف</th>
                            <th scope="col" style="text-align:right">الاحداث</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($merchants as $merchant)
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <td>{{ $merchant->unique_id}}</td>
                            <td>{{ $merchant->name}}</td>
                            <td>{{ $merchant->operator_id}}</td>
                            <td>{{ $merchant->governorate->name}}</td>
                            <td>{{ $merchant->city->name ?? '-'}}</td>
                            <td>{{ $merchant->mobile}}</td>
                            <td>
                                <a href="{{route('merchant.causes',['id'=> $merchant->id])}}" class="btn btn-primary flat fnt-xxs  " style="width: fit-content;">القضايا <div class="ripple-container"></div>
                                </a>
                                {{-- <a href="{{route('cause.create',['id'=> $merchant->id])}}" class="btn btn btn-info flat fnt-xxs mr-1"
                                style="width: fit-content;">اضافة قضية <div class="ripple-container"></div>
                                </a>--}}

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div align="right" id="paglink">{{$merchants->appends(request()->input())->links('pagination::bootstrap-4')}}</div>

            </div>

        </div>
    </div>
</div>

@endsection
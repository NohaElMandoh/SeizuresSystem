@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2">
        <div class="card shade h-100">
            <div class="card-body">
                <h5 class="card-title">القضايا التى تخص {{$merchant->name}}</h5>

                <hr>
                <table class="table table-striped" id='myTable'>
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:right">#</th>

                            <th scope="col" style="text-align:right"> رقم المحضر </th>
                            <th scope="col" style="text-align:right">رقم دفتر الضبط</th>
                            <th scope="col" style="text-align:right">مكان الضبط</th>
                            <th scope="col" style="text-align:right">نوع القضية</th>
                            <th scope="col" style="text-align:right">نوع المخالفة</th>
                            <th scope="col" style="text-align:right">نوع البضاعة</th>

                            <th scope="col" style="text-align:right">اسم التاجر </th>
                            <th scope="col" style="text-align:right">رقم هوية التاجر</th>

                            <th scope="col" style="text-align:right">الاحداث</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <td>{{ $d->bailiff_number}}</td>
                            <td>{{ $d->case_book_number}}</td>
                            <td>{{ $d->case_book_place}}</td>
                            <td>{{ $d->case_type_id}}</td>
                            <td>{{ $d->violation_type_id}}</td>
                            <td>{{ $d->goods_type_id}}</td>
                            <td>{{ $d->merchant->name}}</td>
                            <td>{{ $d->merchant->unique_id}}</td>

                            <td>
                                <a href="{{route('cause.seizure',['id'=> $d->id])}}" class="btn btn-primary flat fnt-xxs " 
                                style="width: fit-content;">المضبوطات <div class="ripple-container"></div></a>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div align="right" id="paglink">{{$data->appends(request()->input())->links('pagination::bootstrap-4')}}</div>

            </div>

        </div>
    </div>
</div>

@endsection
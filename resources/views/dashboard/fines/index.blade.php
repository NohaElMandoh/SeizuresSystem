@extends('dashboard.layouts.app')

@section('content')
<div class="row ">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2 text-dir-ltr">
        <a href="{{route('fines.create')}}" class="btn btn-success flat fnt-xxs " style="width: fit-content;">إضافة جديد<div class="ripple-container"></div></a>
    </div>
</div>
<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2">
        <div class="card shade h-100">
            <div class="card-body">
                <h5 class="card-title">الغرامات</h5>

                <hr>
                <table class="table table-striped" id='myTable'>
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:right">#</th>

                            <th scope="col" style="text-align:right">رقم وصل الغرامة </th>
                            <th scope="col" style="text-align:right">دفتر وصل الغرامة </th>
                            <th scope="col" style="text-align:right"> المبلغ</th>
                            <th scope="col" style="text-align:right"> رقم المحضر </th>
                            <th scope="col" style="text-align:right">رقم دفتر الضبط</th>
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
                            <td>{{ $d->price}}</td>
                            <td>{{ $d->cause->bailiff_number}}</td>
                            <td>{{ $d->cause->case_book_number}}</td>
                          
                            <td>{{ $d->merchant->name}}</td>
                            <td>{{ $d->merchant->unique_id}}</td>

                            <td>
                                <a href="{{route('fines.edit',['id'=> $d->id])}}" class="btn btn-primary flat fnt-xxs " 
                                style="width: fit-content;">تعديل <div class="ripple-container"></div></a>

                               
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
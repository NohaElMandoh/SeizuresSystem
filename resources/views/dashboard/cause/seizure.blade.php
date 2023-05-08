@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2">
        <div class="card shade h-100">
            <div class="card-body">
                <h5 class="card-title">ألمضبوطات التى تخص القضية رقم {{$cause-> bailiff_number}}</h5>

                <hr>
                <table class="table table-striped" id='myTable'>
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:right">#</th>

                            <th scope="col" style="text-align:right"> رقم الايصال </th>
                            <th scope="col" style="text-align:right">رقم دفتر الضبط</th>

                            <th scope="col" style="text-align:right">اسم التاجر </th>
                            <th scope="col" style="text-align:right">رقم هوية التاجر</th>

                         
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <td>{{ $d->bailiff_number}}</td>
                            <td>{{ $d->case_book_number}}</td>

                            <td>{{ $d->merchant->name}}</td>
                            <td>{{ $d->merchant->unique_id}}</td>

                            

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
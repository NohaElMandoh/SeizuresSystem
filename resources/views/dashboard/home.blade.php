@extends('dashboard.layouts.app')

@section('content')


                <!-- content -->
                <!-- breadcrumb -->

                <div class="row  m-1 pb-4 mb-3 ">
                    <div class="col-xs-12  col-sm-12  col-md-12  col-lg-12 p-2">
                        <div class="page-header breadcrumb-header ">
                            <div class="row align-items-end ">
                                <div class="col-lg-8">
                                    <div class="page-header-title text-left-rtl">
                                        <div class="d-inline">
                                            <h3 class="lite-text ">لوحه التحكم</h3>
                                            <span class="lite-text ">  الضبابطه الجمركيه </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item "><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item active">لوحه التحكم</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <!-- widget -->
                <div class="row m-1 mb-2">
                    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
                        <div class="box-card text-right mini animate__animated animate__flipInY   "><i
                                class="fab far fa-chart-bar b-first" aria-hidden="true"></i>
                            <span class="mb-1 c-first">التجار</span>
                            <span>{{$merchants_count->count()}}</span>
                        
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
                        <div class="box-card text-right mini animate__animated animate__flipInY    "><i
                                class="fab far fa-clock b-second" aria-hidden="true"></i>
                            <span class="mb-1 c-second">القضايا</span>
                            <span>{{$causes_count->count()}}</span>
                            
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
                        <div class="box-card text-right mini animate__animated animate__flipInY   "><i
                                class="fab far fa-comments b-third" aria-hidden="true"></i>
                            <span class="mb-1 c-third"> الغرامات</span>
                            <span>{{$fines_count->count()}}</span>
                           
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
                        <div class="box-card text-right mini animate__animated animate__flipInY   "><i
                                class="fab far fa-comments b-third" aria-hidden="true"></i>
                            <span class="mb-1 c-third"> المضبوطات</span>
                            <span>{{$seizures_count->count()}}</span>
                           
                        </div>
                    </div>
                </div>


        
            
@endsection

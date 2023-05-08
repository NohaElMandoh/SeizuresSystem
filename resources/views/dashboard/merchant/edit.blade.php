@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
        <div class="row align-items-end ">

            <div class="col-lg-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="#">تعديل تاجر </a></li>
                    <li class="breadcrumb-item active"><a href="{{route('home')}}">لوحه التحكم</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="jumbotron shade pt-5">


    <!-- form -->

    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">


            <h4 class="c-grey  pt-3 pb-3">تعديل تاجر</h4>
            <hr class="mt-0 mb-4">
            <form class="" id='contactForm'>
                @csrf
                <div class="row pt-4">
                    <div class="alert alert-danger " style="display:none">
                        <ul id='list'>

                        </ul>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <label for="name">اسم التاجر *</label>
                                <input type="hidden" name='merchant_id' id="merchant_id" value='{{$merchant->id}}'>

                                <input type="text" class="form-control " name='name' id="name" value="{{$merchant->name}}" require placeholder="اسم التاجر ">
                            </div>
                            <div class="col-4">
                                <label for="unique_id"> رقم هوية التاجر *</label>
                                <input type="number" class="form-control " name='unique_id' id="unique_id" value="{{$merchant->unique_id}}" readonly>
                            </div>
                            <div class="col-4">
                                <label for="operator_id"> رقم مشغل *</label>
                                <input type="text" class="form-control " name='operator_id' id="operator_id"  value="{{$merchant->operator_id}}" require placeholder="رقم مشغل ">
                            </div>
                        </div>
                        <div class="form-row align-items-center ">
                            <div class="col-4 ">
                                <label for="governorate_id">المحافظة *</label>


                                <select class="form-select form-control" id="governorate_id" name="governorate_id">
                                    <option selected value=0>اختر محافظة</option>
                                    @foreach($governorates as $governorate)
                                    <option value="{{ $governorate->id}}" @if($merchant->governorate_id == $governorate->id) selected @endif >{{ $governorate->name}}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-4">
                                <label for="name">المدينة *</label>


                                <select class="form-select form-control" id="city_id" name="city_id">
                                    <option selected value=0>اختر مدينة</option>
                                  

                                </select>

                            </div>
                            <div class="col-4">
                                <label for="mobile">الهاتف *</label>
                                <input type="text" class="form-control " name='mobile' id="mobile" value="{{$merchant->mobile}}" require placeholder="الهاتف  ">

                            </div>
                        </div>

                        <div class="form-row align-items-center ">
                            <div class="col-8 ">
                                <label for="name">العنوان *</label>
                                <input type="text" class="form-control " name='address' id="address" value="{{$merchant->address}}" require placeholder="العنوان  ">

                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0 mb-4">
                <div class="row pt-4 align-items-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-row align-items-center">
                            <div class="col-2">
                                <button type="submit" id='submit_btn' class="btn btn-block f-primary ">تعديل </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>


@endsection

@section('scripts')
<script type="text/javascript">
    $('#governorate_id').change(function() {

        let governorate_id = $(this).val();

        $.ajax({

            url: "{{route('city.get_cities')}}",
            type: "Get",
            data: {
                "_token": "{{ csrf_token() }}",

                governorate_id: governorate_id,

            },
            success: function(response) {

                $("#city_id").empty();
                str = "<option selected value=0>اختر مدينة</option>";
                    $("#city_id").append(str);
                $.each(response.cities, function(key, value) {

                    str = "<option value=" + value['id'] + ">" + value['name'] + "</option>";
                    $("#city_id").append(str);
                });

            },
            error: function(response) {
                $(".alert-success-message").css("display", "none");

                $(".alert-danger").css("display", "block");
                $("#list").empty();
                $.each(response.responseJSON.errors, function(key, value) {

                    str = "<li>" + value + "</li>";
                    $("#list").append(str);
                });
            },
        });
    });



    $('#submit_btn').on('click', function(event) {
        event.preventDefault();

        let name = $('#name').val();
        let governorate_id = $('#governorate_id').val();
        let unique_id = $('#unique_id').val();
        let operator_id = $('#operator_id').val();
        let city_id = $('#city_id').val();
        let mobile = $('#mobile').val();

        let address = $('#address').val();
        let id = $('#merchant_id').val();


        $.ajax({

            url: "{{route('merchant.update')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",

                name: name,
                governorate_id: governorate_id,
                unique_id: unique_id,
                operator_id: operator_id,
                city_id: city_id,
                mobile: mobile,
                address: address,
                id: id,



            },
            success: function(response) {
                $("#list").empty();
                $(".alert-danger").css("display", "none");
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                })

            },
            error: function(response) {
                $(".alert-success-message").css("display", "none");

                $(".alert-danger").css("display", "block");
                $("#list").empty();
                $.each(response.responseJSON.errors, function(key, value) {

                    str = "<li>" + value + "</li>";
                    $("#list").append(str);
                });
            },
        });
        // document.getElementById("contactForm").reset();
    });
</script>
@endsection
@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
        <div class="row align-items-end ">

            <div class="col-lg-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="#">تعديل مدينة </a></li>
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


            <h4 class="c-grey  pt-3 pb-3">تعديل مدينة</h4>
            <hr class="mt-0 mb-4">
            <form class="" id='contactForm'>
                @csrf
                <div class="row pt-4">
                    <div class="alert alert-danger " style="display:none">
                        <ul id='list'>

                        </ul>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-row align-items-center ">
                            <div class="col-12">
                                <label for="name">المحافظة </label>
                                <div class="col-4">

                                    <select class="form-select form-control" id="governorate_id" name="governorate_id">
                                        <option  value=0>اختر محافظة</option>
                                        @foreach($governorates as $governorate)
                                        <option value="{{ $governorate->id}}" @if($city->governorate_id == $governorate->id) selected @endif>{{ $governorate->name}}</option>
                                        @endforeach
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <label for="name">اسم المدينة </label>
                                <input type="hidden" name='city_id' id="city_id" value='{{$city->id}}'>
                                <input type="text" class="form-control " name='name' id="name" require placeholder="الاسم" value="{{$city->name}}">
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
    $('#submit_btn').on('click', function(event) {
        event.preventDefault();

        let name = $('#name').val();
        let id = $('#city_id').val();
        let  governorate_id=$('#governorate_id').val();
        $.ajax({

            url: "{{route('city.update')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",

                name: name,
                id: id,
                governorate_id:governorate_id
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
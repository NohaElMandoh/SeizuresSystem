@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
        <div class="row align-items-end ">

            <div class="col-lg-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="#">تعديل مستخدم </a></li>
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


            <h4 class="c-grey  pt-3 pb-3">تعديل مستخدم</h4>
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
                                <label for="name">اسم المستخدم *</label>
                                <input type="hidden" name='user_id' id="user_id" value='{{$user->id}}'>

                                <input type="text" class="form-control " name='name' id="name" value="{{$user->name}}" require placeholder="اسم المستخدم ">
                            </div>
                            <div class="col-4">
                                <label for="email"> البريد الاليكترونى *</label>
                                <input type="Email" class="form-control " name='email' id="email" value="{{$user->email}}" require placeholder=" البريد الاليكترونى   " >
                            </div>
                            <div class="col-4">
                                <label for="phone"> رقم الهاتف *</label>
                                <input type="text" class="form-control " name='phone' id="phone" value="{{$user->phone}}" require placeholder="رقم الهاتف ">
                            </div>
                            <div class="col-4 ">
                                <label for="governorate_id">المحافظة *</label>


                                <select class="form-select form-control" id="governorate_id" name="governorate_id">
                                    <option selected value=0>اختر محافظة</option>
                                    @foreach($governorates as $governorate)
                                    <option value="{{ $governorate->id}}" @if($user->governorate_id == $governorate->id) selected @endif >{{ $governorate->name}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-4 ">
                                <label for="role_id">دور المستخدم *</label>

                                <select class="form-select form-control" id="role_id" name="role_id">

                                    <option value="1" @if($user->role_id == 1) selected @endif >مشرف</option>
                                    <option value="2" @if($user->role_id == 2) selected @endif > مدير فرع</option>

                                </select>

                            </div>
                        </div>
                    {{--  <div class="form-row align-items-center ">
                            <div class="col-4 ">
                                <label for="password">كلمة السر *</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            </div>

                            <div class="col-4 ">
                                <label for="password">تأكيد كلمة السر  *</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            </div>

                        </div>--}}


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
        let email = $('#email').val();
        let governorate_id = $('#governorate_id').val();
        let role_id = $('#role_id').val();
        let phone = $('#phone').val();
        // let password = $('#password').val();

        // let password_confirmation = $('#password-confirm').val();

        let id = $('#user_id').val();

        $.ajax({

            url: "{{route('user.update')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",

                name: name,
                email: email,
                governorate_id: governorate_id,
                role_id: role_id,
                phone: phone,
                // password: password,
                // password_confirmation: password_confirmation,

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
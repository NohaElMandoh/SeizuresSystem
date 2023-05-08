@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
        <div class="row align-items-end ">

            <div class="col-lg-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="#">إضافة قضية </a></li>
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


            <h4 class="c-grey  pt-3 pb-3">إضافة قضية</h4>
            <hr class="mt-0 mb-4">
            <form class="" id='contactForm'>
                @csrf
                <div class="row pt-4">
                    <div class="alert alert-danger " style="display:none">
                        <ul id='list'>

                        </ul>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @if($merchant)
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <label for="name">اسم التاجر *</label>
                                <input type="text" class="form-control " name='name' id="name" require value='{{$merchant->name}}' readonly placeholder="اسم التاجر ">
                                <input type="hidden" name='merchant_id' id="merchant_id" value='{{$merchant->id}}'>

                            </div>
                            <div class="col-4">
                                <label for="unique_id"> رقم هوية التاجر *</label>
                                <input type="text" class="form-control " name='unique_id' id="unique_id" value='{{$merchant->unique_id}}' readonly>
                            </div>

                        </div>
                        @else
                        <div class="form-row align-items-center">
                            <div class="col-4">

                                <label for="merchant_name"> التاجر *</label>


                                <select class="form-select form-control" id="merchant_name" name="merchant_name">
                                    <option selected value=0>اختر تاجر </option>

                                    @foreach($merchants as $merchant)
                                    <option value='{{$merchant->id}}'> {{$merchant->name}}</option>
                                    @endforeach
                                </select>


                            </div>
                            <div class="col-4">
                                <label for="unique_id_2"> رقم هوية التاجر *</label>
                                <input type="text" class="form-control " name='unique_id_2' id="unique_id_2" value='' readonly>
                                <input type="hidden" name='merchant_id' id="merchant_id">

                            </div>

                        </div>
                        @endif
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <label for="bailiff_number">رقم المحضر *</label>
                                <input type="number" class="form-control " name='bailiff_number' id="bailiff_number" require placeholder="رقم المحضر ">
                            </div>
                            <div class="col-4">
                                <label for="case_book_number"> دفتر الضبط *</label>
                                <input type="text" class="form-control " name='case_book_number' id="case_book_number" readonly>
                            </div>
                            <div class="col-4">
                                <label for="case_book_place"> مكان الضبط *</label>
                                <input type="text" class="form-control " name='case_book_place' id="case_book_place" value='{{Auth::user()->governorate->name}}' readonly>
                            </div>
                        </div>
                        <div class="form-row align-items-center ">
                            <div class="col-12  ">
                                <label for="case_book_place"> الإجراء المستخدم *</label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class='action_token' id="customRadioInline1" value='محجوز' name="action_token" class="custom-control-input">
                                    <label for="customRadioInline1">محجوز</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class='action_token' id="customRadioInline2" value='مصادر' name="action_token" class="custom-control-input">
                                    <label for="customRadioInline2">مصادر</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class='action_token' id="customRadioInline3" value='إتلاف' name="action_token" class="custom-control-input">
                                    <label for="customRadioInline3">إتلاف</label>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="form-row align-items-center ">
                            <div class="col-4  ">
                                <label for="violation_type_id">نوع المخالفة *</label>


                                <select class="form-select form-control" id="violation_type_id" name="violation_type_id">
                                    <option selected value=0>حدد نوع المخالفه</option>
                                    <option selected value=1>مخالفه 1 </option>
                                    <option selected value=2>مخالفه 2 </option>
                                </select>

                            </div>

                            <div class="col-4">
                                <label for="case_type_id">نوع القضية *</label>

                                <select class="form-select form-control" id="case_type_id" name="case_type_id">
                                    <option selected value=0>حدد نوع القضية</option>
                                    <option selected value=1> 1القضية</option>
                                    <option selected value=2> 2القضية</option>
                                </select>

                            </div>
                            <div class="col-4">
                                <label for="name">نوع البضاعه *</label>

                                <select class="form-select form-control" id="goods_type_id" name="goods_type_id">
                                    <option selected value=0>حدد نوع البضاعه</option>
                                    <option selected value=1> 1البضاعه</option>
                                    <option selected value=2> 2البضاعه</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-row align-items-center ">
                            <div class="col-4">
                                <label for="picture">صورة *</label>

                                <input type="file" name="picture" class="form-control" id="picture" value="{{ old('picture') }}" accept="image/*" onchange="loadFile(this,'image_preview')" tabindex="13">
                            </div>
                            <div class="col-8 ">
                                <img style="height:300px;weight: 300px;margin-top:5px" id="image_preview" src="  ">
                            </div>

                        </div>

                        <div class="form-row align-items-center ">
                            <div class="col-12  ">
                                <label for="notes">ملاحظات </label>
                                <textarea class="form-control" rows="10" id="notes" name="notes"></textarea>

                            </div>
                        </div>

                    </div>
                </div>
                <hr class="mt-0 mb-4">
                <div class="row pt-4 align-items-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-row align-items-center">
                            <div class="col-2">
                                <button type="submit" id='submit_btn' class="btn btn-block f-primary ">اضافه</button>
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
    function loadFile(event, id) {

        $('#' + id).show();

        var reader = new FileReader();

        reader.onload = function() {

            var output = document.getElementById(id);

            output.src = reader.result;
        };

        reader.readAsDataURL(event.files[0]);
    }
    $('#merchant_name').change(function() {

        let merchant_id = $(this).val();

        $.ajax({

            url: "{{route('merchant.get_merchant')}}",
            type: "Get",
            data: {
                "_token": "{{ csrf_token() }}",

                merchant_id: merchant_id,

            },
            success: function(response) {

                console.log(response.merchant['unique_id']);
                $("#unique_id_2").val(response.merchant['unique_id']);
                $("#merchant_id").val(response.merchant['id']);

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

    function number_test(n) {
        var result = (n - Math.floor(n)) !== 0;

        if (result)
            return true; //'Number has a decimal place.'
        else
            return false; //'It is a whole number.';
    }
    $("#bailiff_number").change(function() {
        event.preventDefault();

        let bailiff_number = $(this).val();
        let case_book_number = $(this).val() / 25;
        let number_test2 = number_test(case_book_number);



        if (number_test2) {
            let int_part = Math.trunc(case_book_number); // returns 3
            $('#case_book_number').val(int_part + 1);
        } else $('#case_book_number').val(case_book_number);
    });


    $('#submit_btn').on('click', function(event) {
        event.preventDefault();

       

        data = new FormData();
        data.append('picture', $('#picture')[0].files[0]);
        data.append('merchant_id', $('#merchant_id').val());
        data.append('bailiff_number', $('#bailiff_number').val());
        data.append('case_book_number', $('#case_book_number').val());
        data.append('case_book_place', $('#case_book_place').val());
        data.append('case_type_id', $('#case_type_id').val());
        data.append('violation_type_id', $('#violation_type_id').val());
        data.append('goods_type_id', $('#goods_type_id').val());
        data.append('notes', $('#notes').val());
        data.append('action_token', $('#action_token').val());


        $.ajax({

            url: "{{route('cause.store')}}",
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            dataType: 'json',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
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
        document.getElementById("contactForm").reset();
    });
</script>
@endsection
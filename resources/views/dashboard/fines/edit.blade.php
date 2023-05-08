@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
        <div class="row align-items-end ">

            <div class="col-lg-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="#">إضافة غرامة </a></li>
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


            <h4 class="c-grey  pt-3 pb-3">تعديل غرامة</h4>
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
                                <label for="bailiff_number">رقم وصل الغرامة *</label>
                                
                                <input type="hidden" name='fines_id' id="fines_id" value='{{$fines->id}}'>

                                <input type="number" class="form-control " name='bailiff_number' id="bailiff_number" value='{{$fines->bailiff_number}}' readonly>
                            </div>
                            <div class="col-4">
                                <label for="case_book_number"> دفتر وصل الغرامة *</label>
                                <input type="text" class="form-control " name='case_book_number' id="case_book_number" value='{{$fines->case_book_number}}' readonly>
                            </div>
                            <div class="col-4">
                                <label for="price"> المبلغ*</label>
                                <input type="number" step="0.01" class="form-control " name='price' id="price" value='{{$fines->price}}' require placeholder="المبلغ    ">
                            </div>
                        </div>
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

                        @endif
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <label for="bailiff_number">رقم المحضر *</label>
                                <input type="hidden" name='cause_id' id="cause_id" value="{{$fines->cause->id}}">

                                <!-- <input type="number" class="form-control " name='bailiff_number' id="bailiff_number" require placeholder="رقم المحضر "> -->
                                <select class="form-select form-control" id="cause_bailiff_number" name="cause_bailiff_number">

                                    <option>حدد المحضر</option>
                                    @foreach($merchant->causes as $cause)
                                    <option value='{{$cause->id}}' @if($fines->cause_id ==$cause->id ) selected @endif >{{$cause->bailiff_number}}</option>
                                    @endforeach
                                </select>


                            </div>
                            <div class="col-4">
                                <label for="cause_case_book_number"> دفتر دفتر الضبط *</label>
                                <input type="text" class="form-control " name='cause_case_book_number' id="cause_case_book_number" value='{{$fines->cause->case_book_number}}' readonly>
                            </div>

                        </div>
                    </div>
                </div>
                <hr class="mt-0 mb-4">
                <div class="row pt-4 align-items-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-row align-items-center">
                            <div class="col-2">
                                <button type="submit" id='submit_btn' class="btn btn-block f-primary ">تعديل</button>
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


                $("#unique_id_2").val(response.merchant['unique_id']);
                $("#merchant_id").val(response.merchant['id']);
                $("#cause_bailiff_number").empty();

                if ($.trim(response.causes) == null || $.trim(response.causes) == '') {

                    str = "<option >لا يوجد </option>";
                    $("#cause_bailiff_number").append(str);

                } else {
                    str = "<option value=0>اختر محضر</option>";
                    $.each(response.causes, function(key, value) {

                        str += "<option value=" + value['id'] + ">" + value['bailiff_number'] + "</option>";
                        $("#cause_bailiff_number").append(str);

                    });
                }

            },
            error: function(response) {

            },
        });
    });
    $('#cause_bailiff_number').change(function() {

        let cause_id = $(this).val();

        $.ajax({

            url: "{{route('city.get_cause')}}",
            type: "Get",
            data: {
                "_token": "{{ csrf_token() }}",

                cause_id: cause_id,

            },
            success: function(response) {


                $("#cause_case_book_number").val(response.cause['case_book_number']);
                $("#cause_id").val(response.cause['id']);


            },
            error: function(response) {

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

        let merchant_id = $('#merchant_id').val();
        let bailiff_number = $('#bailiff_number').val();
        let case_book_number = $('#case_book_number').val();
        let price = $('#price').val();
        let cause_id = $('#cause_id').val();
        let fines_id = $('#fines_id').val();



        $.ajax({

            url: "{{route('fines.update')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",

                merchant_id: merchant_id,
                bailiff_number: bailiff_number,
                case_book_number: case_book_number,
                price: price,
                cause_id: cause_id,
                fines_id:fines_id

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
        document.getElementById("contactForm").reset();
    });
</script>
@endsection
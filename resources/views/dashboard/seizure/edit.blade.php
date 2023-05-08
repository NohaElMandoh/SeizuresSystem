@extends('dashboard.layouts.app')

@section('content')

<div class="row">
    <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
        <div class="row align-items-end ">

            <div class="col-lg-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="#">تعديل مضبوطات </a></li>
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


            <h4 class="c-grey  pt-3 pb-3">تعديل مضبوطات</h4>
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
                                <input type="hidden" name='seizure_id' id="seizure_id" value='{{$seizure->id}}'>

                            </div>
                            <div class="col-4">
                                <label for="unique_id"> رقم هوية التاجر *</label>
                                <input type="text" class="form-control " name='unique_id' id="unique_id" value='{{$merchant->unique_id}}' readonly>
                            </div>

                        </div>

                        @endif
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <label for="bailiff_number">رقم ايصال المضبوطات *</label>
                                <input type="text" class="form-control " name='bailiff_number' id="bailiff_number" value="{{$seizure->bailiff_number}}" readonly>
                            </div>
                            <div class="col-4">
                                <label for="case_book_number"> دفتر الضبط *</label>
                                <input type="text" class="form-control " name='case_book_number' id="case_book_number" value="{{$seizure->case_book_number}}" readonly>
                            </div>

                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <label for="bailiff_number">رقم المحضر *</label>
                                <input type="hidden" name='cause_id' id="cause_id">

                                <!-- <input type="number" class="form-control " name='bailiff_number' id="bailiff_number" require placeholder="رقم المحضر "> -->
                                <select class="form-select form-control" id="cause_bailiff_number" name="cause_bailiff_number">
                                <option>حدد المحضر</option>
                                @foreach($merchant->causes as $cause)
<option value='{{$cause->id}}' @if($seizure->cause_id ==$cause->id ) selected @endif >{{$cause->bailiff_number}}</option>
@endforeach

                                </select>


                            </div>
                            <div class="col-4">
                                <label for="cause_case_book_number"> دفتر دفتر الضبط *</label>
                                <input type="text" class="form-control " name='cause_case_book_number' id="cause_case_book_number" value='{{$seizure->cause->case_book_number}}' readonly>
                            </div>

                        </div>

                        <div class="form-row align-items-center ">
                            <div class="col  ">
                                <label for="notes">الصنف </label>
                                <input type="text" class="form-control " name='unit_name' id="unit_name" require placeholder="الصنف    ">

                            </div>
                            <div class="col  ">
                                <label for="quantity">الكمية </label>
                                <input type="text" class="form-control " name='quantity' id="quantity" require placeholder="الكمية    ">

                            </div>
                            <div class="col  ">
                                <label for="weight">الوزن </label>
                                <input type="text" class="form-control " name='weight' id="weight" require placeholder="الوزن    ">

                            </div>
                            <div class="col  ">
                                <label for="unit_type">الوحدة </label>
                                <input type="text" class="form-control " name='unit_type' id="unit_type" require placeholder="الوحدة    ">

                            </div>
                            <div class="col  ">

                                <button type="button" class="btn btn-success units_btn">إضافة صنف</button>
                            </div>
                        </div>
                        <div class="form-row align-items-center " style='display:none' id='units_div'>
                            <div class="col-xs-1 col-sm-1 col-md-8 col-lg-12 p-2">
                                <div class="card shade h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">الأصناف</h5>

                                        <hr>
                                        <table class="table table-striped" id='units_table'>
                                            <thead>
                                                <tr>

                                                    <th scope="col">الصنف</th>
                                                    <th scope="col">الكمية</th>
                                                    <th scope="col">الوزن</th>
                                                    <th scope="col">الوحدة</th>
                                                    <th scope="col">أحداث</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($seizure->units)>0)
                                                @foreach( $seizure->units as $unit)
                                                <tr>
                                                    <td>
                                                        <p>
                                                            {{$unit->unit_name}}

                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{$unit->quantity}}

                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{$unit->weight}}

                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{$unit->unit_type}}

                                                        </p>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger f_delete" title=""><i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
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
    $(document).ready(function() {
        // alert($('#units_table tr').length);
        if ($('#units_table tr').length >= 2) {
            $("#units_div").css("display", "block");
            $('#units_div').slideDown();
        }
    });
    $('.units_btn').click(function() {

        $('#units_table > tbody').append('<tr><td><p>' + $('#unit_name').val() + '</td><td><p>' + $('#quantity').val() +
            '</td><td><p>' + $('#weight').val() + '</td><td><p>' + $('#unit_type').val() +
            '</td> <td> ' +
            '<button  type="button" class="btn btn-danger f_delete" title="Add Mor Emails"><i class="far fa-trash-alt"></i> </button></td></tr>');
        if ($('#units_table tr').length >= 2) {
            $("#units_div").css("display", "block");
            $('#units_div').slideDown();
        } else {
            $('#units_div').slideUp();
        }

    });

    $('#units_table').on('click', '.f_delete', function(e) {
        $(this).closest('tr').remove()
    })
    let keyword_arr = new Array();;

    function getFirstTableData() {
        $('#units_table').find('tr').each(function(i, el) {

            if (i > 0) {

                var $tds = $(this).find('td'),
                    // unit_name = $tds.eq(0).text(),
                    unit_name = $tds.eq(0).text(),
                    quantity = $tds.eq(1).text();
                weight = $tds.eq(2).text();
                unit_type = $tds.eq(3).text();


                item = new Object();
                item["unit_name"] = unit_name;
                item["quantity"] = quantity;
                item["weight"] = weight;
                item["unit_type"] = unit_type;


                keyword_arr.push(item);

            }

        });
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

    $('#submit_btn').on('click', function(event) {
        event.preventDefault();

        getFirstTableData();

        let merchant_id = $('#merchant_id').val();
        let seizure_id = $('#seizure_id').val();
        let bailiff_number = $('#bailiff_number').val();
        let case_book_number = $('#case_book_number').val();

        let units = JSON.stringify(keyword_arr);

        let cause_id = $('#cause_id').val();

        $.ajax({

            url: "{{route('seizure.update')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",

                merchant_id: merchant_id,
                seizure_id: seizure_id,
                case_book_number: case_book_number,
                cause_id: cause_id,

                units: units

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
        // $('#units_table').remove();


        // $('#units_div').slideUp();
    });
</script>
@endsection
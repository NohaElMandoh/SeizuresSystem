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
                                <input type="text" class="form-control " name='name' id="name" require value='{{$merchant->name}}' readonly placeholder="اسم التاجر ">
                                <input type="hidden" name='merchant_id' id="merchant_id" value='{{$merchant->id}}'>

                            </div>
                            <div class="col-4">
                                <label for="unique_id"> رقم هوية التاجر *</label>
                                <input type="text" class="form-control " name='unique_id' id="unique_id" value='{{$merchant->unique_id}}' readonly>
                            </div>

                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <label for="bailiff_number">رقم المحضر *</label>
                                <input type="text" class="form-control " name='bailiff_number' id="bailiff_number" value='{{$cause->bailiff_number}}' require placeholder="رقم المحضر ">
                                <input type="hidden" name='cause_id' id="cause_id" value='{{$cause->id}}'>
                            
                            </div>
                            <div class="col-4">
                                <label for="case_book_number"> دفتر الضبط *</label>
                                <input type="text" class="form-control " name='case_book_number' id="case_book_number" value='{{$cause->case_book_number}}' readonly>
                            </div>
                            <div class="col-4">
                                <label for="case_book_place"> مكان الضبط *</label>
                                <input type="text" class="form-control " name='case_book_place' id="case_book_place"  value='{{Auth::user()->governorate->name}}' readonly>
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
                                <img style="height:100%;weight: 100%;margin-top:5px" id="image_preview" src="@if($cause->picture){{url('/'.$cause->picture)}} @endif  ">
                            </div>

                        </div>
                        <div class="form-row align-items-center ">
                            <div class="col-12  ">
                                <label for="notes">ملاحظات  </label>
                                <textarea class="form-control" rows="10" id="notes" name="notes">{{$cause->notes}}</textarea>

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
       function loadFile(event, id) {

$('#' + id).show();

var reader = new FileReader();

reader.onload = function() {

    var output = document.getElementById(id);

    output.src = reader.result;
};

reader.readAsDataURL(event.files[0]);
}
    $('#submit_btn').on('click', function(event) {
        event.preventDefault();

        
        data = new FormData();
        data.append('picture', $('#picture')[0].files[0]);
        data.append('merchant_id', $('#merchant_id').val());
        data.append('cause_id', $('#cause_id').val());

        data.append('bailiff_number', $('#bailiff_number').val());
        data.append('case_book_number', $('#case_book_number').val());
        data.append('case_book_place', $('#case_book_place').val());
        data.append('case_type_id', $('#case_type_id').val());
        data.append('violation_type_id', $('#violation_type_id').val());
        data.append('goods_type_id', $('#goods_type_id').val());
        data.append('notes', $('#notes').val());
        data.append('action_token', $('#action_token').val());
        $.ajax({

            url: "{{route('cause.update')}}",
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
<div id="dw-s1" class="bmd-layout-drawer bg-faded ">

    <div class="container-fluid side-bar-container ">
        <header class="pb-0">
            <a class="navbar-brand ">

                الضبابطه الجمركيه
            </a>
        </header>
        <!-- <p class="side-comment  fnt-mxs">لوحه التحكم</p> -->
        <li class="side a-collapse short m-2 pr-1 pl-1">
            <a href="{{route('home')}}" class="side-item selected c-dark "><i class="fas fa-language  mr-1"></i>لوحة التحكم </a>
        </li>
        <ul class="side a-collapse short @if(Auth::user()->role_id == 2) d-none @endif ">
            <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> المستخدمين
                <!-- <span class="badge badge-info">4</span> -->
                <i class="fas fa-chevron-down arrow"></i></a>
            <div class="side-item-container hide animated">
                <li class="side-item "><a href="{{route('user.index')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>الكل </a>
                </li>
                <li class="side-item "><a href="{{route('user.create')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>إضافة </a>
                </li>

            </div>
        </ul>
        <ul class="side a-collapse short ">
            <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> التجار
                <!-- <span class="badge badge-info">4</span> -->
                <i class="fas fa-chevron-down arrow"></i></a>
            <div class="side-item-container hide animated">
                <li class="side-item "><a href="{{route('merchant.index')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>الكل </a>
                </li>
                <li class="side-item "><a href="{{route('merchant.create')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>إضافة </a>
                </li>

            </div>
        </ul>
        <ul class="side a-collapse short ">
            <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> القضايا
                <!-- <span class="badge badge-info">4</span> -->
                <i class="fas fa-chevron-down arrow"></i></a>
            <div class="side-item-container hide animated">
                <li class="side-item "><a href="{{route('cause.index')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>الكل </a>
                </li>
                <li class="side-item "><a href="{{route('cause.create')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>اضافة </a>
                </li>
            </div>
        </ul>


       
        <ul class="side a-collapse short ">
            <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> المضبوطات
                <!-- <span class="badge badge-info">4</span> -->
                <i class="fas fa-chevron-down arrow"></i></a>
            <div class="side-item-container hide animated">
                <li class="side-item "><a href="{{route('seizure.index')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>الكل </a>
                </li>
                <li class="side-item "><a href="{{route('seizure.create')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>إضافة </a>
                </li>
            </div>
        </ul>

        <ul class="side a-collapse short ">
            <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> الغرامات
                <!-- <span class="badge badge-info">4</span> -->
                <i class="fas fa-chevron-down arrow"></i></a>
            <div class="side-item-container hide animated">

                <li class="side-item "><a href="{{route('fines.index')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>الكل </a>
                </li>

                <li class="side-item "><a href="{{route('fines.create')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>إضافة </a>
                </li>
               
            </div>
        </ul>

        <ul class="side a-collapse short  @if(Auth::user()->role_id == 2) d-none @endif ">
            <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> المحافظات
                <!-- <span class="badge badge-info">4</span> -->
                <i class="fas fa-chevron-down arrow"></i></a>
            <div class="side-item-container hide animated">
                <li class="side-item "><a href="{{route('governorate.index')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>الكل </a>
                </li>
                <li class="side-item "><a href="{{route('governorate.create')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>إضافة </a>
                </li>



            </div>
        </ul>

        <ul class="side a-collapse short  @if(Auth::user()->role_id == 2) d-none @endif ">
            <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> المدن
                <!-- <span class="badge badge-info">4</span> -->
                <i class="fas fa-chevron-down arrow"></i></a>
            <div class="side-item-container hide animated">
                <li class="side-item "><a href="{{route('city.index')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>الكل </a>
                </li>
                <li class="side-item "><a href="{{route('city.create')}}" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>إضافة </a>
                </li>



            </div>
        </ul>
    </div>

</div>
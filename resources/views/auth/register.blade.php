<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Блог - Регистрация</title>

    <!-- Icons font CSS-->
    <link href="{{URL::asset('mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('fonts/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('css/bootstrap.css')}}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{URL::asset('select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{URL::asset('css/main.css')}}" rel="stylesheet" media="all">
</head>

<body>

    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"><p class="card-link"><a href="/login" class="font-poppins" style="padding-top: 50px;color: #fff;">Уже есть аккаунт?</a></p></div>
                <div class="card-body">
                    <h2 class="title">Регистрация</h2>
                    <form action="{{route('register-user')}}"  method="POST">
                        @csrf
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Имя" name="name" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3 js-datepicker" type="text" placeholder="Дата рождения" name="birthday-date" required>
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search" style="width: 100%;">
                                <select name="gender" required>
                                    <option disabled="disabled" selected="selected">Пол</option>
                                    <option value="male">Мужской</option>
                                    <option value="female">Женский</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="email" placeholder="Email" value="{{ old('email') }}" name="email" autocomplete="email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Пароль" value="{{ old('password') }}" name="password" autocomplete="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit">Зарегистрироваться</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
    <!-- Vendor JS-->
    <script src="{{URL::asset('select2/select2.min.js')}}"></script>
    <script src="{{URL::asset('datepicker/moment.min.js')}}"></script>
    <script src="{{URL::asset('datepicker/daterangepicker.js')}}"></script>

    <!-- Main JS-->
    <script src="{{URL::asset('js/global.js')}}"></script>
@if(UINotification::get('success'))
    <?php Alert::success(UINotification::get('success')); UINotification::clean('success');
    ?>
@endif
@if(UINotification::get('warning'))
    <?php Alert::warning(UINotification::get('warning'));UINotification::clean('warning');?>
@endif
@if(UINotification::get('error'))
    <?php Alert::error(UINotification::get('error'));UINotification::clean('error');?>
@endif
</body>

</html>
<!-- end document-->
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập Sinh Viên</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/login.css') }}">
    <script src='https://cdn.jsdelivr.net/npm/vue'></script>
</head>

<body id="particle">
    <div class="container">
        <div id="form">
            <h2>
                @if (Session::has('error'))
                <a href="#">{{ Session::get('error') }}</a>
                @else
                <a href="#">Sign In</a>
                @endif
            </h2>
            <form @submit="checkForm" id="formLogin" method="POST">
                @csrf
                <div class="form-group">
                    <label for="account">Account
                        <span><i>@{{ errors.account }}</i></span>
                    </label>
                    <div class="form-group-left">
                        <span><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input type="text" v-model="account" id="account" placeholder="Enter Account" autocomplete="off" name="account" {{-- value="
                        @if (Cookie::has('rem_email'))
                            {{ Cookie::get('rem_email') }} @endif" --}}>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password
                        <span><i>@{{ errors.password }}</i></span>
                    </label>
                    <div class="form-group-left">
                        <span><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input type="password" v-model="password" id="password" placeholder="Enter Password" autocomplete="off" name="password" {{-- value="
                        @if (Cookie::has('rem_password'))
                            {{ Cookie::get('rem_password') }} @endif" --}}>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember" {{-- value="
                        @if (Cookie::has('rem_email'))
                            {{ checked }} @endif" --}}>Remember Me
                    </label>
                    <button type="submit">Sign In</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('public/vue/check_form_student_login.js') }}"></script>
    <script src="https://kit.fontawesome.com/4ca587dd72.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/particles.js') }}"></script>
    <script src="{{ asset('public/js/login.js') }}"></script>
</body>

</html>

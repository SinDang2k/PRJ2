<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
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
                <a href="#">Admin</a>
                @endif
            </h2>
            <form @submit="checkForm" id="formLogin" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">E-Mail
                        <span><i>@{{ errors.email }}</i></span>
                    </label>
                    <div class="form-group-left">
                        <span><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input type="text" id="email" placeholder="Enter E-Mail" autocomplete="off" v-model="email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password
                        <span><i>@{{ errors.password }}</i></span>
                    </label>
                    <div class="form-group-left">
                        <span><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input type="password" id="password" placeholder="Enter Password" autocomplete="off"
                            v-model="password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember" id="remember" value="1">Remember Me
                    </label>
                    <button type="submit">Sign In</button>
                </div>
            </form>
            <p>Forgot password? <a href="{{ route('forgot_password') }}">Click Here</a></p>
        </div>
        <div id="sidenav" class="sidenav">
            <a href="{{ route('teacher.getLogin') }}" id="bar2">Teacher</a>
        </div>
    </div>
    <script src="{{ asset('public/vue/check_form_admin_login.js') }}"></script>
    <script src="https://kit.fontawesome.com/4ca587dd72.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/particles.js') }}"></script>
    <script src="{{ asset('public/js/login.js') }}"></script>
</body>

</html>

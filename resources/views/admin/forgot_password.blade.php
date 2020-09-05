
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Forgot Password | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="https://gurayyarar.github.io/AdminBSBMaterialDesign/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="https://gurayyarar.github.io/AdminBSBMaterialDesign/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="https://gurayyarar.github.io/AdminBSBMaterialDesign/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="https://gurayyarar.github.io/AdminBSBMaterialDesign/css/style.css" rel="stylesheet">
</head>

<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b> Quên mật khẩu</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" action="{{ route('send_email_forgot_password') }}" method="POST">
                    @csrf
                    <div class="msg">
                       Nhập email của bạn vào đây chúng tôi sẽ gửi cho bạn 1 đường link để thay đổi password
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                        <span id="err" style="color:#E91E63; font-size:11px"></span>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Đổi mật khẩu</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="{{ route('admin.getLogin') }}">Đăng Nhập!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="https://gurayyarar.github.io/AdminBSBMaterialDesign/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="https://gurayyarar.github.io/AdminBSBMaterialDesign/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="https://gurayyarar.github.io/AdminBSBMaterialDesign/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="https://gurayyarar.github.io/AdminBSBMaterialDesign/js/admin.js"></script>

    <script>
        var err=0;
        $(document).ready(function () {
            $("#forgot_password").keyup(function (e) {
                let regex_email= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if($("#email").val()=='')
                {
                    err=1;
                }
                else if(regex_email.test($("#email").val())==false)
                {
                    err=1;
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "{{route('check_exist_email_admin')}}",
                        data: {
                            email:$("#email").val(),
                            _token:"{{csrf_token()}}",
                        },
                        dataType: "JSON",
                        success: function (response) {
                            console.log(response);
                            if(response.length==0)
                            {
                                $("#err").html("Email này không tồn tại");
                                err=1;
                            }
                            else{
                                $("#err").html("");
                                err=0;
                            }
                        }
                    });
                }
            });
            $("#forgot_password").submit(function (e) {
                if(err==1)
                {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>

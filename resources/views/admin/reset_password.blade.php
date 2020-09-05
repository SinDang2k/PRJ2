<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <style>
        /* Fonts */
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400);

/* fontawesome */
@import url(http://weloveiconfonts.com/api/?family=fontawesome);
[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

/* Simple Reset */
* { margin: 0; padding: 0; box-sizing: border-box; }

/* body */
body {
  background: #e9e9e9;
  color: #5e5e5e;
  font: 400 87.5%/1.5em 'Open Sans', sans-serif;
}

/* Form Layout */
.form-wrapper {
  background: #fafafa;
  margin: 3em auto;
  padding: 0 1em;
  max-width: 370px;
}

h1 {
  text-align: center;
  padding: 1em 0;
}

form {
  padding: 0 1.5em;
}

.form-item {
  margin-bottom: 0.75em;
  width: 100%;
}

.form-item input {
  background: #fafafa;
  border: none;
  border-bottom: 2px solid #e9e9e9;
  color: #666;
  font-family: 'Open Sans', sans-serif;
  font-size: 1em;
  height: 50px;
  transition: border-color 0.3s;
  width: 100%;
}

.form-item input:focus {
  border-bottom: 2px solid #c0c0c0;
  outline: none;
}

.button-panel {
  margin: 2em 0 0;
  width: 100%;
}

.button-panel .button {
  background: #f16272;
  border: none;
  color: #fff;
  cursor: pointer;
  height: 50px;
  font-family: 'Open Sans', sans-serif;
  font-size: 1.2em;
  letter-spacing: 0.05em;
  text-align: center;
  text-transform: uppercase;
  transition: background 0.3s ease-in-out;
  width: 100%;
}

.button:hover {
  background: #ee3e52;
}

.form-footer {
  font-size: 1em;
  padding: 2em 0;
  text-align: center;
}

.form-footer a {
  color: #8c8c8c;
  text-decoration: none;
  transition: border-color 0.3s;
}

.form-footer a:hover {
  border-bottom: 1px dotted #8c8c8c;
}
    </style>
</head>
<body>
    <div class="form-wrapper">
        <h1>Đổi mật khẩu</h1>
        <form id="form" method="post" action="{{ route('process_change_password', ['token'=>$token[0]->token]) }}">
            @csrf
          <div class="form-item">
            <label for="email"></label>
            <input type="password" id="password" required="required" placeholder="New Password"></input>
            <br>
            <span id="err_password" style="color: red;font-size: 11px"></span>
          </div>
          <div class="form-item">
            <label for="password"></label>
            <input type="password" id="retype_password"  name="password" required="required" placeholder="Password"></input>
            <br>
            <span id="err_retype_password" style="color: red;font-size: 11px"></span>
          </div>
          <div class="button-panel">
            <input type="submit" class="button" title="Sign In" value="Đổi mật khẩu"></input>
          </div>
        </form>
        <div class="form-footer">
        </div>
      </div>
<script>
    $(document).ready(function () {
        $("#form").submit(function (e) {
            var password=$("#password").val();
            var retype_password=$("#retype_password").val();
            var regex_password=/^(?=.*?[a-z])(?=.*?[A-Z])[a-zA-Z0-9]{8,30}$/;
            if(password=='')
            {
                $("#err_password").html("Vui lòng nhập mật khẩu");
                e.preventDefault();
            }
            else if(regex_password.test(password)==false){
                $("#err_password").html("Mật khẩu không đủ tiêu chuẩn");
                e.preventDefault();
            }
            else{
                $("#err_password").html("");
            }

            if(retype_password=='')
            {
                $("#err_retype_password").html("Vui lòng nhập lại mật khẩu");
                e.preventDefault();
            }
            else if(password!=retype_password)
            {
                $("#err_retype_password").html("Không trùng với mật khẩu");
                e.preventDefault();
            }
            else{
                $("#err_retype_password").html();
            }
        });
    });
</script>
</body>
</html>

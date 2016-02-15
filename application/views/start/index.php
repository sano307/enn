
<html>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Compressed CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.1.2/foundation.min.css">
<!-- Compressed JavaScript -->
    <script src="https://cdn.jsdelivr.net/foundation/6.1.2/foundation.min.js"></script>

    <style>
        body {
            background-image: url('/public/img/background/background.jpg');
            background-repeat:no-repeat;
            background-size:100%;
        }
        /*
          로그인,회원가입 css
        */
        .login_join_from{
          border: 0px solid #cacaca;
          padding: 1rem;
          border-radius: 3px;
        }


    </style>
</head>
<body>
<center><img src="/public/img/logo.png" width="450" style="width:500px; padding-top: 50px; padding-bottom: 50px;"></center>

<!-- 로그인start -->
<div class="row">
<div class="medium-6 medium-centered large-3 large-centered columns">

  <form id="login_form" data-parsley-validate="" action="<?php echo URL; ?>start/login" method="POST">
    <div class="row column login_join_from">
      <label>Email
        <input type="email" name="email" placeholder="somebody@example.com" required>
      </label>
      <label>Password
        <input type="password" name="password" placeholder="Password" required>
      </label>
      <p><input type="submit" value="Login" class="button expanded"></p>
    </div>
  </form>

</div>
</div>
<!-- 로그인end -->
<!-- 회원가입start -->
<i class="paperclip"></i>
<div class="row">
  <div class="medium-6 medium-centered large-3 large-centered columns">
    <form id="join_form" action="<?php echo URL; ?>start/join" method="POST" enctype="multipart/form-data">
      <div class="row column login_join_from">
      <label>Email
        <input type="email" name="email" placeholder=e_mail required>
      </label>
      <label>nickname
        <input type="text" name="name" placeholder=name required>
      </label>
      <label>Password
        <input type="text" name="password" placeholder=password required>
      </label>
            <div class="radio">
                <th colspan="2">
                    <label for="gender">
                    <input type="radio" name="sex" value="M" checked>男
                    <input type="radio" name="sex" value="F">女
                    </label>
                </th>
            </div>

                <div id="nationally">
                    <select name="nationally">
                        <option value="">nationally</option>
                        <option value="korea">Korea</option>
                        <option value="japan">Japan</option>
                    </select>
                </div>

                <div id="region">
                    <select name="region">
                        <option value="">region</option>
                    </select>
                </div>

                <input type="file" name="profileImg">
                <input type="submit" value="Join" class="button expanded">
          </div>
    </form>
  </div>
</div>

<!-- 회원가입s -->

<script>
    $(document).ready(function() {
        $("#login_form").submit(function (event) {
            if ($(".required").val().length === 0) {
                event.preventDefault();
            }
        });

        $("#join_form").submit(function (event) {
            if ($(".required").val().length === 0) {
                event.preventDefault();
            }
        });

        $("select[name=region]")
            .change(function () {
                var selectedRegion  = "";
                $("select[name=region] option:selected").each(function() {
                    selectedRegion = $(this).val();
                    console.log(selectedRegion);
                });
            }).change();


        $("select[name=nationally]")
            .change(function () {
                var selectedNationally = "";
                $("select[name=nationally] option:selected").each(function() {
                    $("#region select").html("<option value=''>region</option>");

                    selectedNationally = $(this).val();
                    var temp = [{"nationally":selectedNationally}];
                    var sent_data = JSON.stringify(temp);

                    if( selectedNationally ) {
                        $.ajax ({
                            type: "POST",
                            url: "/start/getRegion",
                            data: {sent_data},
                            dataType: "json",
                            success: function( data ) {

                                var str = "";
                                for ( var row in data ) {

                                    str = "<option value='" + data[row]['nri_region'] + "'>" + data[row]['nri_region'] + "</option>";
                                    $("#region select").append(str);
                                }
                            },

                            // 값이 넘어오지 않을 경우 실행될 메서드
                            error: function( xhr, status, errorThrown ) {
                                alert( "Sorry, there was a problem!" );
                                console.log( "Error: " + errorThrown );
                                console.log( "Status: " + status );
                                console.dir( xhr );
                                alert( xhr.responseText);
                            },

                            // 값이 정상적으로 넘어오거나 넘어오지 않아도 꼭 실행될 메서드
                            complete: function( xhr, status ) {
                                //alert( "The request is complete!" );
                            }
                        }).done(function(data){
                            console.log(data)
                        });
                    }
                });
            }).change();
    });
</script>
</body>
</html>

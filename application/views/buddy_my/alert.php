<?php
$check = $_GET['msg'];
switch ( $check ) {
    case "1": ?>
        <script>
            var msg = "정상적으로 친구 신청이 완료되었습니다.";
            alert(msg);
            history.back();
        </script>
<?php
        break;
    case "0": ?>
        <script>
            var msg = "이미 친구 신청이 진행중인 상태입니다.";
            alert(msg);
            history.back();
        </script>
<?php
        break;
}
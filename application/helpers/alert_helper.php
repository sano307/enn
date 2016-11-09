<?php
    function alert( $msg )
    {
        switch ($msg) {
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
            case "2": ?>
                <script>
                    var msg = "친구추가 완료!";
                    alert(msg);
                    history.back();
                </script>
            <?php
                break;
            case "3": ?>
                <script>
                    var msg = "친구신청을 거절하였습니다.";
                    alert(msg);
                    history.back();
                </script>
            <?php
                break;
            case "4": ?>
                <script>
                    var msg = "Bye Friend!";
                    alert(msg);
                    history.back();
                </script>
            <?php
                break;
            default:
                break;
        }
    }
?>
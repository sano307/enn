<?php
$errorCheck = $_REQUEST['error'];
switch ( $errorCheck ) {
    case "NotImageFile": ?>
        <script>
            var msg = "이미지 파일이 아닙니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "AlreadyExistsFile": ?>
        <script>
            var msg = "같은 이름의 이미지 파일이 존재합니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "OverSizeFile": ?>
        <script>
            var msg = "업로드 할 수 있는 용량을 초과했습니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "OtherExtensionFile": ?>
        <script>
            var msg = "이미지 중 업로드 할 수 없는 확장자가 포함된 파일이 있습니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "UploadingFailed": ?>
        <script>
            var msg = "이미지 업로드에 실패했습니다.";
            alert(msg);
            history.back();
        </script>
        <?php
        break;
}
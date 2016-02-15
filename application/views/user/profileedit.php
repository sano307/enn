<p align="center">user/profile_edit</p>
<div id="user_infomation_change">
    <form name='user_infomation_change' action="<?php echo URL; ?>user/profile_update" method="POST" enctype="multipart/form-data">
        <table border="3px" align="center">
            <tr><th colspan="2"><h4 align="center"><br>회원 정보 변경</h4></th></tr>
            <tr><td>아이디 :</td><td> <input type="text" nmae="id" value="<?=$memberInfo[0]->m_memberID;?>" readonly></td></tr>
            <tr><td>닉네임 :</td><td><input type="text" name="nickname" value="<?=$memberInfo[0]->m_nickname;?>"><input type="button" name="IsNickname" value="닉네임 중복체크"></td></tr>
            <tr><td>비밀번호 :</td><td> <input type="text" name="password" value="<?=$memberInfo[0]->m_memberPasswd;?>"></td></tr>
            <tr><td>성별 :</td><td> 
                <input type="text" name="sex" value="
                <?php
                    if($memberInfo[0]->m_sex=='F'){
                        echo "Female";
                    }else{
                        echo "Male";
                    }
                ?>
                " readonly></td></tr>
            <tr><td>국적 :</td><td> <input type="text" name="nationally" value="<?=$memberInfo[0]->m_nationally;?>" readonly></td></tr>
            <tr><td>지역 :</td>
                <td>
                    <input type="text" name="region" value="<?=$memberInfo[0]->m_region;?>" readonly>
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
                </td>
            </tr>
            <tr><td>프로필 이미지 :</td> <td><input type="file" name="profileImg"></td></tr>
            <tr><td>현재 이미지</td><td>
            <?php 
                if($memberInfo[0]->m_profileImgName==null){
            ?>
            <input type="image" width="170" 
                src="/public/img/common/common_profileImg.png
            ">
            <?php
                }else{
            ?>
            <input type="image" width="170" 
                src="/public/img/member/
                    <?=$memberInfo[0]->m_idx;?>/
                    <?=$memberInfo[0]->m_profileImgName;?>.<?=$memberInfo[0]->m_profileImgExt;?>
            ">
            <?php
                }
            ?>
            <input type="submit" value="change" style="float:right"></td>
            <input type="hidden" name="idx" value="<?php echo $memberInfo[0]->m_idx;?>" >
            </tr>
    </form>
    <tr>
        <td  colspan="2" align="center">
            <input type="reset" value="reset" >
            <form name='user_infomation_delete'  action="<?php echo URL; ?>user/profile_delete" method="POST">
                <input type="submit" value="delete" >
            </form>
        </td>
    </tr>
</div>
</table>
<script>
    $(document).ready(function() {
        var userNickname = $("#user_infomation_change").find("input[name=nickname]").val();
        var isNickname = false;

        $("#user_infomation_change").submit(function () {
            if ( !isNickname ) {
                alert("닉네임 중복체크를 해주세요!");
                return false;
            } else {
                alert("정상적으로 회원정보수정이 완료되었습니다!");
            }
        });

        $("#user_infomation_change").find("input[name=IsNickname]").click(function() {
            var inputNickname = $("#user_infomation_change").find("input[name=nickname]").val();
            var temp = [{"nickname":inputNickname}];
            var sent_data = JSON.stringify(temp);

            if ( userNickname == inputNickname ) {
                alert("현재 설정된 닉네임입니다!");
                isNickname = true;
                return false;
            }

            $.ajax ({
                type: "POST",
                url: "/user/IsNickname",
                data: {sent_data},
                dataType: "json",
                success: function( data ) {
                    if ( data.result ) {
                        alert("사용가능한 닉네임입니다!");
                        isNickname = true;
                    } else {
                        alert("현재 사용중인 닉네임입니다!");
                        isNickname = false;
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
<script language = "javascript"> 
//상위 셀렉트로 하위 셀렉트 제어하기
function showSub(obj) {

    f = document.forms.select_machine;

    if(obj == 1) {
    
        f.korea.style.display = "";
        f.japan.style.display = "none";

    }
    else {

        f.korea.style.display = "none";
        f.japan.style.display = "";

    }
}
</script>
<div style="border: 5px double #48BAE4; width:500px; height:500px; padding: 10px;">
    <form name="select_machine" action="<?php echo URL; ?>group_new/add" method="post" enctype="multipart/form-data">
        <h3 align="center">그룹생성</h3>
        <table align="center" cellpadding="5px">
            <tr><td>그룹이름 : </td><td><input type="text" name="campName"></td></tr>
            <tr><td>그룹로고 : </td><td><input type="file" name="campImg"></td></tr>
            <tr><td>활동지역 : </td><td>
            국가
            <select name=" " onChange="showSub(this.options[this.selectedIndex].value);">
               <option value="1">Korea</option> 
               <option value="2">Japan</option> 
            </select>
            <br>
            도시
            <select name="korea" style="display: ">
            <option value="null">선택</option>
               <option value="seoul">서울</option>
               <option value="busan">부산</option>
               <option value="incheon">인천</option>
               <option value="gwangju">광주</option>
               <option value="daejeon">대전</option>
               <option value="ulsan">울산</option>
               <option value="jeju">제주도</option>
            </select>
            <select name="japan" style="display: none;">
              <option value="null">선택</option>
               <option value="hokkaido">홋카이도</option>
               <option value="tohoku">도호쿠</option>
               <option value="chubu">츄부</option>
               <option value="kanto">간토</option>
               <option value="kinki">긴키</option>
               <option value="chugoku">추고쿠</option>
               <option value="shigoku">신고쿠</option>
               <option value="kyushu">큐슈</option>
               <option value="okinawa">오키나와</option>
            </select>

     
         </td></tr>
            <tr><td>인원제한 : </td><td><input type="number" min="1" max="100"  name="campLimitPerson" value="1"></td></tr>
            <tr><td id="content">그룹소개 : </td><td><textarea name="campIntroduction" cols="50" rows="10" style="resize:none; overflow:auto;"></textarea></td></tr>
            <tr><td><input type="submit" value="신청">
                     <input type="hidden" name="m_idx" value="<?php echo $_SESSION['login_idx'] ?>"></td></tr>
        </table>
    </form>
</div>



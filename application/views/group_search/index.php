
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
<table align="center">
   <tr>
      <td>
         <form name="select_machine" action ="<?php echo URL; ?>/group_search/index" method="post">
            국가
            <select name="" onChange="showSub(this.options[this.selectedIndex].value);">
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
            <input type="submit" value="검색">
         </form>
      </td>
   </tr>
</table>

<input type="button" onClick="top.location.href='/group/create'" value="그룹생성">


<?php

   foreach($result as $row){
      $c_idx=$row->c_idx;
      //$m_idx >> 그룹을 개설한 장의 번호
      $master_m_idx=$row->m_idx;

      echo $c_idx;

         if($row->c_campThumbName==null){
            echo "등록된 사진이 없습니다.";
         }else{
            echo "<img src='/public/img/camp/$c_idx/$row->c_campThumbName.$row->c_campThumbExt"."'>";
         }

      echo "<a href='/group_detail/index/$c_idx'>".$row->c_campName."</a>";

      echo $row->c_campIntroduction;

      echo $row->c_campRegion;
      echo $row->c_campTheNumber;
      if($master_m_idx!=$_SESSION['login_idx']){
         echo "<a href='/group_my/group_request/$c_idx/".$_SESSION['login_idx']."'>그룹가입</a>";
      }else{
         echo "가입된상태";
      }

   }

?>

</table>

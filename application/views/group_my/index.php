<li><a href="/group_search/index">그룹검색</a></li>
<table border="1" align="center">
   <tr>
      <td>
          <input type="button" onClick="top.location.href='/group/create'" value="그룹생성">
      </td>
   </tr>
   <tr>
         <td>
         그룹번호
      </td>
               <td>
         그룹썸네일
      </td>
      <td>
         그룹명
      </td>
      <td>
         그룹장번호
      </td>

      <td>
         그룹소개
      </td>
      <td>
         그룹지역
      </td>
      <td>
         그룹 인원 제한
      </td>
   </tr>
<?php
      if(@$group_my_model == null) {
        echo "<tr><td colspan=7>검색결과가 없습니다.</td></tr>";
      }else{
         foreach($group_my_model as $row){
            $c_idx=$row->c_idx;
            echo "<tr>";
                  echo "<td>";
            echo $c_idx;
            echo "</td>";
            echo "<td>";
            echo "<img src='/public/img/camp/$c_idx/$row->c_campThumbName.$row->c_campThumbExt"."'>";
            echo "</td>";
            echo "<td>";
            echo "<a href='/group_detail/index/".$c_idx."'>$row->c_campName</a>";
            echo "</td>";
            echo "<td>";
            $m_idx=$row->m_idx;
            echo $m_idx;
            echo "</td>";
            echo "<td>";
            echo $row->c_campIntroduction;
            echo "</td>";
            echo "<td>";
            echo $row->c_campRegion;
            echo "</td>";
            echo "<td>";
            echo $row->c_campTheNumber;
            echo "</td>";
            echo "<td>";
            echo "<a href='/group_my/group_bye/$c_idx/$m_idx'>그룹탈퇴</a>";
            echo "</td>";
            echo "</tr>";
         }
      }
?>
</table>


<?

?>

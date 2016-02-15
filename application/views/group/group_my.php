
          <input type="button" onClick="top.location.href='/group/create'" value="그룹생성">

<?php
   foreach($result as $row){
      $g_idx=$row->g_idx;
      echo $g_idx;
      $m_idx=$row->m_idx;
      echo $m_idx;

      echo $row->g_groupName;

      echo $row->g_groupIntroduction;

      echo $row->g_groupRegin;

      echo $row->g_groupTheNumber;

      echo $row->g_groupThumbName.".".$row->g_groupThumbExt;

      echo "<a href='/group_my/group_bye/$g_idx/$m_idx'>그룹탈퇴</a>";


   }
?>
</table>

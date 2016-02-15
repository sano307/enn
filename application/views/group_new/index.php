<div style="border: 5px double #48BAE4; width:500px; height:500px; padding: 10px;">
    <form action="/group_new/add" method="post" enctype="multipart/form-data">
        <h3 align="center">그룹생성</h3>
        <table align="center" cellpadding="5px">
            <tr><td>그룹이름 : </td><td><input type="text" name="campName"></td></tr>
            <tr><td>그룹로고 : </td><td><input type="file" name="campImg"></td></tr>
            <tr><td>활동지역 : </td><td><select name="campRegion">
                                         <option value="">지역선택</option>
                                         <option value="한국">한국</option>
                                         <option value="일본">일본</option></td></tr>
            <tr><td>인원제한 : </td><td><input type="number" min="1" max="100"  name="campLimitPerson" value="1"></td></tr>
            <tr><td id="content">그룹소개 : </td><td><textarea name="campIntroduction" cols="50" rows="10" style="resize:none; overflow:auto;"></textarea></td></tr>
            <tr><td><input type="submit" value="신청">
                     <input type="hidden" name="m_idx" value="<?php echo $_SESSION['login_idx'] ?>"></td></tr>
        </table>
    </form>
</div>
<?php
$argNationally  =  $_POST['nationally'];
echo "<select name='region'>";

if( $argNationally == "korea" ){
  echo "<option value=''>지역</option>";
  echo "<option value='seoul'>서울</option>";
  echo "<option value='deagu'>대구</option>";
  } else {
  echo "<option value=''>지역</option>";
  echo "<option value='tokyo'>도쿄</option>";
  echo "<option value='hukuoka'>후쿠오카</option>";
}

echo "</select>";
?>
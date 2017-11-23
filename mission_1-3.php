<?php

$fp=fopen("mission_1-2.php","r");
while ($line=fgets($fp)){
  echo"$line<br/>";
}
fclose($fp);

?>
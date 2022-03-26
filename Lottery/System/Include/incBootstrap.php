<?php
$IncBootstrapUrl = array("../../../../Scripts/jquery-1.10.2.min.js","../../../../Scripts/bootstrap.min.js","../../../../Content/bootstrap.min.css","../../../../Content/bootstrap-theme.min.css");

echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
for($i=2;$i<=3;$i++){
  echo "<link rel='stylesheet' href='".$IncBootstrapUrl[$i]."'>";
}
for($i=0;$i<=1;$i++){
	echo "<script src='".$IncBootstrapUrl[$i]."'></script>";
}
?>
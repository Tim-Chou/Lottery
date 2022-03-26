<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>參賽者名單</title>
	   <?php session_start(); ?>
	  <?php 
	    header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
	  ?>
   </head>
   <body>
   <?php
      if(@$_SESSION["account"] == "login"){
   ?>
        <?php
		 
			  $sql = "SELECT * FROM lottery";
			  $result = $db_link->query($sql);
			  $total_records = $result->rowCount();
			  
		  
        ?>
		<table>
		<td><h1>抽獎活動報名系統之參賽者個資 - 後台管理系統</h1></td><tr>
		<td><a href="../JoinLottery/index.php" ><input type="button" name="add" value="新增參賽者個資"></a></td><tr>
        </table><hr>
     <form action="index.php" method="post"> 
        <table>
		<thead>
		  <th>參賽者ID</th>
		  <th>參賽者姓名</th>
		  <th>地址</th>
		  <th>電表號碼</th>
		  <th>去年同期電費總用電"度數"</th>
		  <th>去年同期電費總用電"日數"</th>
		  <th>本期電費總用電"度數"</th>
		  <th>本期電費總用電"日數"</th>
		  <th>去年同期電費"平均用電度數"</th>
		  <th>本期電費"平均用電度數"</th>
		  <th>每期節電量(度電)</th>
		  <th>電費帳單截圖照片</th>
		  <th>上傳時間</th>
		  
		  <th>修改/刪除</th>
		  <tr>
		  </thead>
		  <tbody>
		<?php
        if($total_records > 0 ){
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
	 ?>	  
		  
		  <?php
		     echo sprintf("<td>%d</td>",$row["LID"]);
			 echo sprintf("<td>%s</td>",$row["LName"]);
			 
			 echo sprintf("<td>%s</td>",$row["LAddress"]);
			 echo sprintf("<td>%s</td>",$row["LEleNum"]);
			 echo sprintf("<td>%s</td>",$row["LBeforeFee"]);
			 echo sprintf("<td>%s</td>",$row["LBeforeDays"]);
			 echo sprintf("<td>%s</td>",$row["LLastFee"]);
			 echo sprintf("<td>%s</td>",$row["LLastDays"]);
			 echo sprintf("<td>%s</td>",$row["LBeforeAvgFee"]);
			 echo sprintf("<td>%s</td>",$row["LLastAvgFee"]);
			 echo sprintf("<td>%s</td>",$row["LSaveFee"]);
			 echo sprintf("<td><a href='"."%s"."'><img src='"."%s"."' width='100' height='150'></a><br>%s</td>",substr($row["LImage_file"],3,(strlen($row["LImage_file"])-3)),substr($row["LImage_file"],3,(strlen($row["LImage_file"])-3)),$row["LRealImgFileName"]);
			 echo sprintf("<td>%s</td>",$row["LAdd_time"]);
			 
			 echo sprintf("<td><table><td><a href ='../ModifyList/index.php?LID=%s'><input type='button' value='修改' /></a></td><td><a href ='../DelList/index.php?LID=%s'><input type='button' value='刪除' /></a></td></table></td>",$row["LID"],$row["LID"]);
			 echo "<tr>";
		  ?>
		  <?php 
			}
		 }else{
			 echo "沒有一筆資料!";
		 }
		?>
		</tbody>
		</table>
		
		<input type="submit" name="Send" value="查詢"/>
	 </form>
    <?php
      }else{
		  echo "<font color='red'><h1>無法操作!您尚未登入此系統!</h1></font>";
	  }	
	?>	 
        <hr/>
		<a href="../Home/index.php"><input type="button" class="btn btn-primary" value="回首頁" /></a>	 
   </body>
</html>
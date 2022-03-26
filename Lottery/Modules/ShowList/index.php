<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>參賽者名單</title>
	   <?php session_start(); ?>
	  <?php 
	    header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/incBootstrap.php");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
		include_once("../../Include/joinLotteryCss.php");
		include_once("../../Include/TempStyleCss.php");
	  ?>
   </head>
   <body>
   <form action="index.php" method="get">		
<div class="title">
<h2>2021年台灣節約用電抽獎活動 - 系統管理者端</h2>
</div>
	
<div class="topnav">
<a href="../Home/index.php">回首頁</a>
<a href="../Bulletin/index.php">公佈欄</a>
<a href="../ActiveDate/index.php">設定活動時間</a>
<a href="../JoinLottery/index.php">新增參賽者</a>
<a href="../ShowList/index.php">參賽者個資管理</a>
<a href="../AwardList/index.php">進行開獎</a>
<a href="../ShowAward/index.php">得獎者名單</a>
<div class="topnavA2"><a href="../../System/Main/Home/index.php" >參賽者專區</a></div>
</div>		
   <?php
      if(@$_SESSION["account"] == "login"){
   ?>
        <?php
			  $sql = "SELECT * FROM lottery";
			  $result = $db_link->query($sql);
			  $total_records = $result->rowCount();
        ?>
		<?php
		  $per = 2; //每頁顯示項目數量
          $pages = ceil($total_records /$per); //取得不小於值的下一個整數
          if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
            $page=1; //則在此設定起始頁數
          } else {
            $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
          }
           $start = ($page-1)*$per; //每一頁開始的資料序號
		   $result = $db_link->query($sql.' LIMIT '.$start.', '.$per) or die("Error");
		?>
		
		
		
		

<div class="content">	  
	<div class="table-wrapper">
	<table class="table" style="width: 100%;">
	<thead>
		  <tr>
		  <!--<th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>節約用電抽獎系統-報名資料填寫</h2></th>-->
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>參賽者個資管理</h2></th>
		  </tr>
	</thead>
	</table>		
      
        <table class="table table-hover" style="width: 100%;">
		<thead>
		  <th>參賽者ID</th>
		  <th>參賽者姓名</th>
		  <th>地址</th>
		  <th>電表號碼</th>
		  <th>去年同期總用電度數</th>
		  <th>去年同期總用電日數</th>
		  <th>本期總用電度數</th>
		  <th>本期總用電日數</th>
		  <th>去年同期"平均用電度數"</th>
		  <th>本期"平均用電度數"</th>
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
		     echo "<tr>";
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
			 //echo sprintf("<td><a href='"."%s"."'><img src='"."%s"."' width='100' height='150'></a><br>%s</td>",substr($row["LImage_file"],3,(strlen($row["LImage_file"])-3)),substr($row["LImage_file"],3,(strlen($row["LImage_file"])-3)),$row["LRealImgFileName"]);
			 echo sprintf("<td><a href='"."%s"."'><img src='"."%s"."' width='100' height='150'></a><br>%s</td>",'../../'.str_replace('../',"",$row["LImage_file"]),'../../'.str_replace('../',"",$row["LImage_file"]),$row["LRealImgFileName"]);
			 echo sprintf("<td>%s</td>",$row["LAdd_time"]);
			 
			 echo sprintf("<td><table><td><a href ='../ModifyList/index.php?LID=%s'><input type='button' value='修改' /></a></td><td><a href ='../DelList/index.php?LID=%s'><input type='button' value='刪除' /></a></td></table></td>",$row["LID"],$row["LID"]);
			 echo "</tr>";
		  ?>
		  <?php 
			}
		 }else{
			 echo "沒有一筆資料!";
		 }
		?>
		</tbody>
		</table>
		<?php
    //分頁頁碼
	echo "<div class='pages'>";
    echo '共 '.$total_records.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
	echo "</div>";
?>
</div>

</div>
		
		<!--<input type="submit" name="Send" value="查詢"/>-->
	 </form>
    <?php
      }else{
		  echo "<font color='red'><h1>無法操作!您尚未登入此系統!</h1></font>";
		  echo "<hr/><a href='../Home/index.php'><input type='button' class='btn btn-primary' value='回首頁' /></a>";
	  }	
	?>	 
 <div class="footer">
  <div class="footerText">
       <p> 主辦單位:&nbsp;中國電力公司 </p>
       <p> Copyright&copy;2021&nbsp;Taurus&nbsp;Studio(作者:&nbsp;周彥廷).&nbsp;All&nbsp;rights&nbsp;reserved. </p>
  </div>  
</div>       
		 
   </body>
</html>
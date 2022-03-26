<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>得獎者名單</title>
	  <?php 
	    header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
		include_once("../../Include/incBootstrap.php");
		include_once("../../Include/TempStyleCss.php");
		include_once("../../Include/joinLotteryCss.php");
	  ?>
   </head>
   <body>
        <?php
			  /*$sql = "SELECT * FROM lottery WHERE LAward='Y'";
			  $result = $db_link->query($sql);
			  $total_records = $result->rowCount();
			 */ 
        ?>
		<?php
			  $sql = "SELECT * FROM lottery WHERE LAward='Y'";
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
		
		
	
<form action="index.php" method="post" enctype="multipart/form-data">
<div class="title">
<h2>2021年台灣節約用電抽獎活動</h2>
</div>
	 
<div class="topnav">
<a href="../Home/index.php">首頁</a>
<a href="../Bulletin/index.php">公佈欄</a>
<a href="../Info/index.php">活動辦法</a>
<a href="../JoinLottery/index.php">活動報名</a>
<a href="../ShowAward/index.php">得獎名單</a>
<div class="topnavA2"><a href="../../../Modules/Home/index.php" >參賽者/管理專區</a></div>
</div>	

<div class="content">	  
	<div class="table-wrapper">
	<table class="table">
	<thead>
		  <tr>
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>得獎者名單</h2></th>
		  </tr>
	</thead>
	</table>
	
	
	 <?php if($total_records > 0 ){ ?>	
        <table class="table">
		<thead>
		  <th>得獎者ID</th>
		  <th>得獎者姓名</th>
		  <th>地址</th>
		  <th>電表號碼</th>
		  <th>去年同期電費總用電"度數"</th>
		  <th>去年同期電費總用電"日數"</th>
		  <th>本期電費總用電"度數"</th>
		  <th>本期電費總用電"日數"</th>
		  <th>去年同期電費"平均用電度數"</th>
		  <th>本期電費"平均用電度數"</th>
		  <th>每期節電量(度電)</th>
		  <tr>
		  </thead>
		  <tbody>
		<?php
        
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
	 ?>	  
		  
		  <?php
		  /*
		     echo sprintf("<td>%d</td>",$row["LID"]);
			 if(strlen($row["LName"]) > 2){
				 
			   echo sprintf("<td>%s</td>",mb_substr($row["LName"],0,1,'utf-8').'O'.mb_substr($row["LName"],2,1,'utf-8'));
			 }else{
			   echo sprintf("<td>%s</td>",mb_substr($row["LName"],0,1,'utf-8').'O');
			 }
			 
			 */
			  echo "<tr>";
		     echo sprintf("<td>%d</td>",$row["LID"]);
			 $Lname = explode(" ",$row["LName"]);
			 if(count($Lname)>= 2){
				 echo sprintf("<td>%s</td>",'O  '.mb_substr($Lname[1] ,0,strlen($Lname[1]),'utf-8'));
			 }else{
			    if(strlen($row["LName"]) > 2){
			      echo sprintf("<td>%s</td>",mb_substr($row["LName"],0,1,'utf-8').'O'.mb_substr($row["LName"],2,1,'utf-8'));
			    }else{
			      echo sprintf("<td>%s</td>",mb_substr($row["LName"],0,1,'utf-8').'O');
			    }
			 }
			 
			 $patterns = array();
			 $patterns[0] = '/\d/';
			 $patterns[1] = '/巷/';
			 $patterns[2] = '/號/';
			 $patterns[3] = '/樓/';
			 $patterns[4] = '/之/';
			 $patterns[5] = '/弄/';
			 $patterns[6] = '/鄰/';
			 $replacements = '';
			 $LAddress = preg_replace($patterns[0], $replacements, $row["LAddress"]);
			 
			 for($i=1;$i<=6;$i++){
			    $LAddress = preg_replace($patterns[$i], $replacements, $LAddress);
			 }
			
			 echo sprintf("<td>%s</td>",$LAddress);
			 echo sprintf("<td>%s</td>",substr($row["LEleNum"],0,11)."XX-X");
			 echo sprintf("<td>%s</td>",$row["LBeforeFee"]);
			 echo sprintf("<td>%s</td>",$row["LBeforeDays"]);
			 echo sprintf("<td>%s</td>",$row["LLastFee"]);
			 echo sprintf("<td>%s</td>",$row["LLastDays"]);
			 echo sprintf("<td>%s</td>",$row["LBeforeAvgFee"]);
			 echo sprintf("<td>%s</td>",$row["LLastAvgFee"]);
			 echo sprintf("<td>%s</td>",$row["LSaveFee"]);
			 
			 
			 echo "<tr>";
			 }
		  ?>
		  
		</tbody>
		</table>
		<?php 
		 }else{
			 echo "<font color='red'><tr/><h1>尚未開獎!</h1><br></font>";
		 }
		?>
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
<div class="footer">
  <div class="footerText">
       <p> 主辦單位:&nbsp;中國電力公司 </p>
       <p> Copyright&copy;2021&nbsp;Taurus&nbsp;Studio(作者:&nbsp;周彥廷).&nbsp;All&nbsp;rights&nbsp;reserved. </p>
  </div>  
</div>
</form>	
   </body>
</html>
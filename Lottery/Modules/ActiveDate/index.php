<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>修改活動時間</title>
	  <?php session_start(); ?>
	  <?php 
	   header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
		include_once("../../Include/joinLotteryCss.php");
		include_once("../../Include/TempStyleCss.php");
		include_once("../../Include/incBootstrap.php");
		date_default_timezone_set("Asia/Taipei");
	  ?>

     <form action="index.php" method="POST">
	 <div class="title">
<h2>2021年台灣節約用電抽獎活動</h2>
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
	    $tID =   1;
		$tStart = null;
		$tEnd = null;
	
		$result = $db_link->prepare("SELECT * FROM active_date WHERE tID=?");
	    if ($result->execute(array( GetSQLValueString($tID, "int")))){
			while($row = $result->fetch()){
				$tStart = $row["tStart"];
		        $tEnd = $row["tEnd"];
			}
		}
		
		
	  ?>
   </head>
   <body>
     <font color="red">
        <?php
		
		  if (isset($_POST["Send"]) && isset($_POST["tStart"]) && isset($_POST["tStartTime"]) && isset($_POST["tEnd"]) && isset($_POST["tEndTime"])){
			  $tStart = null;
		      $tEnd = null;
			  $tStart = $_POST["tStart"].'T'.$_POST["tStartTime"].':00';
			  $tStart = substr($tStart,0,19);
			  $tEnd = $_POST["tEnd"].'T'.$_POST["tEndTime"].':00';
			  $tEnd = substr($tEnd,0,19);
			  //echo $tStart."<br/>";
			  //echo $tEnd."<br/>";
			 
			  $stmt = $db_link->prepare("UPDATE active_date SET tStart=?, tEnd=? WHERE tID=1");
			  if ($stmt->execute(array(GetSQLValueString($tStart, "string"), GetSQLValueString($tEnd, "string")))){
				  echo "<script>alert('活動日期已經修改完成!');</script>";
			      //header("Location: ../ActiveDate/index.php");
				  //exit();
			  }else{
				  echo "<script>alert('活動日期修改失敗!');</script>";
			      //header("Location: ../ActiveDate/index.php");
				 // exit();
			  }
			  
		  }
        ?>
     </font>


	
<div class="content">	  
	<div class="table-wrapper">
	<table class="table">
	<thead>
		  <tr>
		  <!--<th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>節約用電抽獎系統-報名資料填寫</h2></th>-->
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>報名活動期時間設定</h2></th>
		  </tr>
	</thead>
	</table>
        <table>
		  <tr><td>活動起始日:</td>
		  <td><input type="date"  id="tStart" name="tStart" value="<?php echo substr($tStart,0,10); ?>" required  />
		      <input type="time"  id="tStartTime" name="tStartTime"  value="<?php echo substr($tStart,11,19); ?>" required  />
		  </td></tr>
		  <tr><td>活動截止日:</td>
		  <td><input type="date"  id="tEnd" name="tEnd"  value="<?php echo substr($tEnd,0,10); ?>" required  />
		      <input type="time"  id="tEndTime" name="tEndTime" value="<?php echo substr($tEnd,11,19); ?>"  required  />
		  </td></tr>
		 
		</table>
		<input type="submit" name="Send" value="送出"/>
		
 <?php
      }else{
		  echo "<font color='red'><h1>無法操作!您尚未登入此系統!</h1></font>";
		  echo "<hr/><a href='../Home/index.php'><input type='button' class='btn btn-primary' value='回首頁' /></a>";
	  }	
	?>	 
<!--<hr/>-->
		<!--<a href="../Home/index.php"><input type="button" class="btn btn-primary" value="回首頁" /></a>	-->	
		<div class="footer">
  <div class="footerText">
       <p> 主辦單位:&nbsp;中國電力公司 </p>
       <p> Copyright&copy;2021&nbsp;Taurus&nbsp;Studio(作者:&nbsp;周彥廷).&nbsp;All&nbsp;rights&nbsp;reserved. </p>
  </div>  
</div>
	 </form>
   </body>
</html>
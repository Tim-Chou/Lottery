<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title> 2021年台灣節約用電抽獎活動 - 修改參賽者個資</title>
	  <?php session_start(); ?>
	  <?php 
	    header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/incBootstrap.php");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
		include_once("../../Include/joinLotteryCss.php");
		include_once("../../Include/TempStyleCss.php");
	  ?>
	  <?php 
	    $LID = null;
		$LName = null;
		$LEmail = null;
		$LTel = null;
		if (isset($_GET["LID"])){
			  $LID = $_GET["LID"];
			  $result = $db_link->prepare("SELECT * FROM lottery  WHERE LID=?");
			  if ($result->execute(array( GetSQLValueString($LID, "int")))){
			   while($row = $result->fetch()){
				 $LName = $row["LName"];
			     $LEleNum = $row["LEleNum"];
			     $LAddress= $row["LAddress"];
			  
			     $LBeforeFee = $row["LBeforeFee"];//去年同期總用電度數
			     $LBeforeDays = $row["LBeforeDays"];//去年同期總用電日數
			     $LLastFee = $row["LLastFee"];//本期總用電度數
			     $LLastDays = $row["LLastDays"];//本期總用電日數
				 
				 
			   }
		  }
		}
		
	  ?>
   </head>
   <body>
   <?php
      if(@$_SESSION["account"] == "login"){
   ?>
   
   
     <font color="red">
        <?php
		
		
		  if (isset($_POST["Send"])){
			  $LID =   $_POST["LID"];
			  $LName = $_POST["LName"];
			  $LEleNum = $_POST["LEleNum"];
			  $LAddress = $_POST["LAddress"];
			  
			  $LBeforeFee = $_POST["LBeforeFee"];//去年同期總用電度數
			  $LBeforeDays = $_POST["LBeforeDays"];//去年同期總用電日數
			  $LLastFee = $_POST["LLastFee"];//本期總用電度數
			  $LLastDays = $_POST["LLastDays"];//本期總用電日數
			  
			  $LBeforeAvgFee = round(($LBeforeFee / $LBeforeDays), 4);//去年同期平均用電度數
			  $LLastAvgFee = round(($LLastFee / $LLastDays), 4);//本期平均用電度數
			  $LSaveFee = ceil((($LBeforeAvgFee - $LLastAvgFee ) * $LLastDays));//節電量 (去年同期平均用電度數 - 本期平均用電度數) x 本期總用電日數
			  
			  $LImage_file = "";
			  $LRealImgFileName = "";
			  
			  //建立郵件標頭
			  $stmt = $db_link->prepare("UPDATE lottery SET LName=?, LEleNum=?, LAddress=?, LBeforeFee=?, LBeforeDays=?, LLastFee=?, LLastDays=?, LBeforeAvgFee=?, LLastAvgFee=?, LSaveFee=?  WHERE LID=?");
			  if ($stmt->execute(array(GetSQLValueString($LName, "string"), GetSQLValueString($LEleNum, "string"),GetSQLValueString($LAddress, "string"),
			                           GetSQLValueString($LBeforeFee, "int"), GetSQLValueString($LBeforeDays, "int"),GetSQLValueString($LLastFee, "int"),GetSQLValueString($LLastDays, "int"),
			                           GetSQLValueString($LBeforeAvgFee, "float"),GetSQLValueString($LLastAvgFee, "float"),GetSQLValueString($LSaveFee, "int"),
			                           GetSQLValueString($LID, "int")))){
				  echo "<script>alert('參賽者資料已經修改完成!');</script>";
			      //header("Location: ../ShowList/index.php");
				  //exit();
			  }else{
				  echo "<script>alert('參賽者資料修改失敗!');</script>";
			      //header("Location: ../ShowList/index.php");
				  //exit();
			  }
		  }
        ?>
     </font>
     <form action="index.php" method="POST">
	
	
	  
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

<div class="content">	  
	<div class="table-wrapper">
	<table class="table" style="width: 100%;">
	<thead>
		  <tr>
		  
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>2021年台灣節約用電抽獎活動-報名資料修改 - 後台管理系統  </h2></th>
		  </tr>
	</thead>
	</table>
	<tbody>
        <table style="width: 100%;">
	
	
	<!--
		<div class="form-group">
          <h1>節約用電抽獎系統-報名資料填寫 </h1></hr>
		  <h1>抽獎活動報名資料填寫</h1></hr>
	</div>	 

-->	
		  <input type="hidden" id="LID" name="LID" value="<?php echo $LID;?>">
		  
		  
		  
		  <tr>
		  <th>姓名:</th>
		  <td>
		  <div class="col-sm-10">
		  <input type="text" size="45" id="LName" name="LName" value="<?php echo $LName; ?>" required >
		  </div>
          </td>
		  </tr>
		
		
		<tr>
		  <th>地址:</th>
		  <td>
		  <div class="col-sm-10">
		  <input type="text" size="100" id="LAddress" name="LAddress" autocomplete="off" value="<?php echo $LAddress; ?>" required >
		  </div>
          </td></tr>
		  
		  <tr>
		  <th>電表號碼:</th>
		  <td>
		  <div class="col-sm-10">
		  <input type="tel" size="11" id="LEleNum" name="LEleNum" placeholder="00-01-2345-67-8" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-[0-9]{2}-[0-9]{1}"  value="<?php echo $LEleNum; ?>" required >
		  </div>
          </td></tr>
		  
		  <tr>
		  <th>去年同期電費總用電"度數":</th>
		  <td>
		  <div class="col-sm-10">
		  <input type="number" size="100" id="LBeforeFee" name="LBeforeFee" value="<?php echo $LBeforeFee; ?>" required >
		  </div>
          </td></tr>
		  
		  <tr>
		  <th>去年同期電費總用電"日數":</th>
		  <td>
		  <div class="col-sm-10">
		  <input type="number" size="31" id="LBeforeDays" name="LBeforeDays"  value="<?php echo $LBeforeDays; ?>" required >
		  </div>
          </td></tr>
		  
		  <tr>
		  <th>本期電費總用電"度數":</th>
		  <td>
		  <div class="col-sm-10">
		  <input type="number" size="100" id="LLastFee" name="LLastFee" value="<?php echo $LLastFee; ?>"  required >
		  </div>
          </td></tr>
		  
		  <tr>
		  <th>本期電費總用電"日數":</th>
		  <td>
		  <div class="col-sm-10">
		  <input type="number" size="31" id="LLastDays" name="LLastDays"  value="<?php echo $LLastDays; ?>" required >
		  </div>
		  </td></tr>
		  
		  <tr>
      <td>    
	<a href="../ShowList/index.php"><input type="submit" name="Send" value="送出"/></a>
	</td></tr>
		</tbody>
		</table>
 <?php
      }else{
		  echo "<font color='red'><h1>無法操作!您尚未登入此系統!</h1></font>";
		  echo "<hr/><a href='../Home/index.php'><input type='button' class='btn btn-primary' value='回首頁' /></a>";
	  }	
	?>
</table>	
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
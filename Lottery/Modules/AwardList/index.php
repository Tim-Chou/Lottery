<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>開獎-管理者</title>
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


	   <?php
      if(@$_SESSION["account"] == "login"){
   ?>
	  
	  <?php 
	  $status = "";
	   if(isset($_POST["Send"])){
		  $stmt = $db_link->prepare("UPDATE lottery SET LAward=? WHERE LID > 0");
		  if ($stmt->execute(array(GetSQLValueString("", "string")))){
			//echo "<script>alert('得獎名單已成功初始化!');</script>";
		  }else{
			echo "<script>alert('得獎名單初始化失敗!!');</script>"; 
			exit();
		  }
		  
		  $memberList = array();
		  $sql = "SELECT * FROM lottery";
		  $result = $db_link->query($sql);
		  $total_records = $result->rowCount();//
		  if($total_records > 0){//載入開獎者名單
		    $index = 0;
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
			  $memberList[$index++] = $row["LID"];
			}
		  }
		  //進行開獎的前置作業
		   $awardPeop =  ceil(($total_records * 0.25));//中獎人數
		   $seed = rand(0,$total_records);//亂數種子
		   $awards = 0;//中獎號碼-種子
		   $awards += $seed;
		   $awardList = array();
		   for($index=0; $index < $awardPeop; $index++){
			   $awards += $awardPeop;
			   $awardList[$index] = $memberList[($awards % $total_records)];
		   }
		   $awards = 0;
		   //進行開獎作業
		   $award_sql = "UPDATE lottery SET LAward=? WHERE LID IN ( ";
		   $sql_in = "";
		   foreach($awardList as $values){
			  $sql_in .= "".$values.","; 
		   }
		   
		   $sql_in = substr($sql_in,0,(strlen($sql_in)-1));
		   $award_sql .= $sql_in ." )";
		   $stmt_award = $db_link->prepare($award_sql);
		   if($stmt_award->execute(array(GetSQLValueString("Y", "string")))){
			  //echo "以開獎作業完成了! <br/>";
			  $status = "已經完成開獎作業了!";
			  echo "<script>alert('已經完成開獎作業了!');</script>";
			  
		   }else{
			  //echo "開獎作業失敗!<br/>";
			  $status = "開獎作業失敗!";
			  echo "<script>alert('開獎作業失敗!');</script>";
			  //exit();
		   }
		   
	   }
	  ?>
	  <?php
	    if(isset($_POST["Init"])){
		  $stmt = $db_link->prepare("UPDATE lottery SET LAward=? WHERE LID > 0");
		  if ($stmt->execute(array(GetSQLValueString("", "string")))){
			$status = "得獎者名單已經成功初始化!(得獎者名單已經清空!)";
			echo "<script>alert('得獎者名單已經成功初始化!');</script>";
		  }else{
			$status = "得獎者名單初始化失敗!(得獎者名單清空作業失敗!)";
			echo "<script>alert('得獎者名單初始化失敗!!');</script>"; 
			//exit();
		  }
		}
	  ?>
	  


<div class="content">	  
	<div class="table-wrapper">
	<table class="table" style="width: 100%;">
	<thead>
		  <tr>
		  
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>抽獎活動的開獎管理系統 - 後台管理系統</h2></th>
		  </tr>
	</thead>
	</table>
    <table class="table table-hover" style="width: 100%;">
		<thead>
		  <th>初始化</th>
		  <th>開獎</th>
		  <th>開獎作業狀態</th>
          <tr>
		</thead>
		  <tbody>		  
	        <td><input type="submit" name="Init" value="初始化"/></td>
		    <td><input type="submit" name="Send" value="開獎"/></td>
			<td><?php echo $status;?></td>
        </tr>
		</tbody>
		</table>
	 
<?php
      }else{
		  echo "<font color='red'><h1>無法操作!您尚未登入此系統!</h1></font>";
		  ?>
		    <hr/>
		<a href="../Home/index.php"><input type="button" class="btn btn-primary" value="回首頁" /></a>
		  <?php
	  }	
	?>
</form>

<div class="footer">
  <div class="footerText">
       <p> 主辦單位:&nbsp;中國電力公司 </p>
       <p> Copyright&copy;2021&nbsp;Taurus&nbsp;Studio(作者:&nbsp;周彥廷).&nbsp;All&nbsp;rights&nbsp;reserved. </p>
  </div>  
</div>   		
   </body>
</html>
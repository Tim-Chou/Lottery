<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>2021年台灣節約用電抽獎活動 - 系統管理者端</title>
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
   
   
	  <?php
		  if (isset($_POST["login"]) && isset($_POST["aName"]) && isset($_POST["aPassword"]) ){
			  $aName = $_POST["aName"];
			  $aPassword = $_POST["aPassword"];
			  $hasJoined = -1;//-1是防呆初始值;大於等於1是有合法帳號管理者的值，反之數值為0則無此帳號。
			  try{
				  //驗證帳號與密碼
				   $stmt = $db_link->prepare("SELECT * FROM account WHERE aName=? AND aPassword=?");
				   $stmt->execute(array(GetSQLValueString($aName, "string"), GetSQLValueString($aPassword, "string")));
				   $hasJoined = $stmt->rowCount();
				   ///登入區
				   if($hasJoined > 0){//登入成功
				       $_SESSION["user"] = $aName;
					   $_SESSION["account"] = "login";//代表登入
					   echo "<script>alert('登入成功!');</script>";
				   }else{
					  echo "<script>alert('登入失敗!');</script>";
				   }
				   //
				  
				  
			  }catch(PDOException $e){
				  echo "<script>console.log('資料庫錯誤! ".$e->getMessage()." ');</script>";
				  echo '資料庫錯誤! '.$e->getMessage();
			  }
			  
			 
			  
		  }
		  if(isset($_POST["logout"])){
			  session_unset();
			  echo "<script>alert('登出成功!');</script>";
		  }
        ?>
   
   
   
<form action="index.php" method="post">   
   
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
	<table class="table">
	<thead>
		  <tr>
		  <!--<th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>節約用電抽獎系統-報名資料填寫</h2></th>-->
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>首頁</h2></th>
		  </tr>
	</thead>
	</table>
	
		
		
			<div style="text-align: center;">
		<br><h3>管理者帳號登入系統</h3><br><hr/>
         <?php
		 
		    if(!isset($_SESSION["account"])){
				
			?>
			
		<label for="aName" >帳號:</label><br>
		  <input type="text" size="45" id="aName" name="aName" required ><br>
		  
		  <label for="aPassword" >密碼:</label><br>
		  <input type="password" size="45" id="aPassword" name="aPassword"  required ><hr/>
		  <input type="submit" name="login" value="登入"/><input type="hidden" id="log" name="log" value=""/>
		  <br><hr/>
		  
		<?php	
			}else{
				echo "<h2>".$_SESSION["user"] ."，您好!</h2><br><hr/>";
				?>
				<input type="submit" name="logout" onclick="document.getElementById('log').value()='logout';" value="登出"/><input type="hidden" id="log" name="log" value=""/>
			<br><hr/>
			<?php
			}
		 ?>
		 </div>
		 

  
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
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>抽獎系統-報名資料填寫 [抽獎系統 (抽獎功能測試版) -- 初期測試版 version 0.0.1 ]</title>
	  <?php session_start(); ?>
	  <?php
	    header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
	  ?>
   </head>
   <body>
     <font color="red">
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
					   echo '登入成功!';
					   header("Location: ../Home/index.php");
				   }else{
					  echo "<script>alert('登入失敗!');</script>";
					  echo '登入失敗!';
				   }
				   //
				  
				  
			  }catch(PDOException $e){
				  echo "<script>console.log('資料庫錯誤! ".$e->getMessage()." ');</script>";
				  echo '資料庫錯誤! '.$e->getMessage();
			  }
			  
			 
			  
		  }/*else if(isset($_POST["log"]) && ($_POST["log"] == "logout")){
			  session_unset();
			  echo "<script>alert('登出成功!');</script>";
			  echo '登出成功!';
		  }*/
		  if(isset($_POST["logout"])){
			  session_unset();
			  echo "<script>alert('登出成功!');</script>";
			  echo '登出成功!';
		  }
        ?>
     </font>
     <form action="index.php" method="post">
          <h1>抽獎系統 (抽獎功能測試版) -- 初期測試版 version 0.0.1 </h1></hr>
		  <h1>抽獎活動-後臺管理系統</h1></hr>
		  
		  <!-- debug -ok <h4><?php //echo $_SESSION["user"]." is ".$_SESSION["account"]."<br>";//debug ?></h4>-->
		  
		  <label for="aName">帳號:</label><br>
		  <input type="text" size="45" id="aName" name="aName" required ><br>
		  
		  <label for="aPassword">密碼:</label><br>
		  <input type="password" size="45" id="aPassword" name="aPassword"  required ><br>
		  
		  
		<table>
		 <th></th><td><input type="submit" name="login" value="登入"/></td><td><input type="submit" name="logout" onclick="document.getElementById('log').value()='logout';" value="登出"/><input type="hidden" id="log" name="log" value=""/></td>
		</table>
	 </form>	 
   </body>
</html>
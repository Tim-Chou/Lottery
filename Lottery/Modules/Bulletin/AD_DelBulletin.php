<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>佈告欄(刪除公告) - 管理者</title>
	  <?php session_start(); ?>
	  <?php 
	    header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
	  ?>
	  
	  <?php
      if(@$_SESSION["account"] == "login"){
   ?>
	  
	  <?php 
	    $LID = null;
		if (isset($_GET["bID"])){
			  $bID = $_GET["bID"];
			  //
			$result = $db_link->prepare("DELETE FROM bulletin WHERE bID=?");
			if ($result->execute(array( GetSQLValueString($bID, "int")))){
				echo "<script>alert('此參賽者已成功被刪除了!');</script>";
			    header("Location: ../Bulletin/index.php");
				exit();
		    }else{
			    echo "<script>alert('公告刪除失敗!');</script>";
			    header("Location: ../Bulletin/index.php");
			    exit(); 
		  }
		}else{
			 echo "<script>alert('參賽者刪除失敗!');</script>";
			 header("Location: ../Bulletin/index.php");
			 exit(); 
		}
		
	  ?>
   </head>
   <body>
    <?php
      }else{
		  echo "<script>alert('無法操作!您尚未登入此系統!');</script>";
	  }	
	?>	
   </body>
</html>
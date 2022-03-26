<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>抽獎系統-報名資料填寫 [抽獎系統 (抽獎功能測試版) -- 初期測試版 version 0.0.1 ]</title>
	  <?php 
	    header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
	  ?>
	  
	  <?php
	    
	    $tID =   1;
		$tStart = null;
		$tEnd = null;
		//$toDay =  date("Y-m-d").'T'. date("h:i:s");
		
	
		$result = $db_link->prepare("SELECT * FROM active_date WHERE tID=?");
	    if ($result->execute(array( GetSQLValueString($tID, "int")))){
			while($row = $result->fetch()){
				$tStart = $row["tStart"];
		        $tEnd = $row["tEnd"];
			}
		}
		
		$isToYearStart = (GetSQLValueString("".date("Y"),"int") < GetSQLValueString(substr($tStart,0,4),"int") ) ;
		$isToMonStart  = (GetSQLValueString("".date("m"),"int") < GetSQLValueString(substr($tStart,5,2),"int") ) ;
		$isToDayStart  = (GetSQLValueString("".date("d"),"int") < GetSQLValueString(substr($tStart,8,2),"int") ) ;
		
		$isToHStart  = (GetSQLValueString("".date("h"),"int") < GetSQLValueString(substr($tStart,11,2),"int") );
		$isToMinStart  = (GetSQLValueString("".date("i"),"int") < GetSQLValueString(substr($tStart,14,2),"int") );
		$isToSecStart  = (GetSQLValueString("".date("s"),"int") < GetSQLValueString(substr($tStart,18,2),"int") );
		
		
		
		$isToYearEnd = (GetSQLValueString("".date("Y"),"int") > GetSQLValueString(substr($tEnd ,0,4),"int") );
		$isToMonEnd = (GetSQLValueString("".date("m"),"int") > GetSQLValueString(substr($tEnd ,5,2),"int") );
		$isToDayEnd = (GetSQLValueString("".date("d"),"int") > GetSQLValueString(substr($tEnd ,8,2),"int") );
		
		$isToHEnd = (GetSQLValueString("".date("h"),"int") > GetSQLValueString(substr($tEnd ,11,2),"int") );
		$isToMinEnd = (GetSQLValueString("".date("i"),"int") > GetSQLValueString(substr($tEnd ,14,2),"int") );
		$isToSecEnd = (GetSQLValueString("".date("s"),"int") > GetSQLValueString(substr($tEnd ,18,2),"int") );
		
	
		
		
		//if(($isToYearStart || $isToMonStart || $isToDayStart) /*&& ( $isToHStart || $isToMinStart || $isToSecStart)*/){ //時機未到
		if(($isToYearStart || $isToMonStart || $isToDayStart)  ){ //時機未到
		  if(( $isToHStart || $isToMinStart)){
            echo "<body><font color='red'><h1>活動時間尚未開始! </h1></font><br/>";
		    exit();
		  }else{
			  
			echo "<body><font color='red'><h1>Hi!</h1></font><br/>";
		  }
		//}else if(($isToYearEnd || $isToMonEnd || $isToDayEnd)/*  && ($isToHEnd || $isToMinEnd|| $isToSecEnd)*/){ //錯過良機
		}else if(($isToYearEnd || $isToMonEnd || $isToDayEnd)  || (($isToHStart || $isToHEnd) && ($isToMinStart || $isToMinEnd ))){ //錯過良機
		  if(( $isToHEnd || $isToMinEnd)){
		    echo "<body><font color='red'><h1>活動時間已經結束! </h1></font><br/>";
		    exit();
		  }
		}else{//天賜良機
	  ?>
	  
   </head>
   <body>
     <font color="red">
        <?php
		  if (isset($_POST["Send"]) && isset($_POST["LName"]) && isset($_POST["LEmail"]) && isset($_POST["LTel"]) ){
			  $LName = $_POST["LName"];
			  $LEmail = $_POST["LEmail"];
			  $LTel= $_POST["LTel"];
			  $hasJoined = -1;//-1是防呆初始值;0是查詢過且非重複報名者值，>1是以重複報名者值。
			  try{
				  //驗證是否重複報名
				   $stmt = $db_link->prepare("SELECT * FROM lottery WHERE LName=? AND LEmail=? OR LTel=?");
				   $stmt->execute(array(GetSQLValueString($LName, "string"), GetSQLValueString($LEmail, "string"),GetSQLValueString($LTel, "string")));
				   $hasJoined = $stmt->rowCount();
				   ///報名區
				   if($hasJoined >= 1){//重複報名
					   echo "<script>alert('錯誤!您已經報名過了!');</script>";
				   }else if($hasJoined == 0){//可報名
					   $stmt_join = $db_link->prepare("INSERT INTO lottery(LName, LEmail, LTel) VALUES(?, ?, ?)");
			           if ($stmt_join->execute(array(GetSQLValueString($LName, "string"), GetSQLValueString($LEmail, "string"), GetSQLValueString($LTel, "int")))){
						   echo "您已經完成抽獎活動報名手續! <br/>";
					   }else{
						   echo "報名失敗! <br/>";
					   }
					   /////////////// 
				   }else{
					   echo "資料庫重複報名驗證錯誤!";
				   }
				   //
				  
			  }catch(PDOException $e){
				  echo "<script>console.log('資料庫錯誤! ".$e->getMessage()." ');</script>";
			  }
			  
			 
			  
		  }else if(isset($_POST["Send"])){
			  echo "請完整填寫報名資料!<br/>";
		  }
        ?>
     </font>
     <form action="index.php" method="post">
          <h1>抽獎系統 (抽獎功能測試版) -- 初期測試版 version 0.0.1 </h1></hr>
		  <h1>抽獎活動報名資料填寫</h1></hr>
		  
		  <label for="LName">姓名:</label><br>
		  <input type="text" size="45" id="LName" name="LName" required ><br>
		  
		  <label for="LEmail">Email:</label><br>
		  <input type="email" size="100" id="LEmail" name="LEmail" autocomplete="off" required ><br>
		  
		  <label for="LTel">手機號碼:</label><br>
		  <input type="tel" size="12" id="LTel" name="LTel" placeholder="0901-234-567" pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" required ><br><br>
		  
		
		<input type="submit" name="Send" value="報名"/>
	 </form>
   <?php } ?>		 
   </body>
	
</html>



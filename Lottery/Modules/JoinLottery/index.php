<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>(抽獎報名資料填寫)-管理者</title>
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
   </head>
   <body>
   
     <form action="index.php" method="post" enctype="multipart/form-data">
	 <!--<div class="form-group">
          <h1>節約用電抽獎系統-報名資料填寫 </h1></hr>
		  <h1>抽獎活動報名資料填寫</h1></hr>
	</div>	--> 
	<!--
<table class="table">
	<thead > 
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>2021年台灣節約用電抽獎活動</h2></th>
	</thead>
	
	</table>
-->
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
   
     <font color="red">
        <?php
		  if (isset($_POST["Send"]) && isset($_POST["LName"]) && isset($_POST["LEleNum"]) && isset($_POST["LAddress"]) && 
		  isset($_POST["LBeforeFee"])  && isset($_POST["LBeforeDays"]) && isset($_POST["LLastFee"]) && isset($_POST["LLastDays"])/* 需測試-> */ && isset($_FILES["LImage_file"])){
			  $LName = $_POST["LName"];
			  $LEleNum = $_POST["LEleNum"];
			  $LAddress= $_POST["LAddress"];
			  
			  $LBeforeFee = $_POST["LBeforeFee"];//去年同期總用電度數
			  $LBeforeDays = $_POST["LBeforeDays"];//去年同期總用電日數
			  $LLastFee = $_POST["LLastFee"];//本期總用電度數
			  $LLastDays = $_POST["LLastDays"];//本期總用電日數
			  
			  $LBeforeAvgFee = round(($LBeforeFee / $LBeforeDays), 4);//去年同期平均用電度數
			  $LLastAvgFee = round(($LLastFee / $LLastDays), 4);//本期平均用電度數
			  //$LSaveFee = round((($LBeforeAvgFee - $LLastAvgFee ) * $LLastDays));////節電量 (去年同期平均用電度數 - 本期平均用電度數) x 本期總用電日數 //ceil((($LBeforeAvgFee - $LLastAvgFee ) * $LLastDays));
			  $LSaveFee = ceil((($LBeforeAvgFee - $LLastAvgFee ) * $LLastDays));
			  //echo "<script>alert('LSaveFee: ".$LSaveFee."');</script>";
			  
			  
			  $LImage_file = "";
			  $LRealImgFileName = "";
			  
			  $onSetDBFlag = false;
			  
			  if($LSaveFee < 1){
				  echo "<script>alert('對不起!您的節電量未滿1度電，無法參加抽獎！');</script>";
			  }else{

			  $hasJoined = -1;//-1是防呆初始值;0是查詢過且非重複報名者值，>1是以重複報名者值。
			  try{
				  //驗證是否重複報名
				   $stmt = $db_link->prepare("SELECT * FROM lottery WHERE LName=? OR LEleNum=? OR LAddress=?");
				   $stmt->execute(array(GetSQLValueString($LName, "string"), GetSQLValueString($LEleNum, "string"),GetSQLValueString($LAddress, "string")));
				   $hasJoined = $stmt->rowCount();
				   ///報名區
				   if($hasJoined >= 1){//重複報名
					   echo "<script>alert('錯誤!您已經報名過了!');</script>";
				   }else if($hasJoined == 0){//可報名
				   //
			  
			  date_default_timezone_set("Asia/Taipei");
			  @$date = "".date("Y-m-d").'T'.date("H-i-s").'_'.round((microtime() * 1000000));
			   $filesName = $date.'__SN__'.$LEleNum.substr( $_FILES['LImage_file']['name'],strrpos($_FILES['LImage_file']['name'],'.',0));
	          

              if ($_FILES['LImage_file']['error'] === UPLOAD_ERR_OK){
		
                 # 檢查檔案是否已經存在
			   //if(strcmp($signUpError,"") == 0){ 
	          	 if (file_exists('../../upload_img/' . $filesName)){  
                      echo '檔案已存在。<br/>';
                 }else {
                      $file = $_FILES['LImage_file']['tmp_name'];
		              $dest = '../../upload_img/' .$filesName;
					  $LImage_file .= $dest;
			
		          	#檢查照片尺寸
			          $img = getimagesize($file); 
                      // $img[0] 圖像的寬度   
                      // $img[1] 圖像的高度 			
			          $width = $img[0];
                      $height = $img[1];
	                   if(($width  >= 600) && ($height >= 900)){
						 //if(strcmp($signUpError,"") == 0){   
				            # 將檔案移至指定位置 
                            move_uploaded_file($file, $dest);
				            $LImage_file = $dest;//$filesName;//
							$LRealImgFileName = $filesName;
				            $onSetDBFlag = true;
				         //}
		               }else{
				          $onSetDBFlag = false;
				          echo "<h1>尺寸不合: width = "."$width"."height = "."$height"."</h1><hr/>";
				          header("Location: ../JoinLottery/index.php");
						  exit();
			           }
				 }  
			  } else {
                    echo '錯誤代碼：' . $_FILES['LImage_file']['error'] . '<br/>';
                 }
				   //
				   if($onSetDBFlag){//驗證圖檔
				   
					   $stmt_join = $db_link->prepare("INSERT INTO lottery(LName, LEleNum, LAddress, LBeforeFee, LBeforeDays, LLastFee, LLastDays, LBeforeAvgFee, LLastAvgFee, LSaveFee, LImage_file, LRealImgFileName , LAdd_time)".
					   " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,? )");
			           if ($stmt_join->execute(array(GetSQLValueString($LName, "string"), GetSQLValueString($LEleNum , "string"), 
					   GetSQLValueString($LAddress , "string"),GetSQLValueString($LBeforeFee, "float"),GetSQLValueString($LBeforeDays, "int"), 
					   GetSQLValueString($LLastFee, "float"),GetSQLValueString($LLastDays, "int"),
					   GetSQLValueString($LBeforeAvgFee, "float"),GetSQLValueString($LLastAvgFee, "float"),
					   GetSQLValueString($LSaveFee, "int"),GetSQLValueString($LImage_file, "string"),
					   GetSQLValueString($LRealImgFileName , "string"),GetSQLValueString("".date("Y-m-d").'T'.date("H:i:s") , "string")))){
						   echo "<script>alert('您已經完成抽獎活動報名手續!'); </script>";
					   }else{
						   echo "<script>alert('報名失敗!'); </script>";
					   }
					   /////////////// 
				   }else{//驗證圖檔
					   echo "<h1>報名失敗! 上傳檔案發生問題</h1>";
					   exit();
				   }//驗證圖檔
					   ////
				   }else{
					   echo "<script>alert('資料庫重複報名驗證錯誤!'); </script>";
				   }
				   //
				   
				   //
				  
			  }catch(PDOException $e){
				  echo "<script>console.log('資料庫錯誤! ".$e->getMessage()." ');</script>";
			  }
				   }
	//}	  
			 
			  
		  }else if(isset($_POST["Send"])){
			  echo "請完整填寫報名資料!<br/>";
		  }
        ?>
     </font>
	
<div class="content">	  
	<div class="table-wrapper">
	<table class="table">
	<thead>
		  <tr>
		  <!--<th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>節約用電抽獎系統-報名資料填寫</h2></th>-->
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>報名資料填寫</h2></th>
		  </tr>
	</thead>
	</table>
	
		<table class="table">
          <thead>
		  
		  
            <tr>
		    <th>用戶個資</th>
            <th>用電度數</th>
            <th>用電日數</th>
			<th>上傳電費帳單照片</th>
			<th>活動報名</th>
            </tr>
          </thead>
		  <tbody>
      <tr>
        <td data-title="用戶個資">
          <ul>
            <li>姓名<br>
			    
		        <input type="text" size="30" id="LName" name="LName" required >
		        
			</li>
			
            <li>地址<br>
			   
		       <input type="text" size="30" id="LAddress" name="LAddress" autocomplete="off" required >
		       
			</li>
			
            <li>電表號碼<br>
			   
		        <input type="tel" size="30" id="LEleNum" name="LEleNum" placeholder="00-01-2345-67-8" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}-[0-9]{2}-[0-9]{1}"  required >
		       
			</li>
          </ul>
        </td>
		
		<td data-title="用電度數">
          <ul>
            <li>去年同期用電度數<br>
			   
		       <input type="number" size="100" id="LBeforeFee" name="LBeforeFee"  required >
		      
			</li>
			
            <li>本期電費用電度數<br>
			    
		        <input type="number" size="100" id="LLastFee" name="LLastFee"  required >
		        
			</li>
          </ul>
        </td>
		
		<td data-title="用電日數">
          <ul>
            <li>去年同期用電日數<br>
			   
		       <input type="number" size="31" id="LBeforeDays" name="LBeforeDays"  required >
		       
			</li>
			
            <li>本期用電日數<br>
			   
		       <input type="number" size="31" id="LLastDays" name="LLastDays"  required >
		       
			</li>
          </ul>
        </td>
		<td data-title="上傳電費帳單照片">
          <ul>
            <li>上傳照片[拍照電費帳單(或電子帳單螢幕節圖)進行上傳(用電戶號(電表號碼號)及用電度數與用電日數需清晰可辨)](照片大小:600x900或以上)<br>
			    
                 <input type="file" class="form-control" name="LImage_file" id="LImage_file" required="required">
                
			</li>
          </ul>
        </td>
		
		<td data-title="活動報名">
          <ul>
            <li>我要報名<br>
			    
                 <input type="submit" name="Send" value="我要報名"/>
                
			</li>
          </ul>
        </td>
		
		</tr>
    </tbody>

  </table>
  
</div>

</div>


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
</form>	
   </body>
</html>
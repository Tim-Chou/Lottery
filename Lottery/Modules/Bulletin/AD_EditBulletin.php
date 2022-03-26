<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title> 佈告欄(修改) - 管理者</title>
	  <?php 
	    header("Content-Type: text/html; charset=utf-8");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
		include_once("../../Include/incBootstrap.php");
		include_once("../../Include/TempStyleCss.php");
		include_once("../../Include/joinLotteryCss.php");
	  ?>
	  
	  
	  <style>
	    .bulletinTable{
             border: 1px solid black;
			 width: 1600px;/*85%;*/
			 height: 600px;
			 position: relative;/*absolute;*/
			 left: 115px;
			 top: 170px;
        }
		.bulletinTable th, .bulletinTable td {
		   border: 1px solid black;
		}
		
		
		
		.TableTdTitle{
		  height: 50px;
		  width: 100%;
		}
		
		
		.bTitle{
		   width: 85%;
		   height: 40px;
           border: 1px;
           padding: 11px;
           margin: 1px;
		   
		   
		   text-align: left;
		   font-size: 200%;
		}
		.bDate{
		  
		   width: 98%;
		   height: 20px;
           border: 1px;
           padding: 1px;
           margin: 1px;
		   text-align: right;
		   font-size: 125%;
		}
		
		
		.TableTdContext{
		  height: 400px;
		  width: 100%;
		  border: 2px solid black;
		}
		.bContext{
		  width: 96%;
		  height: 350px;
          border: 5px;
          padding: 5px;
          margin: 5px;
		  font-size: medium;
		  text-align: justify;
		}
		
		
		
		
		
		.TableTdFile{
		  height: 30px;
		  width: 100%;
		  
		  
          padding: 5px;
          margin: 1px;
		  font-size: medium;
		  text-align: left;
		  border: 1px solid black;
		  
		}
		
		
		
		.TableTdURL{
		  height: 30px;
		  width: 100%;
		  
		  
          padding: 5px;
          margin: 1px;
		  font-size: medium;
		  text-align: left;
		  border: 1px solid black;
		}
		
		/*
		.xTable{
		  border: 1px;
		}
		.xTable th, .xTable td {
		   border: 1px;
		}*/
		
	 </style>
	  
	  
   </head>
   <body>
   <form action="" method="get">		
<div class="title">
<h2>2021年台灣節約用電抽獎活動</h2>
</div>

<!--	 
<div class="topnav">
<a href="../Home/index.php">首頁</a>
<a href="../Bulletin/index.php">公佈欄</a>
<a href="../Info/index.php">活動辦法</a>
<a href="../JoinLottery/index.php">活動報名</a>
<a href="../ShowAward/index.php">得獎名單</a>
<div class="topnavA2"><a href="../../System/Main/Home/index.php" >參賽者/管理專區</a></div>
</div>	
-->
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
		    if(isset($_GET["bID"])){
			  $bID = $_GET["bID"];
			  $result = $db_link->prepare("SELECT * FROM bulletin WHERE bID=?");
			  $result->execute(array(GetSQLValueString($bID, "int")));
			  $total_records = $result->rowCount();
			  
			  
			  
        ?>
		<?php
		  if($total_records > 0 ){
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
		?>
		
</form>	
		
<form action="" method="post" enctype="multipart/form-data">


<div class="content">	  
	<div class="table-wrapper">
	<table class="table" style="width: 100%;">
	<thead>
		  <tr>
		  
		  <th class="TableTdTitle"  style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><div class="bTitle"><?php echo sprintf("%s",$row["bTitle"]); ?></div> <div class="bDate"><?php echo sprintf("%s",$row["bStartDate"]); ?> ~ <?php echo sprintf("%s",$row["bEndDate"]); ?></div></th>
		  </tr>
	</thead>
	</table>		
	<tbody>
	<input type="hidden" name="bID" id="bID" value="<?php echo sprintf("%d",$row["bID"]); ?>">
	<td>
		  <table>
		  <th>公告標題名稱:</th>
		  <td><input type="text" name="bTitle" id="bTitle" value="<?php echo sprintf("%s",$row["bTitle"]); ?>" required/></td>
		  </table>
	</td>
	
	<td>
		  <table>
		  <th>公告上架時間:</th>
		  <td><input type="text" name="bStartDate" id="bStartDate" value="<?php echo sprintf("%s",$row["bStartDate"]); ?>" placeholder="ex: 2021-01-01"  pattern="\d{4}-\d{2}-\d{2}" required/></td>
		  </table>
	</td>
	
	
	<td>
		  <table>
		  <th>公告下架時間:</th>
		  <td><input type="text" name="bEndDate" id="bEndDate" value="<?php echo sprintf("%s",$row["bEndDate"]); ?>" placeholder="ex: 2021-12-31"  pattern="\d{4}-\d{2}-\d{2}" required/></td>
		  </table>
	</td>
	  
	 <td>
		  <table>
		  <th>置頂:</th>
		  <td><input type="checkbox" name="bOnTop[]" value="<?php echo  sprintf("%s",$row["bOnTop"]); ?>" <?php if(sprintf("%s",$row["bOnTop"]) === "Y"){ echo "checked";} ?> /></td>
		  </table>
	</td>  
	  
  
	 <tr><td class="TableTdContext">
	     <table>
	     <th>公告本文：</th>
		 <tr></tr>
		 <td><textarea name="bContext" id="bContext" rows="10" cols="250" required><?php echo sprintf("%s",$row["bContext"]); ?></textarea></td>
		 </table>
		 </td>
	</tr>
		 
	 <tr>
	 <hr/>
	 <td class="TableTdFile">
	   <!--<table class="xTable">-->
	   <table>
	    
		  <th>附加檔案名稱：</th>
		  
		  <td>
		  <div style="text-align:left;width:200%"><?php echo sprintf("%s",$row["bAddFileName"]); ?></div>
		  <!--<input type="text" size="100" id="bAddFileName" name="bAddFileName" value="<?php //echo sprintf("%s",$row["bAddFileName"]); ?>"   >-->
		  </td><tr></tr>
		  
		<th>附加檔案上傳：</th>
		<td>
		  <input type="file" class="form-control" name="bAddFileDir" id="bAddFileDir" >
		  
		</td>
	    
		</td>
	   </table>
	 </td></tr>
	 
	 
	 <tr>
	 <hr/>
	 <td class="TableTdURL">
	   <!--<table class="xTable">-->
	   <table>
	    
	    
	      <th>外部相關網頁連結-網頁名稱：</th>
		  <td><input type="text" size="100" id="bAddURLName" name="bAddURLName" value="<?php echo sprintf("%s",$row["bAddURLName"]); ?>"   ></td>
	    
		
		
		<th>外部相關網頁連結-URL網址：</th>
		<td><input type="text" size="100" id="bAddURL" name="bAddURL" value="<?php echo sprintf("%s",$row["bAddURL"]); ?>"  ></td>
		
	   </table>
	   
	   
	 </td></tr>
	 
	 <!--<div style="position: relative;left: 50%;" ><a href="../Bulletin/index.php"><input type="button" value="回上一頁" class="btn" /></a></div>-->
	 <table style="position: relative;left: 50%;">
	 <th><div style="position: relative;left: -200%;" ><a href="../Bulletin/index.php"><input type="button" value="回上一頁" class="btn" /></a></div></th>
     <th><div style="position: relative;left: 50%;" ><input type="submit" value="送出" name="MM_Insert" id="MM_Insert" class="btn" /></div></th>
	 </table>
</table> 
<?php 
	    if(isset($_POST["MM_Insert"]) && isset($_POST["bID"]) && isset($_POST["bTitle"]) && 
		isset($_POST["bStartDate"]) && isset($_POST["bEndDate"]) && 
		isset($_POST["bContext"]) && /*isset($_POST["bAddFileName"]) &&*/
		isset($_FILES["bAddFileDir"]) && isset($_POST["bAddURLName"]) && isset($_POST["bAddURL"])){
			try{
				// upload add file
				
			 date_default_timezone_set("Asia/Taipei");
			  @$date = "".date("Y-m-d").'T'.date("H-i-s").'_'.round((microtime() * 1000000));
			  $filesName = $date.'__SN__'.$_FILES['bAddFileDir']['name']/*.substr( $_FILES['bAddFileDir']['name'],strrpos($_FILES['bAddFileDir']['name'],'.',0))*/;
	          

              if ($_FILES['bAddFileDir']['error'] === UPLOAD_ERR_OK){
		
                 # 檢查檔案是否已經存在
			   //if(strcmp($signUpError,"") == 0){ 
	          	 if (file_exists('../../upload_file/' . $filesName)){  
                      echo '檔案已存在。<br/>';
                 }else {
                      $file = $_FILES['bAddFileDir']['tmp_name'];
		              $dest = '../../upload_file/' .$filesName;
					  
			
		          	
						  
				            # 將檔案移至指定位置 
                            move_uploaded_file($file, $dest);
				            $BAddFileDir_file = 'upload_file/'.$filesName;//$dest;
				           
				         
		               
				 }  
			  } else {
                    echo '錯誤代碼：' . $_FILES['bAddFileDir']['error'] . '<br/>';
                 }
				
				// upload add file
				$bOnTop = "";
		        if(isset($_POST["bOnTop"])){
			       $bOnTop = "Y";
		        }else{
			       $bOnTop = "N";
		        }
				if($_FILES["bAddFileDir"]["name"] === ""){
					$result = $db_link->prepare("UPDATE bulletin SET bTitle=?, bStartDate=?, bEndDate=?, bContext=?, bAddURLName=?, bAddURL=?, bOnTop=?  WHERE bID=?");
			        $result->execute(array(GetSQLValueString($_POST["bTitle"], "string"),GetSQLValueString($_POST["bStartDate"], "string"),
			        GetSQLValueString($_POST["bEndDate"], "string"),GetSQLValueString($_POST["bContext"], "string"),GetSQLValueString($_POST["bAddURLName"], "string"),GetSQLValueString($_POST["bAddURL"], "string"),GetSQLValueString($bOnTop, "string"),
			        GetSQLValueString($_POST["bID"], "int")));
				}else{	
			        $result = $db_link->prepare("UPDATE bulletin SET bTitle=?, bStartDate=?, bEndDate=?, bContext=?, bAddFileName=?, bAddFileDir=?, bAddURLName=?, bAddURL=?, bOnTop=?  WHERE bID=?");
			        $result->execute(array(GetSQLValueString($_POST["bTitle"], "string"),GetSQLValueString($_POST["bStartDate"], "string"),
			        GetSQLValueString($_POST["bEndDate"], "string"),GetSQLValueString($_POST["bContext"], "string"),GetSQLValueString($filesName, "string"),
			        GetSQLValueString($BAddFileDir_file, "string"),GetSQLValueString($_POST["bAddURLName"], "string"),GetSQLValueString($_POST["bAddURL"], "string"),GetSQLValueString($bOnTop, "string"),
			        GetSQLValueString($_POST["bID"], "int")));
				}
			  echo "<script>alert('成功更新公告!');</script>";
			}catch(Exception $e){
				 echo "<script>alert('更新失敗: ".GetSQLValueString($e->getMessage(),"string")."');</script>";
			}
		}
	  
	  
	  ?> 
<?php
      }
   }
 }
?>	

		
</div>

</div>

	 </form>
    
 <div class="footer">
  <div class="footerText">
       <p> 主辦單位:&nbsp;中國電力公司 </p>
       <p> Copyright&copy;2021&nbsp;Taurus&nbsp;Studio(作者:&nbsp;周彥廷).&nbsp;All&nbsp;rights&nbsp;reserved. </p>
  </div>  
</div>       
		 
   </body>
</html>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>公佈欄 - 管理者</title>
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
<form action="index.php" method="get">		
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
			  //$sql = "SELECT * FROM bulletin ORDER BY bStartDate DESC";
			  date_default_timezone_set("Asia/Taipei");
		      @$date = "".date("Y-m-d");
			  //$sql = "SELECT * FROM bulletin WHERE bStartDate <= '".$date."' AND bEndDate >= '".$date."' ORDER BY bOnTop  DESC";
			  $sql = "SELECT * FROM bulletin ORDER BY bOnTop DESC";
			  $result = $db_link->query($sql);
			  $total_records = $result->rowCount();
			  
        ?>
		<?php
		
		  $per = 4; //每頁顯示項目數量
          $pages = ceil($total_records /$per); //取得不小於值的下一個整數
          if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
            $page=1; //則在此設定起始頁數
          } else {
            $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
          }
           $start = ($page-1)*$per; //每一頁開始的資料序號
		   $result = $db_link->query($sql.' LIMIT '.$start.', '.$per) or die("Error");
		   
		?>
	

<div class="content">	  
	<div class="table-wrapper">
	<table class="table" style="width: 100%;">
	<thead>
		  <tr>
		  
		  <th class="TableTdTitle"  style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>佈告欄- 後台管理系統</h2></th>
		  </tr>
	</thead>
	</table>		
     <tbody> 
	 
</table>  

<table class="table table-hover" style="width: 100%;">
<thead>
<div style="position:relative;left:15px;top:-10px;"><a href="../Bulletin/AD_AddBulletin.php"><input type="button" name="createdNotice" id="createdNotice" class="btn btn-primary" value="新增新公告" /></a></div>
</thead>
<tbody>
		<?php
		$arrayOnTop = array();
		$onTopIndex = 0;
		
		$arrayNonTop = array();
		$nonTopIndex = 0;
		/*date_default_timezone_set("Asia/Taipei");
		@$date = "".date("Y-m-d");
		*/
		
        if($total_records > 0 ){
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
	 ?>	  
	 <?php 
	 //strcmp(string1,string2) =>「 <0 - 如果string1 小於string2」
	    //if((strcmp($row["bStartDate"],$date) <= 0) && (strcmp($row["bEndDate"],$date) >= 0) ){//日期核對
	 ?>
	 
		   <?php
		  
		     
			 if($row["bOnTop"] == "Y"){ //置頂
				  $titleStr = "<table style='width: 115%;'><th style='text-align: left;font-size: 200%;'>置頂公告</th><th style='text-align: center;font-size: 200%;'>".$row["bTitle"]."</th> <td style='text-align: right;font-size: 100%;'>".$row['bStartDate']." ~ ".$row['bEndDate']."</td></table>";
			      $arrayOnTop[$onTopIndex++] = "<tr><td nowrap='nowrap'><a href='Show_Context.php?bID=".GetSQLValueString($row["bID"],"int")."' >".$titleStr."</a></td><th style='text-align: left;font-size: 150%;'>修改/刪除</th><td style='text-align: right;font-size: 100%;'><a href='AD_EditBulletin.php?bID=".GetSQLValueString($row["bID"],"int")."' >"."<input type='button' class='btn btn-primary'  name='edit' value='修改'></a></td><td style='text-align: right;font-size: 100%;'><a href='AD_DelBulletin.php?bID=".GetSQLValueString($row["bID"],"int")."' >"."<input type='button' class='btn btn-danger'  name='del' value='刪除'></a></td></tr>";
			 }else if($row["bOnTop"] == "N"){
			   $titleStr = "<table style='width: 115%;'><th style='text-align: left;font-size: 200%;'>一般公告</th><th style='text-align: center;font-size: 200%;'>".$row["bTitle"]."</th> <td style='text-align: right;font-size: 100%;'>".$row['bStartDate']." ~ ".$row['bEndDate']."</td></table>";
			   $arrayNonTop[$nonTopIndex++] = "<tr><td nowrap='nowrap'><a href='Show_Context.php?bID=".GetSQLValueString($row["bID"],"int")."' >".$titleStr."</a></td><th style='text-align: left;font-size: 150%;'>修改/刪除</th><td style='text-align: right;font-size: 100%;'><a href='AD_EditBulletin.php?bID=".GetSQLValueString($row["bID"],"int")."' >"."<input type='button' class='btn btn-primary'  name='edit' value='修改'></a></td><td style='text-align: right;font-size: 100%;'><a href='AD_DelBulletin.php?bID=".GetSQLValueString($row["bID"],"int")."' >"."<input type='button' class='btn btn-danger'  name='del' value='刪除'></a></td></tr>";
			 }
		  ?>
		  
		<?php
		  
        ?>		 
		  
		  
		  
		  <?php 
			}//sql query
		?>
		<?php
		//防止空值陣列的錯誤
		  if((count($arrayOnTop) > 0) || (count($arrayNonTop) > 0)){
			 
		?>
		<?php
		 
		    foreach($arrayOnTop as $showTop){
			    echo $showTop;
				
			}
			
			
			   foreach($arrayNonTop as $show){
			      echo $show;
			   }
			
		?>
</tbody>
</table>
		<?php 
		/*
		   //防止空值陣列的錯誤
		  }else{
			  echo "<tr><th></th><th><td nowrap='nowrap' style='text-align: center;font-size: 200%;'>沒有一筆公告!</td></th></tr>";
		  }
		?>
		<?php
		 }else{
			 echo "<tr><th></th><th><td nowrap='nowrap' style='text-align: center;font-size: 200%;'>沒有一筆公告!</td></th></tr>";
		 }
		 */
		 //防止空值陣列的錯誤
		  }else{
			  echo "<tr><th></th><th><td nowrap='nowrap' style='text-align: center;font-size: 200%;'>沒有一筆公告!</td></th></tr>";
		  }
		}else{
		   //echo "<tr><th><font color='red'><h1>沒有一筆公告!</h1></font></th></tr>";
		   echo "</tbody></table>";
		   echo "<font color='red'><h1>沒有一筆公告!</h1></font>";
		 }
		?>
<!--</tbody>
</table>-->
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
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>佈告欄(內容) - 管理者</title>
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
   <form action="index.php" method="get">		
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
	  
	  <!--<table class="bulletinTable">-->
	  
  
	 <tr><td class="TableTdContext">
	     <div class="bContext">
	        <?php echo sprintf("%s",$row["bContext"]); ?>
		 </div>
		 </td></tr>
		 
	 <tr>
	 <hr/>
	 <td class="TableTdFile">
	   <!--<table class="xTable">-->
	   <table>
	    <th>附加檔案：</th>
		<td><a href="../../<?php echo sprintf("%s",$row["bAddFileDir"]); ?>"><?php echo sprintf("%s",$row["bAddFileName"]); ?></a></td>
	    
	   </table>
	 </td></tr>
	 
	 <tr>
	 <hr/>
	 <td class="TableTdURL">
	   <!--<table class="xTable">-->
	   <table>
	    <th>外部相關網頁連結：</th>
		<td><a href="<?php echo sprintf("%s",$row["bAddURL"]); ?>"><?php echo sprintf("%s",$row["bAddURLName"]); ?></a></td>
	    
	   </table>
	 </td></tr>
	 <hr/>
     <tr>
	 <td>
	    <div style="position: relative;left: 50%;" ><a href="../Bulletin/index.php"><input type="button" value="回上一頁" class="btn" /></a></div>
	 </td>
	 </tr>
</table>  
<?php
      }
   }
 }
?>	
	  
	  
	  
        <!--<table class="table table-hover" style="width: 85%;">-->
		
		
		<!--<thead>
		  <th>參賽者ID</th>
		  
		  
		  <tr>
		  </thead>
		  <tbody>-->
		<?php
		/*
        if($total_records > 0 ){
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
	 ?>	  
		  
		  <?php
		     echo "<tr>";
		     echo sprintf("<td>%d</td>",$row["LID"]);
			 echo sprintf("<td>%s</td>",$row["LName"]);
			 
			 echo sprintf("<td><a href='"."%s"."'><img src='"."%s"."' width='100' height='150'></a><br>%s</td>",substr($row["LImage_file"],3,(strlen($row["LImage_file"])-3)),substr($row["LImage_file"],3,(strlen($row["LImage_file"])-3)),$row["LRealImgFileName"]);
			 echo sprintf("<td>%s</td>",$row["LAdd_time"]);
			 
			 echo "</tr>";
		  ?>
		  <?php 
			}
		 }else{
			 echo "沒有一筆資料!";
		 }*/
		?>
		<!--</tbody>
		</table>-->
		
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
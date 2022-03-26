<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>得獎者名單</title>
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
	 
<div class="topnav">
<a href="../Home/index.php">首頁</a>
<a href="../Bulletin/index.php">公佈欄</a>
<a href="../Info/index.php">活動辦法</a>
<a href="../JoinLottery/index.php">活動報名</a>
<a href="../ShowAward/index.php">得獎名單</a>
<div class="topnavA2"><a href="../../../Modules/Home/index.php" >參賽者/管理專區</a></div>
</div>	
        <?php
		/*
			  $sql = "SELECT * FROM lottery";
			  $result = $db_link->query($sql);
			  $total_records = $result->rowCount();
			  */
        ?>
		<?php
		/*
		  $per = 2; //每頁顯示項目數量
          $pages = ceil($total_records /$per); //取得不小於值的下一個整數
          if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
            $page=1; //則在此設定起始頁數
          } else {
            $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
          }
           $start = ($page-1)*$per; //每一頁開始的資料序號
		   $result = $db_link->query($sql.' LIMIT '.$start.', '.$per) or die("Error");
		   */
		?>
		
		
		
		

<div class="content">	  
	<div class="table-wrapper">
	<table class="table" style="width: 100%;">
	<thead>
		  <tr>
		  
		  <th class="TableTdTitle"  style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><div class="bTitle">省電36計- 便民服務 - 經濟部能源局</div> <div class="bDate">2021/08/17 ~ 2021-11-15</div></th>
		  </tr>
	</thead>
	</table>		
     <tbody> 
	  
	  <!--<table class="bulletinTable">-->
	  
  
	 <tr><td class="TableTdContext">
	     <div class="bContext">
	         下班前三十分鐘可先關掉壓縮機(由冷氣改為送風)，以減少空調耗電。 在東西向開窗處，應裝設百葉窗或窗簾，以減少太陽輻射熱進入室內，降低空調負荷及用電量。 空調區域應與外氣隔離且緊閉門窗，以免冷氣外洩或熱氣侵入增加空調負荷。 連續假日或少數人加班儘量不使用中央空調，以避免主機低負載、低效率、高成本運轉。
	     </div>
		 </td></tr>
		 
	 <tr>
	 <hr/>
	 <td class="TableTdFile">
	   <!--<table class="xTable">-->
	   <table>
	    <th>附加檔案：</th>
		<td><a href="../../../upload_file/省電36計_便民服務_經濟部能源局_SN_2021_11_02T154600_123456.pdf">省電36計_便民服務_經濟部能源局_SN_2021_11_02T154600_123456.pdf</a></td>
	    
	   </table>
	 </td></tr>
	 
	 <tr>
	 <hr/>
	 <td class="TableTdURL">
	   <!--<table class="xTable">-->
	   <table>
	    <th>外部相關網頁連結：</th>
		<td><a href="https://www.moeaboe.gov.tw/ECW/populace/content/Content.aspx?menu_id=86">省電36計- 便民服務 - 經濟部能源局</a></td>
	    
	   </table>
	 </td></tr>

</table>  
	  
	  
	  
	  
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
		<?php
    //分頁頁碼
	/*
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
	*/
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
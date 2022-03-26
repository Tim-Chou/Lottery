<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>抽獎活動-活動辦法</title>
	  <?php 
	    header("Content-Type: text/html; charset=utf-8");
		include_once("../../Include/incBootstrap.php");
	    include_once("../../Include/connectDB.php");
		include_once("../../Include/GetSQLValueString.php");
		include_once("../../Include/joinLotteryCss.php");
		include_once("../../Include/TempStyleCss.php");
	  ?>
	  <?php
	    $tID =   1;
		$tStart = null;
		$tEnd = null;
	    $result = $db_link->prepare("SELECT * FROM active_date WHERE tID=?");
	    if ($result->execute(array( GetSQLValueString($tID, "int")))){
			while($row = $result->fetch()){
				$tStart = $row["tStart"];
		        $tEnd = $row["tEnd"];
			}
		}
	  ?>
	  
   </head>
   <body>
 <form action="index.php" method="post" enctype="multipart/form-data"> 
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

	
<div class="content">	  
	<div class="table-wrapper">
	<table class="table">
	<thead>
		  <tr>
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>活動辦法</h2></th>
		  </tr>
	</thead>
	</table>
	<!--
	<table class="table">
	<thead>
		  <tr>
		  <th style="background-color: rgba(0, 100, 0, 0.9); border-bottom: 1px solid #ddd;"><h2>節約用電抽獎活動—活動辦法</h2></th>
		  </tr>
	</thead>
	</table>
	-->
		<table class="table">
          <thead>
		  
		  
            <tr>
		    <th>一、活動期間</th>
            <th>二、參加對象</th>
            <th>三、參加方法</th>
			<th>四、獎勵方式</th>
			<th>五、節電量計算方式</th>
            </tr>
          </thead>
		  <tbody>
      <tr>
        <td data-title="一、活動期間">
          <ul>
            <li>
			<?php echo "".mb_substr($tStart,0,4,'utf-8').'年'.mb_substr($tStart,5,2,'utf-8').'月'.mb_substr($tStart,8,2,'utf-8').'日至'.mb_substr($tEnd,0,4,'utf-8').'年'.mb_substr($tEnd,5,2,'utf-8').'月'.mb_substr($tEnd,8,2,'utf-8')."日。";   ?>
			</li>
          </ul>
        </td>
		
		<td data-title="二、參加對象">
          <ul>
            <li>(一)&nbsp;住宅(含住宅公共設施)之用電戶。
			</li>
			
            <li>(二)&nbsp;高級中/職學校(含)以下之用電戶。
			</li>
          </ul>
        </td>
		
		<td data-title="三、參加方法">
          <ul>
            <li>(一)&nbsp;上網報名<br><h5>至活動網址登錄參加電號、地址、上傳電費帳單照片。</h5>
			</li>
			
            <li>(二)&nbsp;<?php echo "".mb_substr($tEnd,0,4,'utf-8').'年'.mb_substr($tEnd,5,2,'utf-8').'月'.mb_substr($tEnd,8,2,'utf-8')."日(含)前報名登錄成功者，會在活動截止日後一周內進行抽獎活動，並且公布其得獎者名單。";   ?>
			<br>
			 
			</li>
          </ul>
        </td>
		<td data-title="四、獎勵方式">
          <ul>
            <li> 
               (一)&nbsp;參加活動登錄之電號當期用電需節省一度(含)以上，亦可參加本節電抽獎活動。每一位得獎者皆可獲得新台幣壹仟元整之節電獎勵金。			
			</li>
			<li> 
               (二)&nbsp;若出現下列情形，則當期電費無法獲得參加節電獎勵金的抽獎資格：
                <ol>
				    <li>
					    1.當期或去年同期非屬住宅(含住宅公共設施)、高級中/職學校(含)以下之用電戶者。
                    </li>
					<li>
					    2.當期或去年同期用電度數不及底度者。
                    </li>
					<li>
					    3.當期或去年同期曾辦理暫停全部用電、終止契約、以及廢止用電者。
                    </li>
					<li>
					    4.當期或去年同期用電電種不同者。
                    </li>
					<li>
					    5.過去一年內曾辦理分戶者(含分出戶及被分出戶)。
                    </li>
                </ol>				
			</li>
          </ul>
        </td>
		
		<td data-title="五、節電量計算方式">
          <ul>
            <li>(一)&nbsp;每期節電量：<br>
			每期節電量 ＝ (去年同期電費平均每日用電度數 － 本期電費平均用電度數) × 本期計算期間實際用電日數，負值不計，計算至整數位(小數點後無條件進位)。
			</li>
			<li>(二)&nbsp;去年同期電費平均每日用電度數：<br>
			去年同期電費平均每日用電度數 ＝ 去年同期電費平均每日用電度數 ÷ 去年同期計算期間實際用電日數。
			</li>
			<li>(三)&nbsp;本期電費平均每日用電度數：<br>
			本期電費平均每日用電度數 ＝ 本期電費平均每日用電度數 ÷ 本期計算期間實際用電日數。
			</li>
          </ul>
        </td>
		
		</tr>
    </tbody>

  </table>
     <!-- 
		<h2>抽獎活動-活動辦法</h2>
		<p><?php //echo '●抽獎活動的時間為'.mb_substr($tStart,0,4,'utf-8').'年'.mb_substr($tStart,5,2,'utf-8').'月'.mb_substr($tStart,8,2,'utf-8').'日'.mb_substr($tStart,11,2,'utf-8').'點'.mb_substr($tStart,14,2,'utf-8').'分迄至'.mb_substr($tEnd,0,4,'utf-8').'年'.mb_substr($tEnd,5,2,'utf-8').'月'.mb_substr($tEnd,8,2,'utf-8').'日'.mb_substr($tEnd,11,2,'utf-8').'點'.mb_substr($tEnd,14,2,'utf-8').'分為止。<br>';   ?>
		<?php //echo '●只要是符合本活動資格者即可在本網站上傳您的姓名、手機號碼及Email即可參加抽獎活動，本活動於報名截止後立即在本網站上公布得獎者名單。<br>●請大家踴躍報名!!';?></p>
		   <div class="container">
		   <table class="table">
                 <th><a href="../Home/index.php"><button type="button" class="btn btn-primary">回首頁</button></a></th>
                 <th><a href="../Info/index.php"><button type="button" class="btn btn-info">活動辦法</button></a></th>
                 <th><a href="../JoinLottery/index.php"><button type="button" class="btn btn-success">我要參加抽獎活動</button></a></th>
				 <th><a href="../ShowAward/index.php"><button type="button" class="btn btn-outline-success">得獎名單</button></a></th>
		   </table>
		   </div>
		   <br>
	
	</div>-->
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
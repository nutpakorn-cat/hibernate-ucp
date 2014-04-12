<?php 
$this->load->helper("status_server/stat");
$ip = "localhost";
$status = new MinecraftServerStatus();
$response = $status->getStatus($ip); 

 ?>
<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">สถานะเซิฟเวอร์</h3>
                </div>
                <div class="panel-body">
                    <?php if($response == TRUE) { $status2 = "<strong class='text-success'>เปิด</strong>"; }else{ $status2 = "<strong class='text-danger'>ปิด</strong>";  } ?>
                    <p>IP เซิฟเวอร์ : <?=$ip?></p>
                    <p>สถานะเซิฟเวอร์ : <?=$status2?></p><?php
?>
<span class="style2"><p>จำนวนผู้เล่น : <?php echo $response['players']; ?> / <?php echo $response['maxplayers']; ?></p>
  <? } ?>
</p>
  <p>เปิดมาแล้ว :
  <strong><script type="text/javascript">
var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
function countup(yr,m,d){
var today=new Date()
var todayy=today.getYear()
if (todayy < 1000)
todayy+=1900
var todaym=today.getMonth()
var todayd=today.getDate()
var todaystring=montharray[todaym]+" "+todayd+", "+todayy
var paststring=montharray[m-1]+" "+d+", "+yr
var difference=(Math.round((Date.parse(todaystring)-Date.parse(paststring))/(24*60*60*1000))*1)
difference+=" "
document.write(" "+difference+" วัน")
}
//พิมพ์วันเรียงตามดังนี้  ( ปี ค.ศ./เดือน/วัน)
countup(2014,02,14)
  </script></p></strong>
  <p><b><script>
<!-- START HIDE
print1="";
print2="";
print3="";
today = new Date();
weekday = today.getDay();
if (weekday == 6) print1='SATURDAY';
if (weekday == 0) print1='SUNDAY';
if (weekday == 1) print1='MONDAY';
if (weekday == 2) print1='TUESDAY';
if (weekday == 3) print1='WEDNESDAY';
if (weekday == 4) print1='THURSDAY';
if (weekday == 5) print1='FRIDAY';
month = today.getMonth();
if (month == 0) print2='JANUARY';
if (month == 1) print2='FEBRUARY';
if (month == 2) print2='MARCH';
if (month == 3) print2='APRIL';
if (month == 4) print2='MAY';
if (month == 5) print2='JUNE';
if (month == 6) print2='JULY';
if (month == 7) print2='AUGUST';
if (month == 8) print2='SEPTEMBER';
if (month == 9) print2='OCTOBER';
if (month == 10) print2='NOVEMBER';
if (month == 11) print2='DECEMBER';
date = today.getDate();
year=today.getYear();
document.write (print1,' ',date, ' ', print2,' ',year+1900);
// STOP HIDE --></script></b>
</p>
    <input class="btn-block" type="submit" name="submitAdd" value="โหลดสถานะเซิฟเวอร์ใหม่" onclick="window.location.reload();">
                </div>
</div>
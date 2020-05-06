<?php

  define("HOST","localhost");
  define("DBNAME","dbname");
  define("USERNAME","dbusername");
  define("PASSWORD","dbpassword");

  $months = [
            "jan" => [ "name" => "Xaneiro",   "days" => "31" ],
            "feb" => [ "name" => "Febreiro",  "days" => "29" ],
            "mar" => [ "name" => "Marzo",     "days" => "31" ],
            "apr" => [ "name" => "Abril",     "days" => "30" ],
            "may" => [ "name" => "Maio",      "days" => "31" ],
            "jun" => [ "name" => "Xuño",      "days" => "30" ],
            "jul" => [ "name" => "Xullo",     "days" => "31" ],
            "ago" => [ "name" => "Agosto",    "days" => "31" ],
            "sep" => [ "name" => "Setembro",  "days" => "30" ],
            "oct" => [ "name" => "Outubro",   "days" => "31" ],
            "nov" => [ "name" => "Novembro",  "days" => "30" ],
            "dec" => [ "name" => "Decembro",  "days" => "31" ],
            ];

  $text1  = "Estou reunindo efemérides relacionadas con _____________. Agradécense as colaboracións.";
  $text2  = "É ben sinxelo: se coñeces algunha efemérides ou acontecemiento relacionado co tema indicado arriba, engádea <strong>no mes correspondiente</strong>. #Gra.";
  $text3  = "<strong>Ah! SI, pódese repetir data :).</strong>";
  $text4  = "* As efemérides atenuadas e con asterisco están pendentes de confirmación.";
  $day    = "Día";
  $title  = "Título";
  $url    = "URL (opcional)";


  try {
    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8mb4",USERNAME,PASSWORD
      ,array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET SESSION group_concat_max_len=100000")
      );
    }

  catch(PDOException $exception) {
//  echo "<h3>Database error: ".$exception->getMessage().". Bye.</h3>"; die();
    echo "<h3>Database error. Bye.</h3>"; die();
    }

  if(isset($_POST["send"])) :

    // Cross Site Script  & Code Injection Sanitization
    function xss_cleaner($input_str) {
        $return_str = str_replace( array('<',';','|','&','>',"'",'"',')','('), array('&lt;','&#58;','&#124;','&#38;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
        $return_str = str_ireplace( '%3Cscript', '', $return_str );
        return $return_str;
    }

    $date = $_POST["month"].sprintf('%02d',xss_cleaner($_POST["day"]));
    $title = xss_cleaner($_POST["title"]);
    $url = xss_cleaner($_POST["url"]);

    $query = "INSERT INTO `events` (`date`,`event`,`url`) VALUES (:date,:title,:url);";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":date",$date);
    $stmt->bindParam(":title",$title);
    $stmt->bindParam(":url",$url);
    $stmt->execute();

//  header("location:https://boa.gal/efemerides/");
    header('Location: '.$_SERVER['REQUEST_URI']);
    die();

  endif;

  $query = "SELECT date,id_status,event,url FROM `events` WHERE TRIM(event) != ''";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $r = $stmt->rowCount();
  while($x=$stmt->fetch(PDO::FETCH_ASSOC)) : $z[]=$x; endwhile;

  foreach ($z as $k => $v) :

    switch (substr($z[$k]["date"],0,3)) :
      case "jan": $jan[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "feb": $feb[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "mar": $mar[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "apr": $apr[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "may": $may[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "jun": $jun[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "jul": $jul[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "ago": $ago[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "sep": $sep[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "oct": $oct[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "nov": $nov[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
      case "dec": $dec[] = "<strong>Día ".substr($z[$k]["date"],3,2).($z[$k]["id_status"]==0?"§":"").":</strong> ".($z[$k]["url"]!="" ? "<a href=\"".$z[$k]["url"]."\" target=\"_blank\">".$z[$k]["event"]."</a>" : $z[$k]["event"]); break;
    endswitch;

  endforeach;

  sort($jan); sort($feb); sort($mar); sort($apr); sort($may); sort($jun);
  sort($jul); sort($ago); sort($sep); sort($oct); sort($nov); sort($dec);

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Efemérides</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css" />
  <link rel="stylesheet" href="milligram.extra.min.css" />
  <style>
    .container{margin-top:2em;margin-bottom:5em;}
    .accordion,input.send{border:0.1rem solid #e7313a;background-color:#e7313a;width:100%;}
    .panel{margin:0;padding:0;opacity:0;display:none;}
    .panel.show{margin:0;opacity:1;display:inline;}
    input.day,input.title,input.url{margin-right:.3em;margin-bottom:0;float:left;}
    input.day{width:15%;}
    input.title{width:40%;}
    input.url{margin-right:0;width:40%;}
    input.send{font-family: sans-serif;padding-left:0;padding-right:0;width:3em;margin-bottom:0;}
    td{padding:0;margin:0;line-height:1.2em;}
    .pte{opacity:.5;}
    .row.row-responsive .column.column-xs-10{text-align:right;}
    @media (max-width:39.9rem){
      .row.row-responsive{flex-direction:row;justify-content:space-between;}
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="column">
      <h4><?=$text1;?></h4>
      <p><?=$text2;?></p>
      <p><?=$text3;?></p>
    </div>
  </div>
  <div class="row row-responsive">
    <div class="column column-xs-100 column-md-50">
    <?php $i=1; foreach($months as $k=>$v) : ?>
      <button class="accordion"><?=$v["name"];?></button>
      <div class="panel">
        <form method="post">
          <div class="row row-responsive">
            <div class="column column-xs-90">
              <input type="number" class="day" name="day" min="1" max="31" value="" placeholder="<?=$day;?>" required />
              <input type="hidden" name="month" value="<?=$k;?>" required />
              <input type="text" class="title" name="title" value="" placeholder="<?=$title;?>" required />
              <input type="text" class="url" name="url" value="" placeholder="<?=$url;?>" />
            </div>
            <div class="column column-xs-10">
              <input type="submit" name="send" class="send" value="↲" />
            </div>
          </div>
        </form>
        <table><?php foreach ($$k as $kk => $vv) : ?>
          <tr><td>
          <?php $pte = strpos($vv,"§"); if ($pte !== false) : $vv = "<span class=\"pte\">".str_replace("§","*",$vv)."</span>"; endif; ?>
          <?=$vv;?>
          </td></tr>
        <?php endforeach; ?></table>
      </div>
    <?php if($i==6) : ?>
    </div>
    <div class="column column-xs-100 column-md-50">
    <?php endif; ?>
    <?php $i++; endforeach; ?>
    </div>
  </div>

  <hr>

  <div class="row row-responsive">
    <div class="column column-sm-70"><?=$text4;?></div>
    <div class="column column-sm-30"><a href="https://github.com/quenerapu/minimal-event-manager" target="_blank">Fork me on Github</a></div>
  </div>

</div>


<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
      this.classList.toggle("active");
      var arr = document.getElementsByClassName("show");
      for (j = 0; j < arr.length; j++) {
          if(this.nextElementSibling != arr[j])
             arr[j].classList.toggle("show");
      }
      this.nextElementSibling.classList.toggle("show");
    }
  }
</script>

</body>
</html>

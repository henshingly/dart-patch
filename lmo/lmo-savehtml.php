<?php
  /*
  * lmo-savehtml1.php: HTML-Ausgabe von Tabelle, aktuellem Spieltag und folgenden Spieltag
  * In der Datei lmo-savefile.php muss über der Zeile
  *  $datei = fopen($file,"w");
  *
  * folgende Zeile hinzugefügt werden:
  *
  *  include(PATH_TO_LMO."/lmo-savehtml1.php");
  *
  *
  * Autor: Bernd Hoyer, basierend auf dem LMO3.02
  * ////Verbesserungen, Bugs etc. bitte nur in das Forum bei Hollwitz.net\\\\  obsolet, Forum nicht mehr vorhanden
  *
  *
  *
  * 10/02/2023 - Please post any improvements, bugs or suggestions in the forum at https://www.vest-sport.de/forum
  * 02.10.2023 - Verbesserungen, Bugs oder Vorschläge bitte nun in das Forum auf https://www.vest-sport.de/forum
  */


$trans_lang = array( 'Monday' => $text['date'][0], 'Tuesday' => $text['date'][1], 'Wednesday' => $text['date'][2], 'Thursday' => $text['date'][3], 'Friday' => $text['date'][4], 'Saturday' => $text['date'][5], 'Sunday' => $text['date'][6], 'Mon' => $text['date'][7], 'Tue' => $text['date'][8], 'Wed' => $text['date'][9], 'Thu' => $text['date'][10], 'Fri' => $text['date'][11], 'Sat' => $text['date'][12], 'Sun' => $text['date'][13], 'January' => $text['date'][14], 'February' => $text['date'][15], 'March' => $text['date'][16], 'April' => $text['date'][17], 'May' => $text['date'][18], 'June' => $text['date'][19], 'July' => $text['date'][20], 'August' => $text['date'][21], 'September' => $text['date'][22], 'October' => $text['date'][23], 'November' => $text['date'][24], 'December' => $text['date'][25], 'Jan' => $text['date'][26], 'Feb' => $text['date'][27], 'Mar' => $text['date'][28], 'Apr' => $text['date'][29], 'May' => $text['date'][30], 'Jun' => $text['date'][31], 'Jul' => $text['date'][32], 'Aug' => $text['date'][33], 'Sep' => $text['date'][34], 'Oct' => $text['date'][35], 'Nov' => $text['date'][36], 'Dec' => $text['date'][37] );

if (!isset($namepkt)) {$namepkt="";}
if (!isset($nametor)) {$nametor="";}

if ($st > 0) {
  $actual = $st;
} else {
  $actual = $stx;
}

if ($lmtype == 0) {
  for ($i1 = 0; $i1 < $anzsp; $i1++) {
    if ($goala[$actual - 1][$i1] == "-1") $goala[$actual - 1][$i1] = "_";
    if ($goalb[$actual - 1][$i1] == "-1") $goalb[$actual - 1][$i1] = "_";
    if ($satza[$actual - 1][$i1] == "-1") $satza[$actual - 1][$i1] = "_";  //Dart Patch
    if ($satzb[$actual - 1][$i1] == "-1") $satzb[$actual - 1][$i1] = "_";  //Dart Patch
    if ($satza[$actual - 1][$i1] == "-1") $satza[$actual - 1][$i1] = "_";  //Dart Patch
  }
  $endtab = $actual;
  include(PATH_TO_LMO . "/lmo-calctable.php");

  for ($i1 = 0; $i1 < $anzsp; $i1++) {
    if ($goala[$actual - 1][$i1] == "_") $goala[$actual - 1][$i1] = "-1";
    if ($goalb[$actual - 1][$i1] == "_") $goalb[$actual - 1][$i1] = "-1";
    if ($satza[$actual - 1][$i1] == "_") $satza[$actual - 1][$i1] = "-1";  //Dart Patch
    if ($satzb[$actual - 1][$i1] == "_") $satzb[$actual - 1][$i1] = "-1";  //Dart Patch
    if ($satza[$actual - 1][$i1] == "_") $satza[$actual - 1][$i1] = "-1";  //Dart Patch
  }
}
$actual = $st;
$datumanz = $actual - 1;
if ($lmtype == 0 && $st > 0) {
  isset($tab0) ? $table1 = $tab0 : $table1 = $tab1;
  if (isset($table1)) {
    $wmlfile = fopen(PATH_TO_LMO . '/' . $diroutput . basename($file) . "-st.html", "wb");
    ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title><?php echo $titel?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
  <style type="text/css">
    body {background:#fff; color:#000; font-family: Verdana,arial,helvetica 12; max-width:200mm;max-height:285mm;}
    caption, p, h1 {margin: 3pt auto; text-align:center;}
    table {border:1pt solid #000; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; margin: 2pt auto;}
    td {padding: 0;white-space:nowrap;}
    th {border-bottom: 1px solid #000;}
    h1 {font:16pt bolder;}
    caption {margin-top:12pt;font-weight:bolder;white-space:nowrap;}
    @media print {
      a {display:none;}
    }
  </style>
</head>
<body>
<!--  <script type="text/javascript">document.write('<small><a href="#" onClick="history.back();return false;"><?php echo $text[562]?><\/a><\/small>');</script> -->

<h1><?php echo $titel?></h1>
<?php
    $z = array_filter($teama[$st - 1], "filterZero");
    if (!empty($z)) {?>
<table style= 'background-color:#f5f5ff';>
  <caption><?php echo $actual . ". " . $text[2]?> <?php if ($datum1[$datumanz]!='') { echo ' - '.$datum1[$datumanz].' '.$text[4].' '.$datum2[$datumanz];}?></caption>
<?php
      $datsort = $mterm[$st-1];
      asort($datsort);
      reset($datsort);
      //while (list ($key, $val) = each ($datsort)) { //Deprecated: The each() function ...
      foreach($datsort as $key => $val) {
        $i1=$key;
        if (($teama[$st - 1][$i1] > 0) && ($teamb[$st - 1][$i1] > 0)) {
          $heimteam = $teams[$teama[$actual - 1][$i1]];
          $gastteam = $teams[$teamb[$actual - 1][$i1]];
          $heimtore = applyFactor($goala[$actual - 1][$i1], $goalfaktor);
          $gasttore = applyFactor($goalb[$actual - 1][$i1], $goalfaktor);
          $heimsaetze = applyFactor($satza[$actual - 1][$i1], $goalfaktor);  //Dart Patch
          $gastsaetze = applyFactor($satzb[$actual - 1][$i1], $goalfaktor);  //Dart Patch
          if ($gastsaetze < 0) $gastsaetze = "_";                            //Dart Patch
          if ($heimsaetze < 0) $heimsaetze = "_";                            //Dart Patch
          if ($gasttore < 0) $gasttore = "_";
          if ($heimtore < 0) $heimtore = "_";
          if (($anzteams - ($anzst / 2 + 1)) != 0) {
            $spielfreiaa[$i1] = $teama[$actual - 1][$i1];
            $spielfreibb[$i1] = $teamb[$actual - 1][$i1];
          }
          if ($mterm[$actual - 1][$i1] > 0) {
            $dum1 = strtr(date($datf, $mterm[$actual-1][$i1]), $trans_lang);
          } else {
            $dum1="";
          } // Anstosszeit einblenden
?>
  <tr>
    <td><?php echo $dum1?>&nbsp;&nbsp;&nbsp;</td>
    <td align="left"><?php echo $heimteam?></td><td><?php echo HTML_icon($heimteam, 'teams');?></td>
    <td>-</td>
    <td><?php echo HTML_icon($gastteam, 'teams');?></td><td><?php echo $gastteam?>&nbsp;&nbsp;&nbsp;</td>
    <td align="right"><?php echo $heimtore?></td>
    <td>:</td>
    <td align="right"><?php echo $gasttore?></td><?php
          if ($msieg[$actual - 1][$i1] == 3) {?>
    <td width="2">/</td>
    <td align="right"><?php echo $gasttore?></td>
    <td align="center" width="8">:</td>
    <td align="left"><?php echo $heimtore?></td><?php
          }?>
<!-- Dart Patch -->
    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $heimsaetze?></td>
    <td>:</td>
    <td align="right"><?php echo $gastsaetze?>)</td><?php
          if ($msieg[$actual - 1][$i1] == 3){ ?>
    <td width="2">/</td>
    <td align="right"><?php echo $gastsaetze?></td>
    <td align="center" width="8">:</td>
    <td align="left"><?php echo $heimsaetze?></td>
<?php
          }?>

  </tr>
<!-- Dart Patch -->
<?php
        }
      }?>
</table><?php

      if (($anzteams - ($anzst / 2 + 1)) != 0) {
        $spielfreicc = array_merge($spielfreiaa, $spielfreibb);
        $i = 1;
        for ($j = 1; $j < $anzteams + 1; $j++) {
          if (!in_array($j, $spielfreicc)) {
            if ($i == 1) {?>
      <p><small><?php echo $text[4004]?>: <?php
            }
            echo $teams[$j]?>&nbsp;&nbsp;<?php
            $i++;
          }
        }?>
      </small></p><?php
      }
    } //if empty?>
<!-- Dart Patch -->
<table style= 'background-color:#f5f5ff';>
  <caption><?php echo $text[16]?> - <?php echo $actual?>. <?php echo $text[2]?></caption>
  <tr>
    <th align="left">&nbsp;<?php echo $text[577]?>&nbsp;</th>
    <th>&nbsp;</th>
    <th align="left">&nbsp;<?php echo $text['dart'][3]?>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;<?php echo $text['dart'][2]?>&nbsp;</th>
    <th>&nbsp;</th>
    <th colspan="3">&nbsp;<?php echo $nametor?>&nbsp;</th>
    <th align="right" >&nbsp;<?php echo $text[39]?>&nbsp;</th>
    <th></th>
    <th colspan="3">&nbsp;<?php echo $text['dart'][7]?>&nbsp;</th>
    <th align="right" >&nbsp;<?php echo $text[39]?>&nbsp;</th>
    <th></th>
    <th><?php echo $namepkt?></th>
<!-- Dart Patch -->
  </tr><?php

    for ($i1 = 0; $i1 < $anzteams; $i1++) {
      $platz = $i1 + 1;
      if ($ligaType == "dart" ) {  // Dart Patch
        $i4 = (int)substr($table1[$i1], 50, 34);
      } else {
        $i4 = (int)substr($table1[$i1], 35, 7);
      }
      $teamname = $teams[$i4];
      $pluspunkte = applyFactor($punkte[$i4], $pointsfaktor);
      $minuspunkte = applyFactor($negativ[$i4], $pointsfaktor);
      $kegelnholz = applyFactor($dtore[$i4], $goalfaktor);
      $plustore = applyFactor($etore[$i4], $goalfaktor);
      $minustore = applyFactor($atore[$i4], $goalfaktor);
      $torverhaeltnis = applyFactor($dtore[$i4], $goalfaktor);
      $plussaetze=applyFactor($psaetze[$i4],$goalfaktor);       //Dart Patch
      $minussaetze=applyFactor($msaetze[$i4],$goalfaktor);      //Dart Patch
      $satzverhaeltnis=applyFactor($dsaetze[$i4],$goalfaktor);  //Dart Patch
      $spieleteam = $spiele[$i4];?>

  <tr>
<!-- Dart Patch -->
    <td align="center">&nbsp;<?php echo $platz?>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;<?php echo $teamname?>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;<?php echo $spieleteam?>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;<?php echo "$plustore"?></td>
    <td align="center"><?php echo ":"?></td>
    <td align="right"><?php echo "$minustore"?>&nbsp;</td>
    <td align="right">&nbsp;<?php echo $torverhaeltnis?>&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;<?php echo "$plussaetze"?></td>
    <td align="center"><?php echo ":"?></td>
    <td align="right"><?php echo "$minussaetze"?>&nbsp;</td>
    <td align="right">&nbsp;<?php echo $satzverhaeltnis?>&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;<b><?php echo $pluspunkte?>&nbsp;</b>
<?php
        if ($minus==2) { ?>:</td>
    <td align="center"><?php echo $minuspunkte?>&nbsp;</td><?php
        } else {?></td>
    <td align="left">&nbsp;</td><?php
        }?>
  </tr><?php
        }?>
<!-- Dart Patch -->
</table>
   <p><small><?php echo $text[576];?></small></p><?php
    if ($actual == $anzst) {?>
    <p><strong><?php echo $text[568]?></strong></p><?php
    } else {
      $z = array_filter($teama[$st-1], "filterZero");
      if (!empty($z)) { ?>

<table style= 'background-color:#f5f5ff';>
  <caption><?php echo $actual+1?>. <?php echo $text[2]?><?php if ($datum1[$actual]!='') { echo ' - '.$datum1[$actual].' '.$text[4].' '.$datum2[$actual];}?></caption><?php
        $datsort= $mterm[$actual];
        asort($datsort);
        reset($datsort);
        //while (list ($key, $val) = each ($datsort)) { //Deprecated: The each() function ...
        foreach($datsort as $key => $val) {
          $i1 = $key;
          if (($teama[$st][$i1] > 0) && ($teamb[$st][$i1] > 0)) {
            $heimteam = $teams[$teama[$actual][$i1]];
            $gastteam = $teams[$teamb[$actual][$i1]];
            $heimtore = applyFactor($goala[$actual][$i1], $goalfaktor);
            $gasttore = applyFactor($goalb[$actual][$i1], $goalfaktor);
            if ($gasttore < 0) $gasttore = "_";
            if ($heimtore < 0) $heimtore = "_";
            $heimsaetze = applyFactor($satza[$actual][$i1], $goalfaktor);  //Dart Patch
            $gastsaetze = applyFactor($satzb[$actual][$i1], $goalfaktor);  //Dart Patch
            if ($gastsaetze < 0) $gastsaetze = "_";                        //Dart Patch
            if ($heimsaetze < 0) $heimsaetze = "_";                        //Dart Patch
            if (($anzteams - ($anzst / 2 + 1)) != 0) {
              $spielfreiaa[$i1] = $teama[$actual][$i1];
              $spielfreibb[$i1] = $teamb[$actual][$i1];
            }
            if ($mterm[$actual][$i1] > 0) {
              $dum1 = strtr(date($datf, $mterm[$actual][$i1]), $trans_lang);
              //$dum1 = strtr(date($datf, $mterm[$actual - 1][$i1]), $trans_lang);
            } else {
              $dum1 = "&nbsp;";
            } // Anstosszeit einblenden
?>
  <tr>
    <td><?php echo $dum1?>&nbsp;&nbsp;&nbsp;</td>
    <td align="left"><?php echo $heimteam?></td><td><?php echo HTML_icon($heimteam, 'teams');?></td>
    <td>-</td>
    <td><?php echo HTML_icon($gastteam, 'teams');?></td><td><?php echo $gastteam?>&nbsp;&nbsp;&nbsp;</td>
    <td align="right"><?php echo $heimtore?></td>
    <td>:</td>
    <td align="left"><?php echo $gasttore?></td><?php
            if ($msieg[$actual][$i1]==3) {?>
    <td width="2">/</td>
    <td align="right"><?php echo $gasttore?></td>
    <td align="center" width="8">:</td>
    <td align="left"><?php echo $heimtore?></td><?php
            }?>
<!-- Dart Patch -->
    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $heimsaetze?></td>
    <td>:</td>
    <td align="left"><?php echo $gastsaetze?>)</td><?php
            if ($msieg[$actual][$i1]==3){ ?>
    <td width="2">/</td>
    <td align="right"><?php echo $gastsaetze?></td>
    <td align="center" width="8">:</td>
    <td align="left"><?php echo $heimsaetze?></td>
<?php
            }?>
  </tr>
<!-- Dart Patch -->
<?php
          }
        }?>
</table><?php
        if (($anzteams-($anzst / 2 + 1)) != 0) {
          $spielfreicc = array_merge($spielfreiaa, $spielfreibb);
          $i = 1;
          for ($j = 1; $j < $anzteams + 1; $j++) {
            if (!in_array($j, $spielfreicc)) {
              if ($i == 1) {?>
<p><small><?php echo $text[4004]?>: <?php
              }
              echo $teams[$j]?>&nbsp;&nbsp;<?php
              $i++;
            }
          }?>
</small></p><?php
        }
      }//if empty
    }?>
<center>
<!--  <script type="text/javascript">document.write('<small><a href="#" onClick="history.back();return false;"><?php echo $text[562]?><\/a><\/small>');</script> -->
<br>
<!-- Dart Patch -->

<?php
    $current_date = date("d.m.Y");
    $current_time = date("H:i:s");
    echo $text['dart'][8] . ": ",$current_date," - ",$current_time;
?>
</center>
<!-- Dart Patch -->
</body>
</html>
<?php
    fwrite($wmlfile, ob_get_contents());
    ob_end_clean();
    fclose($wmlfile);
  }
}
?>
<?php

/*値を変えていく変数たち*/
//0,100,200,,,,
$start = 0;
//01,02,03,,,,,,,
$pref_cd = "02";
//0011,,0012,0013 koku kou shiritsu
$type_id = "0011";

$url = "http://webservice.recruit.co.jp/shingaku/school/v2?&order=0&category=$type_id&start=$start&pref_cd=$pref_cd&count=100&key=cc29602db3328cad&format=json";
//cURLセッションを初期化
$ch = curl_init();
//cURLのオプション設定
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//URLの情報を取得
$response = curl_exec($ch);
//セッションの終了
curl_close($ch);
$result = json_decode($response, true);
?>
<?php
for ($i = 0; $i < 100; $i++) : ?>
	<font color="red"><?php echo sprintf('%02d', $pref_cd) . $type_id . sprintf('%03d', $i + $start) . " => " . '[' . "<br>" . "'name' => " . "'" . $result["results"]["school"][$i]["name"] . "'" . "," .  "<br>" . "'fuculty' => [" . "<br>";?></font>
	<?php
	$number = count($result["results"]["school"][$i]["org"]);
	for ($j = 0; $j < $number; $j++) : ?>
	<font color="blue"><?php echo $j . " => " .  "'" . $result["results"]["school"][$i]["org"][$j]["name"] . "'," . "<br>";?></font>
<?php
endfor;
?>
],<br>
<?php
	echo "'class' => [ <br>";
	$number3 = count($result["results"]["school"][$i]["org"]);
for ($x = 0; $x < $number3; $x++) :
	echo $x .  " => [ <br>";
		$number4 = count($result["results"]["school"][$i]["org"][$x]["org"]);
	for ($q = 0; $q < $number4; $q++) :
		//for ($k = 0; $k < $number4; $k++) :
			echo $q . " => " . "'" . $result["results"]["school"][$i]["org"][$x]["org"][$q]["name"] . "'" . "," . "<br>";
	endfor;
echo '],' . "<br>";
endfor;
?>

<?php
echo "]" . "<br>" . "]," . "<br>";
endfor;
?>

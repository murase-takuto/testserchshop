<?php
$pref_cd = "13";
//0011-0013 koku kou shiritsu
$type_id = "0013";
$url = "http://webservice.recruit.co.jp/shingaku/school/v2?&order=0&category=$type_id&start=0&pref_cd=$pref_cd&count=100&key=cc29602db3328cad&format=json";
//$url = 'http://webservice.recruit.co.jp/shingaku/school/v2?&order=0&category=0013&start=0&pref_cd=12&count=100&key=cc29602db3328cad&format=json';
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
//取得結果の表示
for ($i = 0; $i < 100; $i++) : ?>
	<font color="red"><?php echo sprintf('%02d', $pref_cd) . sprintf('%02d', $i) . " => " . $result["results"]["school"][$i]["name"] . " => [" .  "<br>";?></font>
	<?php
	$number = count($result["results"]["school"][$i]["org"]);
	for ($j = 0; $j < $number; $j++) : ?>
	<font color="blue"><?php echo $j . " => " .  "'" . $result["results"]["school"][$i]["org"][$j]["name"] . "'" . " [" . "<br>";?></font>
	<?php
		$number2 = count($result["results"]["school"][$i]["org"][$j]["org"]);
		for ($k = 0; $k < $number2; $k++) {
			echo $k . " => " . "'" . $result["results"]["school"][$i]["org"][$j]["org"][$k]["name"] . "'" . "," . "<br>";
		}
?>
	],<br>
<?php
endfor;
?>
],<br>
<?php
endfor;
?>

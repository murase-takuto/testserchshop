<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');

$channelAccessToken = '5KtwzrJWBd0Tr38drE8478qVu5yUVVG3MNKLnOWMiO3o4aul0FKTJJz2QMQ5Z5dxKQH2yF/1M27HlSnL6HIc+M5/IaGjvE1qvEp80UxxJL9+mXIqz8PBJCsAah5KgjlMTh5iOaPPl0nzVTU+ZVtsEgdB04t89/1O/w1cDnyilFU=';
$channelSecret = '7da9c143ffd7737bc3c39016ee217a81';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => $message['text']
                            ]
                        ]
                    ]);
                    break;
				//位置情報が送られてきた際にそれに応じた店舗情報を表示
//				case 'location':
//					//curlを使用してホットペッパーのAPIの情報を取得
//					$url = "http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=cc29602db3328cad&lat=34.67&lng=135.52&range=5&order=4";
//					//cURLセッションを初期化
//					$ch = curl_init();
//					//cURLのオプション設定
//					curl_setopt($ch, CURLOPT_URL, $url);
//					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//					//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//					//URLの情報を取得
//					$response = curl_exec($ch);
//					//セッションの終了
//					curl_close($ch);
//					//取得結果の表示
//					$result = json_decode($response, true);
//					for ($i = 0; $i < 10; $i++) {
//					//該当範囲にデータが存在した場合に名前を表示(試験的に大阪周辺の情報を入力済み
//					//foreach ($response as $name) {
//						$client->replyMessage([
//							'replyToken' => $event['replyToken'],
//							'messages' => [
//								[
//									'type' => 'text',
//									'text' => $result["results"]["shop"][$i]["name"]
//								]
//							]
//						]);
//					}
//					break;
				default:
                    error_log('Unsupported message type: ' . $message['type']);
                    break;
            }
            break;
        default:
            error_log('Unsupported event type: ' . $event['type']);
            break;
    }
};

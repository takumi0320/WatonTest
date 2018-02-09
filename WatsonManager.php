<?php

class WatsonManager{

    public function WatsonAccess($VoiceText){
        header('Content-Type:text/html; charset=UTF-8');
        //ここに検索する文字を入れる
        $str = $VoiceText;
        $url = "https://1306b514-db14-4a61-8806-9481c1ab0658:qCDAtY7z0HuZ@gateway.watsonplatform.net/natural-language-classifier/api/v1/classifiers/359f41x201-nlc-199615/classify?text=";
        //初期化
        $ch = curl_init();
        //オプションを設定
        curl_setopt($ch, CURLOPT_URL,$url.urlencode($str));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true );
        //実行してデータを得る
        $result = curl_exec( $ch );
        $redirect2 = mb_convert_encoding($result, mb_internal_encoding(), "auto" );


        //返ってきた結果からIDを取り出す。
        preg_match_all('/"(\d+)"/', $redirect2, $match);

        //TOP3を配列に入れる。
        $result = array();
        $result[0] = $match[1][1];
        $result[1] = $match[1][2];
        $result[2] = $match[1][3];

        return $result;



    }

}
?>

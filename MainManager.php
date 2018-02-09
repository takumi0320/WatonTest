<?php
require_once 'DBManager.php';
require_once 'WatsonManager.php';
require_once 'ResultManager.php';
require_once 'ImageManager.php';

session_start();
//指定されたデータタイプに応じたヘッダーを出力する


header('Content-type: application/json');

$flag = $_POST['Flag'];
if($flag == 0){


    $WM = new WatsonManager();
    //認識したデータを受け取る
    $VoiceText = $_POST['VoiceText'];

    //Watsonに解析
    $MenuID = $WM->WatsonAccess($VoiceText);

    $DBM = new DBManager();
    $RM = new ResultManager();
    for($i = 0 ; $i <= count($MenuID); $i++){
        if($i == 0){
            $result = $DBM->getMenuInfo($MenuID[$i]);
            $RM->insertResult($result,$i);
        }elseif($i == 1){
            $result = $DBM->getMenuInfo($MenuID[$i]);
            $RM->insertResult($result,$i);
        }elseif($i == 2){
            $result = $DBM->getMenuInfo($MenuID[$i]);
            $RM->insertResult($result,$i);
        }
    }
    echo json_encode($VoiceText);


}else if($flag == 1){
    $result = array();
        $result[0]  = $_SESSION['id1'];
        $result[1]  = $_SESSION['name1'];
        $result[2]  = $_SESSION['calory1'];
        $result[3]  = $_SESSION['money1'];

        $result[5]  = $_SESSION['id2'];
        $result[6]  = $_SESSION['name2'];
        $result[7]  = $_SESSION['calory2'];
        $result[8]  = $_SESSION['money2'];

        $result[10]  = $_SESSION['id3'];
        $result[11]  = $_SESSION['name3'];
        $result[12]  = $_SESSION['calory3'];
        $result[13]  = $_SESSION['money3'];

        $IM = new ImageManager();
        $id1 = $result[0];
        $id2 = $result[5];
        $id3 = $result[10];

        $imgList = $IM->getImage($id1,$id2,$id3);

        $result[4]  = $imgList[0];
        $result[9]  = $imgList[1];
        $result[14] = $imgList[2];

    echo json_encode($result);

}
?>

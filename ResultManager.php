<?php
session_start();
class ResultManager{

    public function insertResult($result,$i){

        if($i == 0){
            $retList = array();
            $_SESSION['id1'] = $result[0]->MenuID;;
            $_SESSION['name1'] =  $result[0]->MenuName;;
            $_SESSION['calory1']= $result[0]->MenuCalory;;
            $_SESSION['money1'] = $result[0]->MenuMoney;;

        }elseif($i == 1){
            $_SESSION['id2'] = $result[0]->MenuID;;
            $_SESSION['name2'] = $result[0]->MenuName;;
            $_SESSION['calory2'] = $result[0]->MenuCalory;;
            $_SESSION['money2'] = $result[0]->MenuMoney;;

        }else{
            $_SESSION['id3'] = $result[0]->MenuID;;
            $_SESSION['name3'] = $result[0]->MenuName;;
            $_SESSION['calory3'] = $result[0]->MenuCalory;;
            $_SESSION['money3'] = $result[0]->MenuMoney;;
        }
    }
}

 ?>

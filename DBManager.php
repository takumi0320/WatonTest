<?php
//テーブル用のクラスを読み込む
//DBManagerが使うクラスを読み込む
require_once 'DBInfo.php';
require_once 'MenuTblDT.php';

class DBManager{
    private $myPdo;
        //接続のメソッド
    public function dbConnect(){
        try{
            $DBI = new DBInfo();
            $this->myPdo = new PDO('mysql:host='.$DBI->dbhost .';dbname='.$DBI->dbname .';charset=utf8', $DBI->user, $DBI->password, array(PDO::ATTR_EMULATE_PREPARES => false));
        }catch(PDOException $e) {
            print('データベース接続失敗。'.$e->getMessage());
            throw $e;
        }
    }

        //切断のメソッド
    public function dbDisconnect(){
        unset($myPdo);
    }


    //検索のメソッド
      public function getMenuInfo($MenuID){
        try{
          //DBに接続
          $this->dbConnect();

          //SQLを生成
          $stmt = $this->myPdo->prepare("SELECT * FROM cuisines WHERE id = :MenuID");
          $stmt->bindParam(':MenuID',$MenuID,PDO::PARAM_STR);
          //SQLを実行
          $stmt->execute();
          //取得したデータを１件ずつループしながらクラスに入れていく
          $retList = array();
          while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
              $result = new MenuTblDT();
              $result->MenuID = $row['id'];
              $result->MenuName = $row['name'];
              $result->MenuCalory= $row['calory'];
              $result->MenuMoney= $row['money'];
              array_push($retList, $result);
          }
          $this->dbDisconnect();
          //結果が格納された配列を返す
          return $retList;
        }catch (PDOException $e) {
          print('検索に失敗。'.$e->getMessage());
        }
    }

}
?>

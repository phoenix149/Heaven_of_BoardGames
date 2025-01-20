
    <?php
    if (isset($_POST['gameName']) && !empty($_POST['gameName'])) {
        $gameName = str_replace($_POST['gameName'], " ","_");
        // $requete = new PDO()
       }

    if(isset($_POST['gamePrice']) && !empty($_POST['gamePrice'])) {
        $gamePrice = trim($_POST['gamePrice']);
    } 

    if(isset($_POST['ean']) && !empty($_POST['ean'])) {
        $ean = trim($_POST['ean']);
    }

    if(isset($_POST['gameTime']) && !empty($_POST['gameTime'])){
        $gameTime= trim($_POST['gameTime']);
    }

    if(isset($_POST['middleAge']) && !empty($_POST['middleAge'])){
        $gameTime= trim($_POST['middleAge']);
    }

    if(isset($_POST['middleAge']) && !empty($_POST['middleAge'])){
        $gameTime= trim($_POST['middleAge']);
    }



$createDate = $_POST['createDate'];
?>









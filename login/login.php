<?php

    if(isset($_POST['username']) && isset($_POST['password'])){
        #example:'mysql:dbname=datebasename;host=hostname'
        $dbn = '';
        #example:'username'
        $user = '';
        #example:'sqlpassword'
        $password = '';

        $sql = "SELECT id, auth, username, password FROM admin_db";

        try{
		    $db = new PDO($dbn, $user, $password);
	    }
	    catch(PDOException $e){
		    echo "接続失敗";
        }

        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE);
        $result_count = count($result);

        for($i = 1; $i <= $result_count; ++$i){
            if($result[$i]['username'] == $_POST['username'] && password_verify($_POST['password'], $result[$i]['password'])){
                if($result[$i]['auth'] == "admin"){
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['auth'] = $result[$i]['auth'];
                    header('Location: http://'.$_SERVER['HTTP_HOST'].'/admin/admin.php');
                }
                else{
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['auth'] = $result[$i]['auth'];
                    header('Location: http://'.$_SERVER['HTTP_HOST'].'/edit.php');
                }
                exit;
            }
        }

        $error_message = "ろぐいんしっぱい";

    }
?>

<html>
    <head>
		<title>ログインページ</title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/button.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<meta charset="utf-8"/>
	</head>

    <div id ="intro" class="header">
		<div class="overlay">
			<div class="headercontent">
				<label class="logo">World of ITNews Scraping</label>
			</div>
		</div>
    </div>
    <div id="loginpage" class="main">
		<p class="Paragrahsize">ろぐいんぺーじ</p>
		<div class="block-ja">
            <div class="logo">
                <?php
                    if(!empty($error_message)){
                        echo $error_message;
                        echo "<br><br>";
                    }
                ?>
            </div>
            <form method="post" action="./login.php">
                <div class="logo">
                    UserName:
                    <input type="text" name="username" size="20"/> 
                    <br>
                    <br>
                    PassWord:
                    <input type="password" name="password" size="20"/>
                    <br>
                    <br>
                    <input type="submit" value="ログイン">
                </div>
            </form>
		</div> 
	</div>
</html>
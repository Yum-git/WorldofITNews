<html>
    <body>
    <?php
	$dbn = 'mysql:dbname=systemengine_pre;host=localhost';
	$user = 'root';
        $password = '';

        $sql = "SELECT sort_id, title, url, posttime FROM news_db";
        $sql_base = $sql;

        $page = "./front.php";

        $searchIn = false;
        $categoryIn = false;
        $siteIn = false;

        $backpage = -1;
        $nextpage = -1;

        #データベースに接続
		try{
			$db = new PDO($dbn, $user, $password);
		}
		catch(PDOException $e){
            echo $e->getMessage();
			echo "接続失敗";
        }
        
        #getから"article"の値を取得
        #listの要素数を取得
        $articlebool = false;
        if(isset($_GET['article'])){
            $articlelist = explode("_", $_GET['article']);
            $articlelist_count = count($articlelist);
        }
        else{
            $articlelist = [];
            $articlelist_count = 0;
        }

        #getから"pagereturn"の値を取得
        if(!isset($_GET['pagereturn'])){
            $pagepos = 1;
        }
        else{
            $pagepos = $_GET['pagereturn'];
        }

        #getから"searchtext"の値を取得してsqlの検索条件に追加
		if(isset($_GET['searchtext'])){
            $search = $_GET['searchtext'];
            
            $sql = $sql." WHERE title LIKE '%$search%'";
            $searchIn = true;
            $page = $page."?searchtext=".$search;
        }
        
        #getから"categorybox"の値を取得してsqlの検索条件に追加
        if(isset($_GET['categorybox'])){
            if($_GET['categorybox'] == 'Ra'){
                $category = "ライブラリ";
            }
            else{
                $category = "プログラミング言語";
            }

            if($searchIn){
                #$sql = $sql + " AND WHERE ";
                $page = $page."&categorybox=".$_GET['categorybox'];
            }
            else{
                #$sql = $sql + " AND WHERE ";
                $page = $page."?categorybox=".$_GET['categorybox'];
            }
            $categoryIn = true;
        }

        #getから"sitebox"の値を取得してsqlの検索条件に追加
        if(isset($_GET['sitebox'])){
            if($_GET['sitebox'] == 'IT'){
                $site = "ITmediaNews";
            }
            else{
                $site = "NikkeiXTech";
            }

            if($searchIn || $categoryIn){
                $sql = $sql." AND itnewssite LIKE '%$site%'";
                $page = $page."&sitebox=".$_GET['sitebox'];
            }
            else{
                $sql = $sql." WHERE itnewssite LIKE '%$site%'";
                $page = $page."?sitebox=".$_GET['sitebox'];
            }
        }

        #上記によって追加したsqlの検索条件を利用して記事データを取得，配列にする
		$stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE);
        $result_count = count($result);

        #検索条件がない場合のデータ取得
        $stmt_base = $db->query($sql_base);
        $resurt_base = $stmt_base->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE);
        $result_count_base = count($resurt_base);

        #前回ページを定義
        if($pagepos - 1 > 0){
            $backpage = $pagepos - 1;
        }

        #次回ページを定義
        if($pagepos + 1 < $result_count / 50 + 1){
            $nextpage = $pagepos + 1;
        }

        if($articlelist_count >= $pagepos * 2){
            $i = $articlelist[($pagepos * 2 - 1) - 1];
        }
        else if($articlelist_count == 1){
            $articlebool = true;
            $i = 1;
            array_push($articlelist, $i);
        }
        else{
            $articlebool = true;
            $i = $articlelist[array_key_last($articlelist)] + 1;
            array_push($articlelist, $i);
        }

        #取得開始位置を定義
        #if($pagepos == 1){
            #$i = 1;
        #}
        #else{
            #$i = 50 * ($pagepos - 1) + 1;
        #}

        $i_stop = $i + 49;

		for(; $i <= $i_stop; ++$i){
            if($i >= $result_count_base){
                break;
            }

			if(empty($result[$i]["title"])){
				++$i_stop;
				continue;
            }
			echo '<a href='.$result[$i]["url"].'>'.$result[$i]["title"].'</a>';
	?>
			<div style="text-align: right;">
			<?php
				echo date('Y年m月d日', strtotime($result[$i]["posttime"]));
			?>
			</div>
			<?php
				echo "<br />";
        }


        if($articlebool){
            array_push($articlelist, $i - 1);
        }

        $articlelist_str = implode("_", $articlelist);
        ?>
        <nav class="nav-main">
            <ul class="nav-tables">
                <li>
                <?php
                    if($backpage != -1){
                        if($searchIn || $categoryIn || $siteIn){
                            $backpagelink = $page."&pagereturn=".$backpage."&article=".$articlelist_str;
                        }
                        else{
                            $backpagelink = $page."?pagereturn=".$backpage."&article=".$articlelist_str;
                        }
                        echo '<a href='.$backpagelink.' class="button-style">Back</a>';
                    }
                    else{
                        ?>
                        <div class="button-style">
                            <?php
                                echo "Back";
                            ?>
                        </div>
                        <?php
                    }
                ?>
                </li>
                <li>
                    <div class="button-style">
                        <?php
                            echo $pagepos;
                        ?>
                    </div>
                </li>
                <li>
                <?php
                    if($nextpage != -1){
                        if($searchIn || $categoryIn || $siteIn){
                            $nextpagelink = $page."&pagereturn=".$nextpage."&article=".$articlelist_str;
                        }
                        else{
                            $nextpagelink = $page."?pagereturn=".$nextpage."&article=".$articlelist_str;
                        }
                        echo '<a href='.$nextpagelink.' class="button-style">Next</a>';
                    }
                    else{
                        ?>
                        <div class="button-style">
                            <?php
                                echo "Next";
                            ?>
                        </div>
                        <?php
                    }
                    echo "<br />";
                ?>
                </li>
            </ul>
        </nav>
    </body>
</html>

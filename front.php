<!DOCTYPE html>
<html>
	<head>
		<title>World of ITNews Scraping</title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<meta charset="utf-8"/>
	</head>
	
	<body>
		<div id ="intro" class="header">
			<div class="overlay">
				<div class="headercontent">
					<label class="logo">World of ITNews Scraping</label>
				</div>
			</div>
		</div>
		<nav class="nav-main">
			<ul class="nav-tables">
				<li>
					<a href="#intro" class="button-style">Top</a>
				</li>
				<li>
					<a href="#Search" class="button-style">Search</a>
				</li>
				<li>
					<a href="#List" class="button-style">List</a>
				</li>
				<li>
					<a href="#access" class="button-style">Access</a>
				</li>
			</ul>
		</nav>
		<div id="profile" class="main">
			<p class="Paragrahsize">Search</p>
			<div class="block-ja">
				<form method="get">
					検索ワード：
					<input type="text" name="searchtext" size="20"/> 
				<br>
					カテゴリ検索：
					<input type="radio" name="categorybox" value="Ra">ライブラリ
					<input type="radio" name="categorybox" value="Pro">プログラミング言語
				<br>
					サイト検索：
					<input type="radio" name="sitebox" value="IT">ITMediaNews
					<input type="radio" name="sitebox" value="Nikkei">日経XTech
				<br>
					<input type="submit" value="検索">
				</form>
			</div> 
		</div>
		<div id="List" class="main">
			<p class="Paragrahsize">List</p>
			<div class="BoxIn">
				<div class="BoxOne">
					<div class="skillbox" style="text-align: left;">
						<?php
							include('./output/List.php'); 
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="access" class="main">
			<p class="Paragrahsize">Access</p>
			<p>
				連絡先は下記の通りです．
			</p>
			<div class="BoxIn">
				<div class="BoxFourDiv">
					<div class="skillbox">
						<h2>
							Gmail
						</h2>
						<i class="fas fa-envelope fa-9x"></i>
						<p>
							yzk.yuma@gmail.com
						</p>
					</div>
					<div class="skillbox">
						<h2>
							GitHub
						</h2>
						<a href="https://github.com/Yum-git">
							<i class="fab fa-github-square fa-9x"></i>
						</a>
						<p>
							Yum-git
						</p>
					</div>
					<div class="skillbox">
						<h2>
							Twitter
						</h2>
						<a href="https://twitter.com/yuma_1999_">
							<i class="fab fa-twitter fa-9x"></i>
						</a>
						<p>
							@yuma_1999_
						</p>
					</div>
					<div class="skillbox">
						<h2>
							blog
						</h2>
						<a href="https://yzk-yzk-yzk.hatenablog.com/">
							<i class="fas fa-blog fa-9x"></i>
						</a>
						<p>
							yzk_yzk_yzk’s blog
						</p>
					</div>
				</div>
			</div>
		</div> 

		<div class="main_footer">
			<label>©️2020 yuma ohta</label>
		</div>
	</body>
</html>
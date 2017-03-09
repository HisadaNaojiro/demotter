<h2 class="page-header">データの保存</h2>

	<p>
		　データを保存するためには、データベースを使います。<br />
		データベースとは簡単に言えばエクセルより大量のデータを効率良く管理できるシステムです。<br />
		現在は、行と列のイメージでデータを保存するリレーショナル型データベースが主流です。
	</p>

	<p>
		　データベースはSQLという言語で操作します。<br />
		データベースも種類が様々ありますが、今回は無料で利用できるMySQLを利用します。<br />
	</p>

	<p>
		　保存や検索といったデータの操作を行うためには、まずはデータベースとテーブル(表)を用意しなければなりません。<br />
		そのため、mydbというデータベースとuserというテーブルを用意します。
	</p>

	<pre>
		//データベース作成
		CREATE SCHEMA `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

		//userテーブル作成
		CREATE TABLE IF NOT EXISTS `user` (
		  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
		  `name` VARCHAR(255) NOT NULL COMMENT '',
		  `email` VARCHAR(255) NOT NULL COMMENT '',
		  `password` VARCHAR(255) NOT NULL COMMENT '',
		  `created` DATETIME NOT NULL COMMENT '',
		  `modified` DATETIME NOT NULL COMMENT '',
		  `valid` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
		  PRIMARY KEY (`id`)  COMMENT '')
		ENGINE = InnoDB;
	</pre>
  <?php echo $this->Html->image('phpmyadmin1.png'); ?>

	<p>
		　MAMPのトップページにある「phpMyAdmin」のリンクをクリックしてphpmyadminの管理画面を開いてください。<br />
		次に「SQL」と書かれたタブをクリックしてください。<br />
		そこの入力欄に「データベース作成」と書かれているSQL文を流して実行を押してください。
	</p>

	<p>
		　SQL文を流しましたら、「mydb」というデータベースが作成されていますので、クリックしてください。<br />
		「SQL」と書かれたタブをクリックし、入力欄に文が記述されている場合は削除してください。<br />
	</p>

	<p>
		　そして、userテーブル」のSQL文を貼り付けて実行を押してください。<br />
		「mydb」というデータベースをクリックして「user」というテーブルが表示されていれば成功です。
	</p>

	<p>
		　データベースが作成されましたので、今から保存処理の実装を行なっていきます。<br />
	</p>

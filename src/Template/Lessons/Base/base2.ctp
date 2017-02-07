
	<h1>PHP基礎2</h1>

	<h2>リクエスト・分岐処理</h2>

	<h3>リクエスト</h3>

	<p>
		参考サイト <br />
		<a target="_blank" href="http://qiita.com/7968/items/4bf4d6f28284146c288f#%E7%AC%AC1%E7%AB%A0-http%E3%81%AB%E3%81%A4%E3%81%84%E3%81%A6">
			http://qiita.com/7968/items/4bf4d6f28284146c288f#%E7%AC%AC1%E7%AB%A0-http%E3%81%AB%E3%81%A4%E3%81%84%E3%81%A6
		</a><br />
		(一回は見ておくべき)
	</p>

	<p>
		　あるページを要求する際、サーバーへリクエストメッセージを送っている。<br />
		そのメッセージ文にはリクエストパラメータという値が含まれている。<br />
		PHPはこの値を使ってレスポンスを返す。<br />
	</p>

	<p>リクエストにはいくつかあるが今回はGETとPOSTというものを使っていく。</p>

	<div style="border: solid 1px #000; padding: 10px;">
		<h4>GET</h4>

		<p>
			あるページの詳細に飛ぶ際や検索結果を表示する場合に利用する。<br />
			下記のようにURLの「?・・・」というものが付与されているのが特徴。<br />
			http://coders.com/detail?id=1&amp;name=コーダーズハイ<br />
			<span style="color: red;" >※「?・・・」をリクエストパラメータと呼ぶ</span>
		</p>
		<p>
		　　　「coders.com/detail?・・」の「?」以降からがGETの値。<br />
			PHPが既に用意してくれている「$_GET」という変数を使用して、連想配列で値を取得できる。 <br />
			「?」以降の「id=1」が1つのGETの値で複数の値を繋げたい場合は「&amp;」でつなぐ
		</p>
		<pre>
			//http://coders.com/detail?id=1&amp;name=コーダーズハイというリンクにアクセスしたとすると。
			var_dump($_GET);
			/*
				[
					'id' => 1 ,
					'name' => 'コーダーズハイ'
				]
			という連想配列で取得できる。
			*/
		</pre><hr />

		<h4>POST</h4>
		<p>
			主にデータを登録・更新・削除をする際に使用。<br />
			フォームから送信されたデータを取得できる。<br />
			POSTもPHPが既に用意してくれている「$_POST」を使用する。<br />
		</p>

		<pre>
			//下記のようなフォームがありtestの箇所には'テスト'、dataの箇所には'データ'を入力し送信したとする
			&lt;form action="" method="POST"&gt;
				&lt;input type="text" name="test" /&gt;
				&lt;input type="text" name="data" /&gt;
			&lt;input type="submit" value="送信" /&gt;

			//POSTも入力フォームのname属性を基にして連想配列の形で取得する
			var_dump($_POST);
			/*
				[
					'test' => 'テスト',
					'data' => 'データ'
				];
			*/

			//配列や多次元配列(配列の中に配列がある)で取得したい場合、formのname属性を下記のように記述する
			&lt;form action="" method="POST"&gt;
				&lt;input type="text" name="sample[test]" /&gt;
				&lt;input type="text" name="sample[data][value]" /&gt;
			&lt;input type="submit" value="送信" /&gt;

			//同じくsample[test]のは'テスト'、sample[data][value]には'データ'を入力し送信したとする。
			var_dump($_POST)
			/*
				[
					'sample' =>[
						'test' => 'テスト',
						'data'  =>[
							'value' => 'データ'
						]
					]
				]
			*/
		</pre>
		<p>
			フォームについて詳しく知りたい方はこちら<br />
			<a target="_blank" href="http://ponk.jp/php/basic/form#page_index0">
				http://ponk.jp/php/basic/form#page_index0
			</a>
		</p>
	</div>

	<h3>分岐処理</h3>

	<p>ある一定の条件下だけ処理をする</p>

	<p>分岐処理でよく使用される演算子</p>

	<p>・比較演算子</p>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>例</th>
				<th>意味</th>
				<th>結果</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>$x == $y</td>
				<td>等しい</td>
				<td>$xと$yの値が等しいときにTRUEを返す</td>
			</tr>
			<tr>
				<td> $x === $y</td>
				<td>等しい</td>
				<td>
					$xと$yの値とデータ型が等しいときにTRUEを返す<br />
					「==」はPHPが自動でデータ型の変換をしてくれる。
				</td>
			</tr>
			<tr>
				<td>$x != $y</td>
				<td>等しくない</td>
				<td>$xと$yの値が等しくないときにTRUEを返す</td>
			</tr>
			<tr>
				<td>$x !== $y</td>
				<td>等しい</td>
				<td>
					$xと$yの値が等しくないか同じデータ型でないときにTRUEを返す<br/>
					「!=」はPHPが自動でデータ型の変換をしてくれる。
				</td>
			</tr>
			<tr>
				<td>$x < $y</td>
				<td>未満</td>
				<td>$xが$yより少ないときにTRUEを返す</td>
			</tr>
			<tr>
				<td>$x <= $y</td>
				<td>以下</td>
				<td>$xが$y以下のときにTRUEを返す</td>
			</tr>
			<tr>
				<td>$x > $y</td>
				<td>より大きい</td>
				<td>$xが$yより大きいときにTRUEを返す</td>
			</tr>
			<tr>
				<td>$x >= $y</td>
				<td>以上</td>
				<td>$xが$y以上のときにTRUEを返す</td>
			</tr>
		</tbody>

	</table>

	<p>・論理演算子</p>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>例</th>
				<th>意味</th>
				<th>結果</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>$x &amp;&amp; $y</td>
				<td>論理積</td>
				<td>$xと$yが共にTRUEのときにTRUEを返す</td>
			</tr>
			<tr>
				<td>$x || $y</td>
				<td>論理和</td>
				<td>$xまたは$yがTRUEの場合にTRUEを返す</td>
			</tr>
			<tr>
				<td>!$x</td>
				<td>否定</td>
				<td>!$xがFALSEでないときにTRUEを返す</td>
			</tr>
		</tbody>
	</table>

	<div style="border: solid 1px #000; padding: 10px;">

		<h4>if文</h4>
		<p>
			TRUEのときだけ処理を実行する<br />
		</p>

		<pre>
			$x = 7;
			if($x == 7){
				//TRUEのとき、つまり$xが7のとき処理が行われる
			}

			if($x == '7'){
				//「==」はPHPがデータ型を変換をしてくれるため、$xが7のとき処理が行われる
			}

			if($x != 7){
				//「!=」は等しくないときTRUEを返すため、
				   $xが7でないときに処理が行われる
			}

			if($x === 7){
				//「===」はデータ型も比較する。つまり、$xの値が7でかつデータ型が整数のときに処理が行われる
				   この場合、$xは整数型の7で比較する7も整数型の7のため処理が行われる
			}

			if($x === '7'){
				//「===」はデータ型も比較する。つまり、$xの値が7でかつデータ型が整数のときに処理が行われる
				  　この場合、$xは整数型の7だが、「'7'」は文字列の7のため処理が行われない
			}

			$y = 8;

			if($x == 7 &amp;&amp; $y > 10){
				//「&amp;&amp;」は論理積だから、$xが7でかつ、$yが10より大きいとき処理が行われる
			}

			if($x == 7 || $y == 9){
				//「||」は論理和だから、「$xが7」または「$yが9」のどちらかがTRUEのときに処理が行われる

			}

			if($x == 7){
				//$xが7のときに行われる

				if($y == 8){
					//$yが8のときに行われる
				}
			}

			$z = 'abc';

			if($z == 'abc'){
				$zが「abc」だった場合処理が行われる
			}

		</pre>

		<p>if{}else{}を使うとそうでないときの処理も記述できる</p>

		<pre>
			$x = 7;

			if($x = 7){
				//$xが7のときに処理が行われる
			}else{
				//$xが7でなかったときに処理が行われる
			}
		</pre>

		<p>ifの後にelseifを記述することで条件分岐が柔軟にできる</p>

		<pre>
			$x = 7;

			//elseだけだと条件が極端
			if($x = 7){
				//$xが7のときに処理が行われる
			}else{
				//$xが7でなかったときに処理が行われる
			}

			//elseifを使うと柔軟に対応できる
			if($x == 7){
				//$xが7のときに処理が行われる
				echo "7";                   //7を表示
			}elseif($x == 6){
				//$xが6のときに処理が行われる
				break;                      //brenkは処理の流れから抜ける
			}elseif($x == 5){
				//$xが5のときに処理が行われる
			}else{
				//どれにも該当しなかったときの処理
			}
		</pre><hr />

		<h4>switch文</h4>

		<p>
			if文より直感的な条件文が書ける<br />
			ただ、厳密に条件を記述したい場合はif文が良い
		</p>

		<pre>
			$x = 7;
			switch ($x){ //ここで評価する値を入れる

				case 1:  //このcaseが条件
					//1のときの処理
					break;  //breakとは処理の流れから抜けることを表す。
					          これを記述しないとswitch文はどんどん下のケースに処理がいってしまう
				case 2:
					//2のときの処理
					break;
				case 3:
				case 4:
					//3か4のときに処理が行われる
					break;
				default:
					//どれにも該当しないときに行われる
			}
		</pre><hr />

		<h4>三項演算子</h4>
		<p>シンプルに条件を記述できるが、複雑な条件には不向き</p>

		<pre>
			// 条件? TRUEの場合の処理 : FALSEの場合の処理;
			$x = 7;

			($x == 7)? //7のときの処理 : //7でないときの処理;

		</pre>
	</div>

	<h3>コロン(:)を使用した方法</h3>
	<p>「:」を使用するとHTMLタグで任意の範囲で記述可能</p>

	<pre>
		&lt;?php $x = 8; ?&gt;
			xのあたいは何
		&lt;?php if($x == 8): ?&gt;
			8です
		&lt;?php elseif($x == 7): ?&gt;
			7です
		&lt;?php else: ?&gt;
			7、8意外です
		&lt;?php endif; ?&gt;
	</pre>

	<p>switchの場合</p>

	<pre>
		&lt;?php $x = 8; ?&gt;
			xのあたいは何?
		&lt;?php switch($x): ?&gt;
		&lt;?php case 8: ?&gt;
			8です
			&lt;?php break; ?&gt;
		&lt;?php case7: ?&gt;
			7です
			&lt;?php break; ?&gt;
		&lt;?php default: ?&gt;
			7、8意外です
		&lt;?php endswitch; ?&gt;
	</pre>

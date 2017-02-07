<h1>PHP基礎1</h1>

	<h2>初期設定</h2>

	<p>
		　まずはMAMPのフォルダを探してください。<br />
		※MacだとMacintosh HD/アプリケーションの中にあります。コマンドライン上では/Applicationsにあると思います。<br />
		※windowsだとProgram Files（x86）かProgram Filesの中にあると思います。<br />
		もし見つからない場合は「検索」という箇所で「MAMP」と検索してみてください。
	</p>
	<p>
		　MAMP/bin/php/php7.0.0/conf/php.iniの<br />
		277行目付近の「display_errors」をOnに<br />
		282行目付近の「display_startup_errors」をOnに<br />
		修正したら保存してMAMPを再起動してください。<br />
	</p>
	<p>
		試しに新しいファイルか既存のファイルに下記コードを記述してください
	</p>

	<pre>
		&lt;php require_once("dsad"); ?&gt;<br />
		/*
			Warning: require_once(dsad): failed to open stream: No such file or directory in...
			と表示されたら成功
		*/
	</pre>

	<p>これで開発の際にPHPでのエラーが表示されるようになりました。</p>

	<h2>PHPの基本</h2>

	<h3>出力</h3>

	<pre>
		&lt;?php //開始タグ     phpの処理の開始
		  echo 'コーダーズハイ';     処理の後は必ず「;」をつける!
		?&gt; //閉じタグ     phpの処理の終了
		//phpでは「//~ 」でコメント文。\n
		コメント文とは処理には影響されないもので、主に処理の挙動などを説明する際に記述する。
		コメントは「/* ~ */」でも記述可能。これは複数行に渡るコメントを記述する際に便利
	</pre>

	<h3>PHPのデータ型</h3>

	<p>主なデータ型</p>
	<ol class="list-group">
		<li class="list-group-item">論理型・・・TRUE/FALSE</li>
		<li class="list-group-item">整数・・・1 , 2 , 3 , 4 , 50 , 1234 , 12312</li>
		<li class="list-group-item">浮動小数点数・・・1.1 , 1.2 , 2.4 , 0.23</li>
		<li class="list-group-item">文字列・・・コーダーズハイ</li>
		<li class="list-group-item">配列・・・[1,2,3,4,5]や['a','e','b']や['a',2,'b']</li>
		<li class="list-group-item">オブジェクト・・・class Car{ //処理 } $car = new Car;</li>
		<li class="list-group-item">NULL・・・NULL</li>
	</ol>

	<div style="border: solid 1px #000; padding: 10px;">
		<h4>論理型</h4>

		<p>
			　論理型(boolean)は真偽値を表します。<br />
			真偽値は言葉の通り真実(本当)か偽り(嘘)かです。条件文でよく使用される</br />
			真の場合は「TRUE」、偽の場合は「FALSE」
		</p><hr />

		<h4>整数</h4>

		<p>
			　整数(integer)整数を表すデータ型。<br />
			10進数だけでなく、16進数,8進数,2進数も表示可能
		</p><hr />


		<h4>浮動小数点数</h4>
		<p>
			　浮動小数点数(float)は小数を表すデータ型。<br />
			ただし、正確ではない。また、あまり使わない
		</p><hr />

		<h4>文字列型</h4>

		<p>
			　文字列(string)は文字を表すデータ型通常「""」「''」で指定。(ヒアドキュメントやnowdocあるが、ほぼ利用しないため説明なし)<br />
			<span style="color: red;" >※数値も「""」等で指定すると文字列として扱われる	</span>
		</p><hr />

		<h4>配列型</h4>

		<p>	　配列(array)とは「 [キー => 値] 」とういように関連ずけて、値を複数所持する事ができるデータ型。<br />
			通常は「 ['a','b','c']　」というように記述する。(配列の中身は文字列以外も大丈夫)
		</p>
		<p>
			　上記のように記述すると自動的に0から始まる数値をキーにして値を持つ事ができる。</br />
			['a','b','c']　は ['0' => 'a' , '1' => 'b' , '2' =>'c']
		</p>
		<p>
			　キーは自分で指定する事も可能でその場合は下記のように記述する。<br />
			['my' => 'me' , 'you' => 'your' , 'test' => 'tes']<br />
			上記のように「キー」と「値」を名前付けした配列を連想配列という<br />
			<span style="color: red;" >※配列自体を表示させることはできない。</span>
		</p><br />

		<p>
			　配列を表示させる場合は$配列[キー]というようにして記述すると表示される<br />
			また、配列の中に配列を入れることができ、これを多次元配列という。<br />
			多次元配列のある値を表示させたい場合は$配列[キー][キー]というようにする。
		</p>

		<pre>
			$array = [1,2,3,4,5] //実際は['0' => 1 , '1' =>2 , '3' => 2 ....... '4' => 5];
			echo $array    //エラー
			echo $array[0]; //1
			echo $array[2]; //3

			$array = [
					'0' => [1,2,3,4,5], //実際は['0' => 1 , '1' =>2 , '3' => 2 ....... '4' => 5];
					'1' => 6
			];
			echo $array[0]    //中が配列のためエラー
			echo $array[0][0] //1
			echo $array[0][1] //2
			echo $array[1]    //1
		</pre><hr />

		<h4>オブジェクト型</h4>

		<p>	　オブジェクトとは「物体」や「対象」、事象や概念など様々な意味を持つが、<br />
			プログラミングでのオブジェクトとは、データ（属性）と機能（手続き）をひとかたまりにした実体のこと。
		</p>
		<p>
			　集合体としての実体である「クラス」と個としての実体である「インスタンス」がある。<br />
			クラスはclass クラス名{ ~ 処理 ~ }と記述し、インスタンスする際は、変数 = new クラス名と記述する。<br />
			<span style="color: red;" >オブジェクトについては難しいためクラスの箇所で説明する。</span>
		</p>

		<pre>
			//クラス
			class Human
			{
				$name;

				function setName($name)
				{
					$this->name = $name;
				}
			}

			//インスタンス化
			$a = new Human;
			$b = new Human;
		</pre><hr />

		<h4>NULL型</h4>

		<p>
			　NULLとはその変数が値を持っていないことを表す。<br />
			<span style="color: red;" >※空白文字('')は空白という文字を代入しているため存在していないわけではない	</span>
		</p>
	</div>

	<h3>変数</h3>
	<p>
		　変数とはデータを一時的に記憶しておくための領域に固有の名前を付けたもの。<br />
		PHPでは「$」+ 名前　で変数を利用する。(PHPが既に定義してる変数もあるため被らないようにする)<br />
		<span style="color: red;" >変数名には半角英数字とアンダースコアのみ使用する。また、名前の先頭で数字は使用不可</span>
	</p>
	<p>
		　変数名を記述する際は誰もがわかりやすい変数名にすること。また、変数名に数字を利用することはほぼない<br />
		PHPでの変数宣言で2単語以上をつなげる場合、1単語目以降の単語の頭文字は大文字にする(キャメル記法)
	</p>

	<pre>
		$example;
		$_example;
		$testExample;
		$testSampleExample;
		$1example;      //エラー
		$サンプル;       //エラー

		//変数宣言
		$example = 'サンプル';
		//または
		$example = 'サンプル';

		どちらも「example」という変数を宣言し、「'サンプル'」という値を$exampleに代入している
	</pre>
	<p>下記のように記述して変数を表示させる</p>

	<pre>
		$example = 'サンプル';

		//単体で表示
		echo $example;               //サンプルと表示される

		文字列の中で表示
		echo "これは{example}です";       //これはサンプルですと表示される
		echo 'これは' . $example . 'です'  //これはサンプルですと表示される
		echo 'これは{$example}です'  //これは$exampleですと表示される
		※''と""の違いは「""」で囲んだ場合は、その中で「{$変数}」と記述した場合は表示されるが、「''」で囲んだ場合は表示されない

		//HTMLタグの中で表示
		<?php echo h('<p>これは<?php echo $example;?>です</p>'); ?> //これはサンプルですと表示される

		//配列のキーを指定するのに変数を利用することもできる
		$a = 0;
		$arary = ['a','b','c'];
		echo $array[$a];    //$aは0のため、'a'が表示される

		$a = 'sample';
		$array = ['sample' => 'yes' , 'test' => 'no'];
		echo $array[$a];         //配列の「sample」というキーの値を表示させる。つまり、'yes'が表示される

	</pre>
	<p style="color: red;">※1つの変数に格納できるのは1つのデータ型だけ</p>

	<pre>
		$a = 1;
		echo $a;    //1と表示

		$a = 'change';
		echo $a;    //changeと表示

		$a = [1,2,3];
		echo $a[0];   //文字列から配列になり、1が表示される
	</pre>

	<h3>定数</h3>

	<p>
		　変数とは違い1度しか値を設定できないもの<br />
		そのため、そのファイルあるいは関連ファイルで変更されない共通の値を設定するときに便利。<br />
		例えば、フレームワークと呼ばれるもので、全体で重要な値は定数として定義している。<br />
		<span style="color: red;" >定数名には半角英数字とアンダースコアのみ使用する。また、名前の先頭で数字は使用不可。</span>
	</p>

	<p>
		複数の単語をつなげる際は、「_」でつなげる。<br />
		定数名も誰もがわかる名前をつけてあげる。
	</p>

	<p>定数を表示させる際は「''」は不要で、文字列と繋げたい場合は「.」で文字列とつなぐ</p>

	<pre>
		//define('定数名',値)で宣言か const 定数名 = 値で宣言する
		define('SAMPLE','yes');
			//または
		const SAMPLE =  'yes'; //クラスで使用

		define('SAMPLE_TEST','yes');
			//または
		const SAMPLE_TEST =  'yes'; //クラスで使用

		SAMPLE = 'no';            //エラー

		echo SAMPLE;              //yesと表示

		echo "hi{SAMPLE}";        //エラー
		echo 'hi ' . SAMPLE;       // hi yesと表示

	</pre>

	<h3>PHPの演算子</h3>
	<p>
		主な演算子(
			詳しく知りたい人はこちら:
			<a target="_blank" href="http://php.net/manual/ja/language.operators.php">http://php.net/manual/ja/language.operators.php</a>
		)
	</p>

	<ol class="list-group">
		<li class="list-group-item">代数演算子</li>
		<li class="list-group-item">代入演算子</li>
		<li class="list-group-item">比較演算子</li>
		<li class="list-group-item">加算子/減算子</li>
		<li class="list-group-item">論理演算子</li>
		<li class="list-group-item">文字列演算子</li>
		<li class="list-group-item">複合演算子</li>
	</ol>

	<div style="border: solid 1px #000; padding: 10px;">
		<h4>代数演算子</h4>

		<p>普通の計算</p>

		<table class="table table-bordered table-striped">
			<thread>
				<tr>
					<th>演算子</th>
					<th>名前</th>
					<th>意味</th>
				</tr>
			</thread>
			<tbody>
				<tr>
					<td>+</td>
					<td>加算</td>
					<td>加法</td>
				</tr>
				<tr>
					<td>-</td>
					<td>減算</td>
					<td>減法</td>
				</tr>
				<tr>
					<td>*</td>
					<td>乗算</td>
					<td>乗法</td>
				</tr>
				<tr>
					<td>/</td>
					<td>除算</td>
					<td>除法</td>
				</tr>
				<tr>
					<td>%</td>
					<td>剰余</td>
					<td>割った余り</td>
				</tr>
			</tbody>
		</table><hr />

		<h4>代入演算子</h4>

		<p>
			変数等に値を代入するときに使用。
		</p>

		<pre>
			$example = 'サンプル';    「=」が代入演算子で変数exampleに「'サンプル'」が代入される
		</pre><hr />

		<h4>比較演算子</h4>

		<p>
			「~と~が等しい」や「~が~より大きい」という場合に使用。<br />
			ただしこれは、主にif文と使われるため、if文の箇所で説明。
		</p><hr />

		<h4>加算子/減算子</h4>

		<p>
			　加算子は「++」値を1上げ、減算子は「--」値を1下げる。<br />
			主にfor文で使用される。<br />
			前置加算子と前置減算子は先に値を加算or減算してから値を返す。<br />
			後置加算子と後置減算子は値を返してから値を加算or減算する。
		</p>
		<pre>
			//前置加算子と前置減算子
			$a = 5;
			echo '値は6' . ++$a;
			echo '値は6' . $a;

			echo '値は4' . --$a;
			echo '値は4' . $a;

			//後置加算子と後置減算子
			$a = 5;
			echo '値は5' . $a++;
			echo '値は6' . $a;

			echo '値は5' . $a--;
			echo '値は4' . $a;
		</pre><hr />

		<h4>論理演算子</h4>

		<p>
			　論理積や論理和、値の否定をする際に使用されるもの。<br/>
			主にif文で使用されるためこちらもif文の箇所で説明する
		</p><hr />

		<h4>文字列演算子</h4>

		<p>文字列の連結に使用</p>

		<pre>
			$hello = 'Hello ';
			echo $hello . 'World';  //Hello Worldと表示される
		</pre><hr />

		<h4>複合演算子</h4>

		<p>
			　代数演算子や文字列演算子や比較演算子と代入演算子を合わせたもの。<br />
			主に使われるのは代数演算子と代入演算子
		</p>

		<pre>
			$a = 4;
			$a += 4; //$a = $a + 4の省略形　結果は8

			$b = 10;
			$b -= 1; //$b = $b - 1の省略形 結果は9
		</pre>
	</div>


</div>

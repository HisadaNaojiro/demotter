<h1>PHP基礎3</h1>

	<h2>繰り返し処理</h2>

	<p>
		繰り返し処理とはその名のごとく、<br />
		繰り返し同じ処理をする際に使用される
	</p>

	<h3>While文</h3>

	<p>条件式がTRUEの間、繰り返し{}内の処理を行う</p>

	<pre>
		$x = 7;

		while($x <= 15){
			echo $x;    //7 8 9 10 11 12 13 14 15と表示される
			++x;
		}

		whileの文の中で必ずwhile文の条件が変化する処理を記述すること。
		でないと永遠に処理を続ける

		while($x <= 15){
			echo $x;    //$xの値が変化しないため永遠に7を出力
		}
	</pre>

	<h3>do-while文</h3>

	<p>
		　whileと同じように条件がTRUEの間、繰り返し{}の処理を行う。<br />
		while文との違いはwhile文は条件を評価してから行うため、処理自体が行われない可能性がある。<br />
		しかし、<br />
		do-while文は処理を1回行ってから継続条件を評価して繰り返すかやめるか判断するという違いがある。
	</p>

	<pre>
		$x = 7;

		//最低1回は行う
		do{
			echo $x; //7 8 9 10 11 12 13 14 15と表示される

			++$x;
		}while($x <= 15);
	</pre>

	<h3>for文</h3>

	<p>
		　初期処理と継続判断条件処理と更新処理を記述するため,繰り返しの中では一番複雑な処理。<br />
		ただ難しくはない。また、各処理は省略可能
	</p>

	<pre>
		/*
		  　初期処理;継続判断条件;更新処理と記述する
		  処理の流れとしては、まずは初期処理を行いfor文内の処理が一回実行される。
		  初期処理は1回しか行わない。

		  処理が実行された後は更新処理が行われる。
		  また処理が開始される際に継続判断条件評価する。
		  TRUEの場合は引き続きfor文内の処理を行うが、FALSEの場合は行われず終了する

		  つまり
		  1,$iに0を代入
		  2,$iを表示
		  3,$iをインクリメント(1加算する)
		  4, $iが9より小さいか判断
		  5,TRUEの場合は2の箇所から繰り返す。FALSEの場合は処理を終了する
		 */
		for($i = 0; $i < 9 ; $i++){
			echo $i;					//0 1 2 3 4 5 6 7 8と表示される
		}

		//「,」で区切ることによって複数指定可能。下記は初期処理に$iには0、$jには1を代入している
		for($i = 0 , j=1 ; $j < 5 ; $i++){
			echo $i;	//0 1 2 3 4と表示される
			echo $j;	//1 2 3 4と表示される
		}

		繰り返し処理にも条件分岐ができ柔軟に処理が記述できる

		for($i = 0; $i < 9 ; $i++){

			if($i == 2){
				continue;				//continueは処理をスキップして次の処理にする
			}

			echo $i;					//0 1 3 4 5 6 7 8と表示される
		}
	</pre>

	<h3>foreach文</h3>

	<p>
		配列を繰り返し表示させるときに使用<br />
		配列のキーと値のペアを順番に回。<br />
		foreach ($配列 as $値の変数){ ~ 繰り返し処理 ~ } と記述する。
	</p>

	<pre>
		$array = ['tokyo','aichi','osaka','fukuoka'];

		//valueの箇所は自分で決められる
		foreach($array as $value){
			echo $value;           //tokyo aichi osaka fukuokaと順番に表示される
		}
	</pre>

	<p>
		配列のキーも表示させたい場合は、
		foreach ($配列 as $キー名の変数 => $値の変数){ ~ 繰り返し処理 ~ } と記述する。<br />
		連想配列の際に便利
	</p>

	<pre>
		$array = ['tokyo','aichi','osaka','fukuoka'];
		//内部では['0' =>'tokyo','1' =>'aichi','2'=>'osaka','3'=>'fukuoka']

		//keyの箇所も自分で決められる
		foreach($array as $key => $value){
			echo $key;				// 0 1 2 3と順番に表示される
			echo $value;           //tokyo aichi osaka fukuokaと順番に表示される
		}

		$array = ['apple' => 'りんご' , 'grape' => 'ぶどう','banana' => 'ばなな'];

		foreach($array as $key => $value){
			echo $key;          //apple grape bananaと順番に表示される
			echo $value;        //りんご　ぶどう　ばななと順番に表示される
		}
	</pre>

	<p>多次元配列を扱う場合は工夫が必要</p>
	<pre>
		//キー名がprefectureとfruit
		//prefectureには県名の配列がfruitには果物の連想配列が代入されている
		$array = [
			'prefecture' =>['tokyo','aichi','osaka','fukuoka'],

			'fruit' =>[
				'apple' => 'りんご' , 'grape' => 'ぶどう','banana' => 'ばなな'
			]

		];

		//下記$valueは配列の値を持ってくるつまり、
		配列$arrayの値は、配列が入るため$valueは
			['tokyo','aichi','osaka','fukuoka']
			['apple' => 'りんご' , 'grape' => 'ぶどう','banana' => 'ばなな']
		が入る
		foreach($array as $value){
			echo $value;				//表示されない
		}

		//解決策
		prefectureとfruitはキー名なので、
		まずはforeach($array as $key => $value){}でキー名と値である配列を取得

		foreach($array as $key => $values){
			echo $key;
			//さらに配列を表示したいためforeachを書く
			foreach($values as $value){
				echo $value;
			}
		}

		/*
			通常 $sample = [ 'test' => 1 , 'example' => 2];
			foreachすると、
				1,「'test' => 1」
				2,「'example' => 2」
			という順番で取得して処理を行う.
			多次元配列というけれど簡単に書くと下記のようになる。

			$array = [ 'prefecture' => 値(配列)　'fruit'　=> 値(配列) ];
			値の部分が配列になっただけ

			だから外枠のforeachは
				1,「'prefecture' => 値1(配列)」
				2,「'fruit'　=> 値2(配列)」
			を取得するため合計2回繰り返される

			ただ値が配列だからもう一回foreachしている
			つまり、
			1,'prefecture' =>  値1(配列)
			   foreachで回っているから
			   1-1 'tokyo'
			   1-2 'aichi'
			   1-3 'osaka'
			   1-4　'fukuoka'
			2,'fruit'　=> 値2(配列)
			  	foreachで回っているから
			  	2-1'りんご'
			  	2-2 'ぶどう'
			  	2-3 'ばなな'
			 となる。

			 だから結果順番は
			 ・prefecture
				・tokyo
				・aichi
				・osaka
				・fukuoka
			 ・fruit
			 　　・りんご
			 　　・ぶどう
			 　　・ばなな
			という順番で表示される
		 */

	</pre>

	<h3>コロン(:)を使用した方法</h3>

	<p>
		do-while文には(:)はない。<br />
		while,for,foreachはある。
	</p>

	<pre>
		&lt;?php foeach($array as $value): ?&gt;
			htmlタグ等<br />
		&lt;?php endforeach; ?&gt;

		&lt;?php for($i = 0; $i < 10 ; $i++): ?&gt;
			htmlタグ等<br />
		&lt;?php endfor; ?&gt;

		&lt;?php $x = 5; ?&gt;
		&lt;?php while($x < 10): ?&gt;
			htmlタグ等<br />
		&lt;?php ++$x; ?&gt;
		&lt;?php endwhile; ?&gt;

	</pre>

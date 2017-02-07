<h1>PHP基礎4</h1>

	<h2>関数とクラス</h2>

	<h3>関数</h3>

	<p>
		　ある一連の処理をまとめたもの。<br />
		関数は「function(){}」と記述し、関数を呼び出す際は「関数名()」で呼び出せる。.<br />
		関数もPHPが既に用意しているものもある。
	</p>
	<pre>
		//月と日付と曜日の連想配列を作りたい!
		//通常　本当に面倒くさい
		//変数名が衝突した際に上書きされるため考慮すべきことが沢山ある
		&lt;?php'
			$month = ["1月" => "1月" , "2月" => "2月"...."12月" => "12月"];'
			$date = ["1日" => "1日","2日" => "2日",..."31日" => "31日"];'
			$day = ["月" => "月","火" => "火" , ..."日" => "日"];'
		?&gt;

		//for文やforeach文を挟んで作成すれば良いが、70行ぐらいあるコード上でやれらると読みづらい。
		&lt;?php'
			$month = []; '
			for($i = 1; $i <= 12; $i++){'
				$j = $i . "月";'
				$month[$j] = $j;'
			}'); ?>

			$date = []; '
			for($i = 1; $i <= 31; $i++){'
				$j = $i . "日";'
				$month[$j] = $j;'
			}'
			$day = ["月" => "月","火" => "火" , ..."日" => "日"];'
		?&gt;


		&lt;?php'
			//関数だと名前もわかりやすく処理は別の箇所になるので管理が楽
			//関数と呼び出す側のコードを別にまとめておくことで見やすくなる

			/* -----------------関数群 --------------- */
			function getMonth()
			{
				$option = [];
				for($i = 1; $i <= 12; $i++){
					$j = $i . "月";
					$option[$j] = $j;
				}

				return $option;  //returnというのは処理を呼び出している箇所に値を返してくれる
			}

			function getDate()
			{
				$option = [];
				for($i = 1; $i <= 31; $i++){
					$j = $i . "日";
					$option[$j] = $j;
				}

				return $option;  //returnというのは処理を呼び出している箇所に値を返してくれる
			}

			function getDay()
			{
				return ["月" => "月","火" => "火" , ..."日" => "日"];
			}
			/* ------------------関数群 ------------------------*/

			$month = getMonth();'); ?>//月の配列が代入される<br />
			$date = getDate();'); ?>//日付の配列が代入される<br />
			$day = getDay();'); ?>//曜日の配列が代入される<br />
		?&gt;
	</pre>

	<p>
		　関数に値を渡してさらに柔軟な関数を作成することもできる。<br />
		その際は、呼び出す際に「関数名(値,値)」とすると関数に値を渡せる。<br />
		関数側では「function($変数,$変数){}」と記述することで実現できる。<br />
		このとき、「function($変数,$変数){}」の「$変数」を引数と呼ぶ。<br />
		引数は左から順番に第一引数、第二引数...第n引数と言う。
	</p>

	<pre>

		　先ほどの関数は確かに良いがまだ扱いづらい。<br />
		というのも各関数に分けても結局自分で連想配列の形を作らなければいけない。<br />
		それを引数を使うと柔軟に対応できる。

		/* -----------------関数群 --------------- */
		//連想配列を作ってくれる関数
		//引数$arrayには配列が入ってくる
		function createArray($array)
		{
			$option = [];
			//foreachで$arrayの値を1つずつ取り出してその値をキーとする配列を作成
			foreach($array as $value){
				$option[$value] = $value;
			}

			//呼び出し元に返す
			return $option;
		}

		function getMonth()
		{
			$options = [];
			//月の配列を作る
			for($i = 1;$i < 31; $i++){
				$options[] = $i . "月";
			}
			/*
				1,createArrayに配列を渡す
				2,createArrayが連想配列を作成
				3,連想配列を返してくれる(取得)
				4,呼び出し側に返す
			*/
			return createArray($options);
		}

		function getDate()
		{
			$options = [];
			//日の配列を作る
			for($i = 1;$i < 31; $i++){
				$options[] = $i . "日";
			}
			//連想配列で帰ってきたものを呼び出し側に返す
			return createArray($options);
		}

		function getDay()
		{
			$options = ['月','火','水','木','金','土','日'];

			return createArray($options);
		}
		/* -----------------関数群 --------------- */



		$month = getMonth();
		$date = getDate();
		$day = getDay();

	</pre>

	<p>関数の注意点は</p>
	<ul>
		　
		<li>その関数に再利用性があるか(1回だけならそもそもいらない)</li>
		<li>
			場合にもよるが1つの関数に沢山処理を書いている際は、一回コードを確認する。<br />
			(もしかしたら、他の関数でも同じことを記述している場合がある。<br />
			その場合、その重複している処理を関数化することで運用する際にわかりやすいコードになる)
		</li>
	</ul>

	<h3>クラス</h3>

	<h4>オブジェクト</h4>

	<p>
		　クラスを使用する際はオブジェクト指向を知っておかなければならない。<br />
		プログラミングにおけるオブジェクトとはデータとそれに対する処理をひとまとめにしたもの。<br />
		クラスはそのデータと処理を定義するもの。
	</p>

	<pre>
	    /*------------会員-----------*/
		・データ
		   1,名前
		   2,メールアドレス
		   3,会員番号
		   4,年齢
		 ・操作
		    1,メールアドレスの変更
		    2,会員番号の取得
		    3,チケットの発行
	    /*-------------------------*/
	</pre>

	<p>
		データは$変数、操作は関数と言える。<br />
		クラス内での変数はプロパティ、操作をメソッドと呼ぶ。
	</p>

	<pre>
	    /*------------会員-----------*/
		・データ
		   1,$name
		   2,$email
		   3,number
		   4,age
		 ・操作
		    1,setEmail()
		    2,getNumber()
		    3,createTicket()
	    /*-------------------------*/
	</pre>

	<p>クラスはclass クラス名{}と記述する</p>

	<pre>
	    /*------------会員-----------*/
		・データ
		   1,$name
		   2,$email
		   3,$number
		   4,$age
		 ・操作
		    1,setEmail()
		    2,getNumber()
		    3,createTicket()
	    /*-------------------------*/
	    これをコード化すると

	    &lt;?php'
		    class Member{
		    	public $name;
		    	public $email;
		    	public $number;
		    	public $age;

		    	public function setEmail()
		    	{

		    	}

		    	public function getNumber()
		    	{

		    	}

		    	public function createTicket()
		    	{

		    	}
		    }

		    //Memberクラス(オブジェクト)には、こういうプロパティとメソッドがあると定義している
	    ?&gt;
	</pre>

	<p>
		　クラスを利用するにはインスタンス化を行う。<br />
		インスタンスとは個の実体のこと。<br />
		new クラス名();でインスタンス化をする。
	</p>

	<pre>
		&lt;?php'
		    class Member{
		    	public $name;
		    	public $email;
		    	public $number;
		    	public $age;

		    	public function setEmail()
		    	{

		    	}

		    	public function getNumber()
		    	{

		    	}

		    	public function createTicket()
		    	{

		    	}
		    }

		    $member = new Member();
	    ?&gt;

	    /*-----------------会員--------------*/   -> クラス(オブジェクト)
	    	Aさん(名前,メアド,会員番号,年齢)  -> インスタンス
	    	Bさん(名前,メアド,会員番号,年齢)  -> インスタンス
	    	Cさん(名前,メアド,会員番号,年齢)  -> インスタンス
	    /*---------------------------------*/

	    コードで表すと
	    &lt;?php'
		    class Member{
		    	public $name;
		    	public $email;
		    	public $number;
		    	public $age;

		    	public function setEmail($val)
		    	{
		    		/*
		    			$thisは自身を指す
		    			つまり、
		    			 $this->プロパティや$this->メソッドで
		    			 自身の定義されているプロパティやメソッドに設定や使用ができる
		    		*/
					$this->email = $val;
		    	}

		    	public function getEmail()
		    	{
		    		return $this->email;
		    	}

		    	public function getNumber()
		    	{

		    	}

		    	public function createTicket()
		    	{

		    	}
		    }

		    $Asan = new Member(); //インスタンス
		    $Bsan = new Member(); //インスタンス
		    $Csan = new Member(); //インスタンス

		    /*
		    	インスタンスは個の実体であるため、
		    	各人が(名前,メアド,会員番号,年齢)とそれを操作するものをもっている。

		    	だから、
		    	各人に対してプロパティ(クラスの変数)に値を設定できる
		    /*

		    //プロパティやメソッドを使用する際は「->」を使う

		    $Asan->setEmail('a@example.com'); //Emailを設定
		    $Bsan->setEmail('b@example.com'); //Emailを設定
		    echo $Asan->getEmail(); //emailを取得。a@example.comと表示される
		    echo $Bsan->getEmail(); //emailを取得。b@example.comと表示される
		    echo $Asan->email; //a@example.comと表示される
		    echo $Bsan->email; //b@example.comと表示される

	    ?&gt;
	</pre>

	<h4>継承</h4>

	<p>
		　あるクラスのプロパティやメソッドを受け継ぎつつ<br />
		さらにプロパティやメソッドを追加したクラスを定義すること。<br />
		継承する際は「extends」を使う。
	</p>

	<p>
		継承元をスーパークラス、継承して作られたクラスをサブクラスと呼ぶ
	</p>
	<pre>
	    /*-----------------会員--------------*/
	    	Aさん(名前,メアド,会員番号,年齢)
	    	Bさん(名前,メアド,会員番号,年齢)
	    	Cさん(名前,メアド,会員番号,年齢)
	    /*---------------------------------*/

	    //これを基にしてVIP会員を作りたい!
	    /*----------------VIP会員--------------*/
	    	Aさん(名前,メアド,会員番号,年齢,VIP番号)
	    	Bさん(名前,メアド,会員番号,年齢,VIP番号)
	    	Cさん(名前,メアド,会員番号,年齢,VIP番号)
	    /*---------------------------------*/

	    //これをコードで表すと

	    &lt;?php'
		    class Member{
		    	public $name;
		    	public $email;
		    	public $number;
		    	public $age;

		    	public function setEmail($val)
		    	{
					$this->email = $val;
		    	}

		    	public function getEmail()
		    	{

		    	}

		    	public function getNumber()
		    	{

		    	}

		    	public function createTicket()
		    	{

		    	}
		    }

		    class VipMember extends Member
		    {
		    	public $vipNumber;

		    	public function setVipNumber($val)
		    	{
		    		$this->vipNumber = $val;
		    	}

		    	public function getVipNumber()
		    	{
		    		return $this->vipNumber;
		    	}
		    }

		    $Dsan = new VipMember();
		    $Dsan->setVipNumber(1234); //VIP番号を設定
		    echo $Dsan->getVipNumber();    //1234と表示

		    //継承した場合継承元のクラスのメソッド等も使用可能

		     $Dsan->setEmail(a@example.com);
		     echo $Dsan->getEmail();         //a@example.comと表示
	    ?&gt;
	</pre>

	<p>
		継承元のメソッドを引き継ぎつつ新たに処理を追加したい場合は、
		parentを使う
	</p>
	<pre>
	    &lt;?php'
		    class Member{
		    	public $name;
		    	public $email;
		    	public $number;
		    	public $age;

		    	public function setEmail($val)
		    	{
		    		$this->Email = $val;
		    	}

		    	public function getEmail()
		    	{

		    	}

		    	public function getNumber()
		    	{

		    	}

		    	public function createTicket()
		    	{

		    	}
		    }

		    class VipMember extends Member
		    {
		    	public $vipNumber;

		    	//MemberクラスのsetEmailメソッドを引き継ぎつつ新たな処理を追加
		    	public function setEmail($val)
		    	{
		    		parent::setEmail($val);
		    		return $this->email;
		    	}

		    	public function setVipNumber($val)
		    	{
		    		$this->vipNumber = $val;
		    	}

		    	public function getVipNumber()
		    	{
		    		return $this->vipNumber;
		    	}
		    }

		    $Dsan = new VipMember();
		    $Dsan->setVipNumber(1234); //VIP番号を設定
		    echo $Dsan->getVipNumber();    //1234と表示

		    //継承した場合継承元のクラスのメソッド等も使用可能

		     $Dsan->setEmail('a@example.com'); //a@example.comと表示
	        ?&gt;
	</pre>

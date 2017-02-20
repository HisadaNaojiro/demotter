<style>
  img{
    height: 50%;
    width: 40%;
    margin-bottom: 15px;
  }
</style>
<h1>レッスン4</h1>

<h2 class="page-header">フレームワークの基礎知識</h2>

<p>
  前回講義まではPHPで開発するための土台を構築しました。<br />
  その過程で、クラスや関数を学びました。
</p>

<p>
  今回からフレームワークを使用していきます。<br />
  フレームワークとは効率的に開発をするためにある一定の機能を簡単に使えるようにしたものです。<br />
  フレームワークといえば、Rubyという言語で作られたフレームワークであるRuby On Railsが有名です。
</p>

<p>Webアプリケーションを作る際に行うことは大きく分けて3つあります。</p>


<ul class="list-group">
	<li class="list-group-item">
    1.リクエスト(例えば登録やログインなど)に応えるために、「データベースの、どのテーブルを使用するのか」「どの値をブラウザに表示してあげのか」などの処理を記述する
  </li>
	<li class="list-group-item">2.実際のデータベースから値を取得する</li>
	<li class="list-group-item">3.ブラウザに表示してあげるものを準備(HTML)</li>
</ul>

<p>
  フレームワークでは、<br />
  「1」のようなものをController(コントローラ)<br />
  「2」のようなものをModel(モデル)<br />
  「3」のとうなものをView(ビュー)と呼んでいます。<br />
  それぞれの頭文字をとって「MVC」という構造でフレームワークはできています。
</p>

<p>
  フレームワークは、このMVCという構造とフレームワークが提供してくれている機能を使ってアプリケーションを実装していきます。<br />
  cakephpのModelは、<br />
  ・テーブル全体を表すTable<br />
  ・テーブルの中の個々のデータに対して操作を行うEntity<br />
  に分かれています。
</p>

<p>では実際に作成していきましょう</p>

<h2 class="page-header">ログイン・ログアウト機能の作成</h2>

<p>
  ユーザのログイン・ログアウト機能の実装をしていきます。<br />
  ユーザのログイン・ログアウト機能を実現するに当たって行わなければならないことは以下の通りです。
</p>

<ul class="list-group">
	<li class="list-group-item">1.URLの設定</li>
	<li class="list-group-item">2.フォームの設置</li>
	<li class="list-group-item">3.ログイン処理</li>
  <li class="list-group-item">4.ログアウト処理</li>
</ul>

<h3 class="page-header">URLの設定</h3>

<p>
  どのWebアプリケーションもそうですが、URLがないとそもそも表示されません。<br />
  そのため、URLを設定してあげます。
</p>

<p>
  CakephpでのURLの指定は「configフォルダ」の中にある「routes.php」というものに記述していきます。<br />
  routes.phpを見つけましたらroutes.phpをファイルを開き、下記のコードを記述してください。
</p>

<pre>
  $routes->connect('/users/login',                   ['controller' => 'Users','action' => 'login']);

  //$routes->connect(url,['controller' => コントローラ名 , 'action' => アクション名]);
</pre>

<p>
  Cakephpでは「$routes->connect()」という箇所で、任意のURLを設定することができます。<br />
  urlの箇所に任意のURLを記述していきます。<br />
  記述したurlにアクセスした際に処理を行う箇所を['controller' => コントローラ名 , 'action' => アクション名]で指定します。
</p>

<p>
  ここでは、「トップURL/users/login」というURLにアクセスした際は、<br />
  「UsersController」の「login」という箇所で処理を行うと指定しています。
</p>

<h3 class="page-header">フォームの設置</h3>

<p>
  urlを記述しましたので、今度はアクセスした際の処理を記述していきます。<br />
  具体的な処理を記述する部分は、「src」フォルダの配下にあります。
</p>

<p>
  srcフォルダを開きましたら、さらに様々なフォルダがでてきます。<br />
  その中のControllerというフォルダを開きいてください。<br />
  Controllerフォルダ内には様々なファイルがあります。<br />
  その中の「UsersController.php」というファイルを開いてください。
</p>

<p>
  このUsersController.phpが、URLの設定で記述した「['controller' => 'Users','action' => 'login']」のコントローラの部分です。<br />
  UsersControllerには、以下のようなコードが記述されているかと思います。
</p>

<pre>
  class UsersController extends AppController{

    public function index()
    {

    }
    public function add()
    {
      /* 処理 */
    }

  }
</pre>

<p>
  この「public function 名前」の箇所が「['controller' => 'Users','action' => 'login']」のアクションに該当します。<br />
  つまり、<br />
  「/users/login」とアクセスが来た際は、「UsersController.php」の「public function login(){}」という箇所で処理を行います。<br />
  では実際にUsersController.phpに下記のコードを記述してください。
</p>

<pre>
  class UsersController extends AppController{

    /* --- この部分を追加 ---*/
    public function login()
    {

    }
    /* --------------------*/

    public function index()
    {

    }
    public function add()
    {
      /* 処理 */
    }

  }
</pre>

<p>
  これで「users/login」とアクセスが来た際の処理の箇所を確保しました。<br />
  ですが、これだけではブラウザに表示させることはできません。<br />
  なぜなら、ブラウザに表示するファイルがないからです。
</p>

<p>
  ブラウザに表示するためのファイルを作成します。<br />
  「src」フォルダ内に「Template」というフォルダがあります。<br />
  その中に実際のブラウザに表示されるものを配置していきます。<br />
</p>

<p>
  Templateフォルダを開きますと、様々なフォルダが配置されています。<br />
  Templateフォルダの中は各Controllerファイルの「Controller」という除いたフォルダと、<br />
  フレームワークが予め提供してくれているフォルダが配置されています。<br />
  新たにControllerファイルを作成した際は、自身でフォルダを作成しなければなりません。
</p>

<p>
  今回は予め「Users」というフォルダを作成しておきました。<br />
  Usersフォルダに「login.ctp」というファイルを作成してください。<br />
  「users/login」とURLを入力した際に空白のページが表示されましたら成功です。
</p>

<p>
  login.ctpに下記コードを記述してください。
</p>

<pre>
  &lt;div class="page-header"&gt;
  &lt;h1&gt;ログイン&lt;/h1&gt;
  &lt;/div&gt;
  &lt;?php echo $this->Flash->render('auth') ; ?&gt;
  &lt;?php echo $this->Form->create(false,['class' => 'form-horizontal']); ?&gt;
    &lt;div class="form-group"&gt;
      &lt;?php echo $this->Form->label('name','ニックネーム',['class' => 'col-sm-3 control-label']);?&gt;
      &lt;div class="col-sm-4"&gt;
        &lt;?php echo $this->Form->text('name',['class' => 'form-control','placeholder' => 'ニックネーム']); ?&gt;
      &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="form-group"&gt;
      &lt;?php echo $this->Form->label('password','パスワード',['class' => 'col-sm-3 control-label']); ?&gt;
      &lt;div class="col-sm-4"&gt;
        &lt;?php echo $this->Form->text('password',[
          'class' => 'form-control',
          'type' => 'password',
          'placeholder' => 'パスワード'
        ]);?&gt;
      &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="form-group"&gt;
      &lt;div class="col-sm-offset-2 col-sm-10"&gt;
        &lt;?php echo $this->Form->submit('登録',['class' => 'btn btn-success']); ?&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;?php echo $this->Form->end(); ?&gt;
</pre>

<p>
    各PHPのコードについてですが、
    <pre>
      &lt;?php echo $this->Flash->render('auth') ; ?&gt;
    </pre>
    でフラッシュを表示することができます。<br />
    フラッシュは一時的なメッセージを表示させたいときに使用します。<br />
    ()内にキー名(ここではauth)を指定すると、そのキー名を指定したメッセージが表示されます。
</p>

<p>
  <pre>
    &lt;?php echo $this->Form->create(false,['class' => 'form-horizontal']); ?&gt;

    &lt;?php echo $this->Form->end(); ?&gt;
  </pre>
  でformタグの生成を行っています。
</p>
<p>
  「false」と記述されている部分には、通常Entityを入れます。<br />
  falseを指定するとModel(Entity)に属していない単なるフォームとなります。<br />
  また、送信先は現在のurlに対して行うようになります。
</p>

<p>
  次の['class' => 'form-horizontal']はフォームに対するオプションです。<br />
  オプションには送信先urlやHTMLのid属性やclass属性を指定できます。<br />
  指定する際は、「[]」の中に記述していきます。<br />
  今回はformタグにclass名「form-horizontal」を付加しました。
</p>

<p>
  入力フォームに関して説明します。
  <pre>
    &lt;?php echo $this->Form->label('name','ニックネーム',['class' => 'col-sm-3 control-label']);?&gt;
  </pre>
  でフォームのlabelを表示できます。<br />
  label(カラム名,表示したい文字,オプション)という順序で指定しています。<br />
  カラム名はDBのテーブル(ここではユーザ)の各項目名のことです。<br />
  オプションは$this->Form->createと同じ指定方法です。<br />
  ここではニックネームと表示させ、かつ、class名に「col-sm-3 control-label」を指定しています。
</p>

<p>
  <pre>
    &lt;?php echo $this->Form->text('name',['class' => 'form-control','placeholder' => 'ニックネーム']); ?&gt;
  </pre>
  はテキスト入力フォームを表示するためのものです。<br />
  text(カラム名,オプション)という順番で指定します。<br />
  カラム名・オプションはlabelのときと同じです。
</p>

<p>
  <pre>
      &lt;?php echo $this->Form->submit('登録',['class' => 'btn btn-success']); ?&gt;
  </pre>
  は送信ボタンを表示するためのものです。<br />
  submit(ボタンに表示させた文字,オプション)という順番で指定します。<br />
  オプションはlabelやtextと同様の指定方法です。
</p>

<p>
  入力フォームの設置ができましたので、次はログイン認証を実装していきます。
</p>

<h3 class="page-header">ログイン設定</h3>

<p>
  ログイン認証はcakephpが提供してくれている「authコンポーネント」を使用します。<br />
  これを使用すれば、誰でも認証機能を実装できます。
</p>

<p>
  Controllerフォルダの中にAppControllerというファイルがありますので、開いてください。<br />
  AppControllerは、すべてのControllerファイルに共通する設定を記述していきます。<br />
  AppControllerのinitialize()という箇所に下記コードを追加してください。
</p>

<pre>
  public function initialize()
  {
      parent::initialize();
      $this->loadComponent('RequestHandler');
      $this->loadComponent('Flash');
      $this->loadComponent('Auth',[
        'loginAction' =>[                                 //ログインしていない状態でログイン必須のページにアクセスしたときのアクセス先
          'controller' => 'Users',
          'action' => 'login'
        ],
        'loginRedirect' =>[                               //ログインした時のアクセスの飛び先
          'controller' => 'Users',
          'action' => 'index'
        ],
        'logoutRedirect' =>[                              //ログアウトした時のアクセスの飛び先
          'controller' => 'Users',
          'action' => 'login'
        ],
        'authenticate' =>[
          'Form' => [
            'userModel' => 'user',                        //認証を行うDBのテーブル名を指定
            'fields' =>[                                  //認証を行うフィールド名を指定
              'username' => 'name',                       //第一フィールドをUserテーブルのnameを指定
              'password' => 'password'                    //第二フィールドをUserテーブルのpasswordを指定
            ]
          ]
        ],
        'authError' => 'ログインしてください',                //ログインしていない状態でログイン必須のページにアクセスしたときのエラーメッセージ
        'flash' =>['element' =>'error','key' =>'auth']  //エラーメッセージのフラッシュメッセージを指定
      ]);
  }
</pre>

<p>
  ログイン認証を行う際は,Authコンポーネントを使用します。<br />
  それぞれが何の設定を行っているかは上のコメント欄をご覧ください。<br />
  フラッシュメッセージについてですが、「'element' =>'error'」で、<br />
  Templete/Element/Flash/error.ctpを表示する様に指定しています。<br />
  「'key' =>'auth'」でこのメッセージは「auth」というキー名で表示するよう指定しています。
</p>

<p>
  認証の設定を行いましたので、今度は実際のログイン認証を実装していきます。<br />
  ControllerフォルダのUserControllerファイルを開いてください。<br />
  そして、一番初めに記述した「login()」という箇所に下記コードを記述してください。
</p>

<pre>
  public function login()
	{
		if(!$this->request->is('post')){  //フォームの送信がPOSTというメソッドで送信されていない時
			return $this->render();        //Template/Users/login.ctpを表示
		}

		$user = $this->Auth->identify();  //ここで送信された値の認証を行っている

		if(!$user){                       //認証が失敗した場合
      //キー名を「auth」とするエラー メッセージ(ニックネームかパスワードが間違っています)を設定
			$this->Flash->error('ニックネームかパスワードが間違っています',['key' =>'auth']);
			return $this->render();        //Template/Users/login.ctpを表示
		}

		$this->Auth->setUser($user);      //ログイン認証したことをセット
		$this->redirect($this->Auth->redirectUrl());  //ログインした際のアクセス先に飛ばす
	}
</pre>

<p>
  入力しましたら、「users/add」でユーザ登録の画面にアクセスしてユーザ登録を行ってください。<br />
  登録が完了しましたら、phpMyAdminの管理画面を開いてください。<br />
  「mydb」をクリックして、でてきた「user」テーブルをクリックしてください。<br />
	そして「表示」というタブをクリックし、入力したデータが登録されているか確認してください。<br />
  入力した値が適切に保存されていましたら、成功です。
</p>

<?php echo $this->Html->image('phpmyadmin2.png'); ?>

<p>
  登録できましたら、ログイン画面でログイン情報を入力してアクセスしてみてください。<br />
  アクセスできましたら成功です。
</p>

<h3 class="page-header">ログアウト設定</h3>

<p>
  ログイン設定ができましたら、今後はログアウト設定を行います。<br />
  ログアウトはブラウザに表示するものはないため、routesとコントローラの設定だけで良いです。<br />
  では、実際に実装していきましょう。
</p>

<p>
  /config/routes.phpに下記コードを入力してください。
</p>

<pre>
  $routes->connect('/users/logout',                  ['controller' => 'Users','action' => 'logout']);
</pre>

<p>
  src/Controller/UsersController.phpファイルを開いてください。<br />
  そして、login(){}の下に下記コードを記述してください。
</p>

<pre>
  public function login()
	{
    //処理
  }
  public function logout()
	{
		$this->redirect($this->Auth->logout()); //ログアウトを行い、ログアウトした際のアクセス先に飛ばす
	}
</pre>

<p>
  これでログアウト処理ができました。<br />
  あとは、ログアウト処理をさせるリンク先を作ります。<br />
  src/Template/Element/nav.ctpファイルを開き下記コードのように修正を行ってください。
</p>

<pre>
  &lt;div id="navbar" class="navbar-collapse collapse"&gt;
    &lt;?php if($currentUserRow): ?&gt;
    &lt;ul class="nav navbar-nav"&gt;
      &lt;li&gt;
        &lt;a href="#"&gt;
          ホーム
        &lt;/a&gt;
      &lt;/li&gt;
      &lt;li&gt;
        &lt;a href="#"&gt;
          通知
        &lt;/a&gt;
      &lt;/li&gt;
    &lt;/ul&gt;

    &lt;p class="navbar-text navbar-right"&gt;
      &lt;a href="&lt;?php echo $this->Url->build(['controller' => 'users','action' => 'logout']); ?&gt;" class="navbar-link"&gt;
        ログアウト
      &lt;/a&gt;
    &lt;/p&gt;
    &lt;ul class="nav navbar-nav navbar-right"&gt;
      &lt;li class="dropdown "&gt;
      &lt;a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"&gt;User&lt;span class="caret"&gt;&lt;/span&gt;&lt;/a&gt;
        &lt;ul class="dropdown-menu"&gt;
          &lt;li&gt;
            &lt;a href="#"&gt;
              詳細
            &lt;/a&gt;
          &lt;/li&gt;
          &lt;li&gt;
            &lt;a href="#"&gt;
              プロフィール編集
            &lt;/a&gt;
          &lt;/li&gt;
        &lt;/ul&gt;
      &lt;/li&gt;
    &lt;/ul&gt;
    &lt;?php else: ?&gt;
      &lt;p class="navbar-text navbar-right"&gt;
        &lt;a href="&lt;?php echo $this->Url->build(['controller' => 'users','action' => 'login']); ?&gt;" class="navbar-link"&gt;
          ログイン
        &lt;/a&gt;
      &lt;/p&gt;
    &lt;?php endif; ?&gt;
  &lt;/div&gt;<!--/.nav-collapse -->
</pre>

<p>
  ここで下記のコードがありますが、
  <pre>
    $this->Url->build(['controller' => 'users','action' => 'login']);
  </pre>
  はURLを生成します。<br />
  指定方法は、「build(['controller' => コントローラ名,'action' => アクション名]);」です。<br />
  ここでは、UsersController.phpのアクションlogin()にアクセスします。
</p>

<p>
  変数$currentUserRowにはログインしたユーザのデータが格納されています。
</p>

<p>
  最後にsrc/Controller/UsersController.phpファイルを開き下記コードを記述してください。
</p>

<pre>
  class UsersController extends AppController{

    public function beforeFilter(Event $event)
    {
      parent::beforeFilter($event);                     //親コントローラ(AppController)のbeforeFilterを呼び出す
      $this->Auth->allow(['add','logout']);             //「users/add」と「users/login」ページはログインしなくてもアクセスできるようにしている
      $this->set('currentUserRow',$this->Auth->user());   //ログインしたユーザを$currentUserRowという変数に格納している
    }
</pre>

<p>
  これでログアウト設定が完了しました。<br />
  実際にログインしている状態のときは、ナビゲーションメニューにUserやログアウトリンクが表示され、<br />
  ログアウトしている状態のときは、ナビゲーションメニューにログインのリンクが表示されていましたら成功です。
</p>

<p>
  以上でログイン認証は終了です。<br />
  このように、フレームワークを使用すれば特にプログライングの知識がなくても実装できるので、<br />
  是非チャレンジしてみてください。
</p>

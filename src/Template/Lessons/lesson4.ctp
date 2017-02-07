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

<p>フレームワークは、このMVCという構造とフレームワークが提供してくれている機能を使ってアプリケーションを実装していきます。</p>

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

<h3>URLの設定</h3>

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

<h3>フォームの設置</h3>

<p>
  urlを記述しましたので、今度はアクセスした際の処理を記述していきます。<br />
  具体的な処理を記述する部分は、「src」フォルダの配下にあります。
</p>

<p>
  srcディレクトリを開きましたら、さらに様々なフォルダがでてきます。<br />
  その中のControllerというディレクトリを開きいてください。<br />
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
  これで、「users/login」とアクセスが来た際の処理の箇所を確保しました。<br />
  ですが、これだけではブラウザに表示させることはできません。<br />
  なぜなら、ブラウザに表示するファイルがないからです。
</p>

<p>
  ブラウザに表示するためのファイを作成します。<br />
  「src」フォルダ内に「Template」というフォルダがあります。<br />
  その中に実際のブラウザに表示されるものを配置していきます。<br />
</p>

<p>
  Templateディレクトリを開きますと、Teplateディレクトの中もさらにフォルダが配置されています。<br />
  Templateディレクトの中は各Controllerファイルの「Controller」という除いたフォルダと、<br />
  フレームワークが予め提供してくれているフォルダが配置されています。<br />
  実際、新たにControllerファイルを作成した際は、自身でフォルダを作成しなければなりません。
</p>

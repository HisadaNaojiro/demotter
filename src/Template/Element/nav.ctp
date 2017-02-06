<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Demo Twitter</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <?php if($authenticate): ?>
          <ul class="nav navbar-nav">
            <li>
              <a href="#">
                ホーム
              </a>
            </li>
            <li>
              <a href="#">
                通知
              </a>
            </li>
          </ul>

          <p class="navbar-text navbar-right">
            <a href="<?php echo $this->Url->build(['controller' => 'users','action' => 'logout']); ?>" class="navbar-link">
              ログアウト
            </a>
          </p>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown ">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li>
                  <a href="#">
                    詳細
                  </a>
                </li>
                <li>
                  <a href="#">
                    プロフィール編集
                  </a>
                </li>
              </ul>
            </li>
          </ul>
          <?php else: ?>
            <p class="navbar-text navbar-right">
              <a href="<?php echo $this->Url->build(['controller' => 'users','action' => 'login']); ?>" class="navbar-link">
                ログイン
              </a>
            </p>
          <?php endif; ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
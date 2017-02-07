<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $this->Url->build(['controller' => 'lessons','action' => 'index']); ?>">
            PHP レッスン
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo $this->Url->build(['controller' => 'lessons','action' => 'index']); ?>">
                ホーム
              </a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<h1 class="page-header">レッスン5</h1>

<p>
  この講義を進めるにあたり,テーブルを作成する必要があるため、下記コードをDBに流してください。<br />
  流し方は下記ページを参考に行ってください。<br />
  <a href="<?php echo $this->Url->build(['controller' => 'lessons','action' =>'lesson0']); ?>" target="_blank">
    DBの用意
  </a>
</p>

<pre>
  CREATE TABLE IF NOT EXISTS `mydb`.`micropost` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
    `content` VARCHAR(255) NOT NULL COMMENT '',
    `created` DATETIME NOT NULL COMMENT '',
    `modified` DATETIME NOT NULL COMMENT '',
    `valid` TINYINT(4) NOT NULL DEFAULT 1 COMMENT '',
    `user_id` INT NOT NULL COMMENT '',
    PRIMARY KEY (`id`)  COMMENT '',
    INDEX `fk_micropost_user_idx` (`user_id` ASC)  COMMENT '',
    CONSTRAINT `fk_micropost_user`
      FOREIGN KEY (`user_id`)
      REFERENCES `mydb`.`user` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;

</pre>

<h2>ツイート投稿機の実装</h2>

<h3 class="page-header">レイアウト作成</h3>

<p>
  まずは、src/Template/Users/inde.ctpファイルを開き下記コードを記述してください。
</p>

<pre>
  &lt;div class="row"&gt;
  &lt;div id="user-info" class="col-md-3"&gt;
    &lt;div class="user-profile col-xs-12"&gt;
      &lt;div&gt;&lt;/div&gt;
        &lt;div class="col-xs-6 user-image"&gt;
          &lt;p style="font-size: 80px;"&gt;&lt;span class="glyphicon glyphicon-user" aria-hidden="true"&gt;&lt;/span&gt;&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="col-xs-6 user-name"&gt;
          &lt;p style="font-size: 20px;"&gt;&lt;?php echo h($currentUserRow->getName());?&gt;&lt;/p&gt;
        &lt;/div&gt;
      &lt;/div&gt;
      &lt;div class="user-info-link col-xs-12"&gt;
        &lt;span class="col-xs-4"&gt;
          &lt;a href="#"&gt;
            ツイート
          &lt;/a&gt;
        &lt;/span&gt;
        &lt;span class="col-xs-4"&gt;
          &lt;a href="#"&gt;
            フォロー
          &lt;/a&gt;
        &lt;/span&gt;
        &lt;span class="col-xs-4"&gt;
          &lt;a href="#"&gt;
            フォロワー
          &lt;/a&gt;
        &lt;/span&gt;
      &lt;/div&gt;
    &lt;/div&gt;
    &lt;div id="micropost" class="col-md-8 col-md-offset-1"&gt;
      &lt;div id="js-micropost-form" class="micropost-form-space bg-warning"&gt;
        &lt;div class="micropost-form-image col-xs-1" style="font-size: 30px;"&gt;&lt;span class="glyphicon glyphicon-user" aria-hidden="true"&gt;&lt;/div&gt;
          &lt;div id="js-micopost-create-form" class="input-group col-xs-11"&gt;
            &lt;input  id="js-micropost-text-form" type="text" name="micropost" placeholder="つぶやく" class="form-control"&gt;
          &lt;/div&gt;
          &lt;div id="micropost-form-bottom" class="text-right" style="display: none"&gt;
              &lt;button type="button" class="submit-micropost btn btn-warning" disabled="true" &gt;投稿&lt;/button&gt;
          &lt;/div&gt;
        &lt;/div&gt;

    	&lt;div id="ovarall-micropost-space"&gt;
        &lt;div class="each-paginate-micropost-space"&gt;
          &lt;div data-toggle="modal"  data-micropost-id="" class="each-micropost-space each-micropost-border" data-user-id=""&gt;
            &lt;div class="micropost-content-space"&gt;
              &lt;div class="micropost-user-info"&gt;
                &lt;p&gt;&lt;span class="glyphicon glyphicon-user" aria-hidden="true"&gt;&lt;/span&gt;&lt;?php echo h($currentUserRow->getName());?&gt;&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class="micropost-content" &gt;
                    &lt;p&gt;
                      サンプル
                    &lt;/p&gt;
                &lt;/div&gt;
              &lt;/div&gt;
            &lt;/div&gt;
          &lt;/div&gt;
        &lt;/div&gt;
      &lt;/div&gt;
    &lt;/div&gt;
</pre>

<p>ツイート投稿機能を実装するにあたりまずは、下記入力フォームをクリックした際に、</p>

<?php echo $this->Html->image('lesson05.png'); ?>

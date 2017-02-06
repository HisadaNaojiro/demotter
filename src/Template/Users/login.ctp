<div class="page-header">
  <h1>ログイン</h1>
</div>
<?php echo $this->Flash->render('auth') ; ?>
<?php echo $this->Form->create(false,['class' => 'form-horizontal']); ?>
  <div class="form-group">
    <?php echo $this->Form->label('name','ニックネーム',['class' => 'col-sm-3 control-label']);?>
    <div class="col-sm-4">
      <?php echo $this->Form->text('name',['class' => 'form-control','placeholder' => 'ニックネーム']); ?>
    </div>
  </div>
  <div class="form-group">
    <?php echo $this->Form->label('password','パスワード',['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-4">
      <?php echo $this->Form->text('password',[
        'class' => 'form-control',
        'type' => 'password',
        'placeholder' => 'パスワード'
      ]);?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <?php echo $this->Form->submit('登録',['class' => 'btn btn-success']); ?>
    </div>
  </div>
<?php echo $this->Form->end(); ?>

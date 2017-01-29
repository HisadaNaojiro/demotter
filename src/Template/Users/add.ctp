<div class="page-header">
		<h1>ユーザ登録</h1>
	</div>
  <?php echo $this->Form->create($User,['novalidate' => true,'class' => 'form-horizontal']);?>
    <div class="form-group <?php echo ($this->Form->isFieldError('name'))? 'has-error' : ''; ?>">
      <?php echo $this->Form->label('name','ニックネーム',
        [
            'class' => 'col-sm-2 control-label'
        ]
      );?>
      <div class="col-sm-10">
        <?php echo $this->Form->text('name',
          [
            'class' => 'form-control',
            'placeholder' => 'コーダーズ太郎'
          ]
        );?>
        <?php echo $this->Form->error('name',null,['class' => 'text-danger']); ?>
      </div>
    </div>
    <div class="form-group <?php echo ($this->Form->isFieldError('email'))? 'has-error' : ''; ?>">
      <?php echo $this->Form->label('email','メールアドレス',
        [
            'class' => 'col-sm-2 control-label'
        ]
      );?>
      <div class="col-sm-10">
        <?php echo $this->Form->text('email',
          [
            'type' => 'email',
            'class' => 'form-control',
            'placeholder' => 'corders@example.com'
          ]
        );?>
        <?php echo $this->Form->error('email'); ?>
      </div>
    </div>
    <div class="form-group <?php echo ($this->Form->isFieldError('emailConfirmation'))? 'has-error' : ''; ?>">
      <?php echo $this->Form->label('emailConfirmation','確認用メールアドレス',
        [
            'class' => 'col-sm-2 control-label'
        ]
      );?>
      <div class="col-sm-10">
        <?php echo $this->Form->text('emailConfirmation',
          [
            'type' => 'email',
            'class' => 'form-control',
            'placeholder' => 'corders@example.com'
          ]
        );?>
        <?php echo $this->Form->error('emailConfirmation'); ?>
      </div>
    </div>
    <div class="form-group <?php echo ($this->Form->isFieldError('password'))? 'has-error' : ''; ?>">
      <?php echo $this->Form->label('password','パスワード',
        [
            'class' => 'col-sm-2 control-label'
        ]
      );?>
      <div class="col-sm-10">
        <?php echo $this->Form->text('password',
          [
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Passowrd'
          ]
        );?>
        <?php echo $this->Form->error('password'); ?>
      </div>
    </div>
    <div class="form-group <?php echo ($this->Form->isFieldError('passwordConfirmation'))? 'has-error' : ''; ?>">
      <?php echo $this->Form->label('passwordConfirmation','確認用パスワード',
        [
            'class' => 'col-sm-2 control-label'
        ]
      );?>
      <div class="col-sm-10">
        <?php echo $this->Form->text('passwordConfirmation',
          [
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Passowrd'
          ]
        );?>
        <?php echo $this->Form->error('passwordConfirmation'); ?>
      </div>
    </div>

    <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<?php echo $this->Form->submit('登録',['class' => 'btn btn-success']); ?>
			</div>
		</div>
  <?php echo $this->Form->end(); ?>

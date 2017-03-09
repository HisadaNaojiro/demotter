<!DOCTYPE html>
<html>
<head>
    <?php echo  $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo  $title ?>
    </title>
    <?php echo  $this->Html->meta('icon'); ?>

    <?php echo  $this->Html->css('bootstrap.min.css'); ?>
    <?php echo  $this->Html->css('font-awesome.min.css'); ?>

    <?php if($this->request->action !== 'login' && $this->request->action !== 'add') : ?>
      <?php echo  $this->Html->css('demotter.css'); ?>
    <?php endif; ?>
    <?php echo $this->Html->css('theme.css'); ?>

    <?php echo  $this->fetch('meta') ?>
    <?php echo  $this->fetch('css') ?>
    <?php echo  $this->fetch('script') ?>
</head>
<body>
    <?php echo $this->element('nav'); ?>
    <div class="container clearfix">
        <?php echo  $this->fetch('content') ?>
    </div>

    <?php echo $this->Html->script('jquery-2.2.4.min.js'); ?>
    <?php echo $this->Html->script('bootstrap.min.js'); ?>
    <?php echo $this->Html->script('micropost.js'); ?>
</body>
</html>

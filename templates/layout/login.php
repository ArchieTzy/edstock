<?php
$title = 'EdStock';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $title ?>:
        <?= $this->fetch('title') ?>
    </title>
        <?= $this->Html->meta('icon', $this->Url->image('logo.png', ['fullBase' => true])) ?>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">

    <?= $this->Html->css(['/plugins/fontawesome-free/css/all.min',
        '/plugins/icheck-bootstrap/icheck-bootstrap.min',
        '/dist/css/adminlte.min',
    ]) ?>
    <?= $this->Html->script(['/plugins/jquery/jquery.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="hold-transition login-page">
<?= $this->fetch('content') ?>
<?= $this->Html->script([
    '/plugins/bootstrap/js/bootstrap.bundle.min',
    '/dist/js/adminlte.min'
]) ?>
</body>
</html>

<?php
/**
 * @var \Framework\Template\Php\PhpRenderer $this
 * @var string $name
 */
?>

<?php $this->extend('layout/columns'); ?>

<?php $this->beginBlock('title') ?>Cabinet<?php $this->endBlock() ?>

<?php $this->beginBlock('breadcrumbs') ?>
    <ul class="breadcrumb">
        <li><a href="<?= $this->e($this->path('home')) ?>">Home</a></li>
        <li class="active">Cabinet</li>
    </ul>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('main') ?>
    <h1>Cabinet of <?= $this->e($name) ?></h1>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('sidebar') ?>
    <div class="card mb-3">
        <div class="card-header">Cabinet</div>
        <div class="panel-body">
            Cabinet navigation
        </div>
    </div>
<?php $this->endBlock(); ?>




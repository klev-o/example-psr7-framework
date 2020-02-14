<?php
/**
 * @var \Framework\Template\Php\PhpRenderer $this
 */
?>

<?php $this->extend('layout/columns'); ?>

<?php $this->beginBlock('title') ?>Cat<?php $this->endBlock() ?>

<?php $this->beginBlock('meta'); ?>
    <meta name="description" content="Cat Page description" />
<?php $this->endBlock(); ?>

<?php $this->beginBlock('breadcrumbs') ?>
    <ul class="breadcrumb">
        <li><a href="<?= $this->e($this->path('home')) ?>">Home</a></li>
        <li class="active">Cat</li>
    </ul>
<?php $this->endBlock() ?>

<?php $this->beginBlock('main') ?>
    <h1>I am a cat</h1>
<?php $this->endBlock() ?>


<?php
/**
 * @var \Framework\Template\PhpRenderer $this
 */
?>

<?php $this->extend('layout/default'); ?>

<?php $this->beginBlock('title') ?>Cat<?php $this->endBlock() ?>

<?php $this->beginBlock('meta'); ?>
    <meta name="description" content="Cat Page description" />
<?php $this->endBlock(); ?>

<?php $this->beginBlock('breadcrumbs') ?>
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">Cat</li>
    </ul>
<?php $this->endBlock() ?>

<?php $this->beginBlock('content') ?>
    <h1>I am a cat</h1>
<?php $this->endBlock() ?>


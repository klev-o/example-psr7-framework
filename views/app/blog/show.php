<?php
/**
 * @var \Framework\Template\PhpRenderer $this
 * @var \App\ReadModel\Views\PostView $post
 */

$this->extend('layout/default');
?>

<?php $this->beginBlock('title'); ?><?= $this->e($post->title) ?><?php $this->endBlock(); ?>

<?php $this->beginBlock('meta'); ?>
<meta name="description" content="<?= $this->e($post->title) ?>" />
<?php $this->endBlock(); ?>

<?php $this->beginBlock('breadcrumbs'); ?>
<ul class="breadcrumb">
    <li><a href="<?= $this->e($this->path('home')) ?>">Home</a></li>
    <li><a href="<?= $this->e($this->path('blog')) ?>">Blog</a></li>
    <li class="active"><?= $this->e($post->title) ?></li>
</ul>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('content'); ?>

<h1><?= $this->e($post->title) ?></h1>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= $post->date->format('Y-m-d') ?>
    </div>
    <div class="panel-body"><?= nl2br($this->e($post->content)) ?></div>
</div>

<?php $this->endBlock(); ?>
<?php

use App\Http\Action;
use Framework\Http\Application;

/** @var Application $app */

$app->get('home', '/', Action\HelloAction::class);
$app->get('cat', '/cat', Action\CatAction::class);
$app->get('cabinet', '/cabinet', Action\CabinetAction::class);
$app->get('blog', '/blog', Action\Blog\IndexAction::class);
$app->get('blog_page', '/blog/page/{page}', Action\Blog\IndexAction::class, ['tokens' => ['page' => '\d+']]);
$app->get('blog_show', '/blog/{id}', Action\Blog\ShowAction::class, ['tokens' => ['id' => '\d+']]);
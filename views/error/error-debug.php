<?php
/**
 * @var \Framework\Template\PhpRenderer $this
 * @var \Throwable $exception
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= $this->renderBlock('meta') ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
</head>
<body>
<div class="app-content">
    <main class="container">

        <h1>Exception: <?= $this->e($exception->getMessage()) ?></h1>

        <p>Code: <?= $this->e($exception->getCode()) ?></p>
        <p><?= $this->e($exception->getFile()) ?> on line <?= $this->e($exception->getLine()) ?></p>
        <?php foreach ($exception->getTrace() as $trace): ?>
            <p><?= $this->e($trace['file']) ?> on line <?= $this->e($trace['line']) ?></p>
        <?php endforeach; ?>

    </main>
</div>
</body>
</html>
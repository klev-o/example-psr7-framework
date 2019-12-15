<?php

use Framework\Http\Request;

chdir(dirname(__DIR__));

require 'src/Framework/Http/Request.php';

### Initialization
$request = new Request();

### Action
$name = $request->getQueryParams()['name'] ?? 'Guest';

header('X-MyHeader: Hello World');
echo 'Hello, ' . $name . '!';
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArrayInput([
        'command' => 'migrate:fresh',
        '--seed' => true,
        '--force' => true
    ]),
    new Symfony\Component\Console\Output\ConsoleOutput()
);

exit($status);

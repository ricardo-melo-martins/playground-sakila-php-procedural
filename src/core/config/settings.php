<?php

$settings = [];

$settings['logger'] = [
    // Log file location
    'path' => __DIR__ . '/../tmp/logs',
    // Default log level
    'level' => \Psr\Log\LogLevel::DEBUG,
];

return $settings;

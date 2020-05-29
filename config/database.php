<?php

return [
    'DB_DB_CONNECTION' => (env('DB_CONNECTION') ?? 'mysql'),
    'DB_HOST' => (env('DB_HOST') ?? '127.0.0.1'),
    'DB_PORT' => (env('DB_PORT') ?? '3306'),
    'DB_DATABASE' => (env('DB_DATABASE') ?? 'TaskManager'),
    'DB_USERNAME' => (env('DB_USERNAME') ?? 'root'),
    'DB_PASSWORD' => (env('DB_PASSWORD') ?? ''),
];
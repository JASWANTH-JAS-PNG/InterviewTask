<?php

// Vercel serverless has a read-only filesystem except /tmp
// Create writable directories Laravel needs at runtime
@mkdir('/tmp/views', 0775, true);
@mkdir('/tmp/cache', 0775, true);

// Point Blade compiler to writable /tmp/views
putenv('VIEW_COMPILED_PATH=/tmp/views');

$root = __DIR__ . '/../public';
$_SERVER['DOCUMENT_ROOT'] = $root;

require $root . '/index.php';

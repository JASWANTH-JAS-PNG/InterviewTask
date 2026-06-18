<?php

// Vercel serverless has a read-only filesystem except /tmp
@mkdir('/tmp/views', 0775, true);
@mkdir('/tmp/cache', 0775, true);

// Redirect all Laravel runtime writes to /tmp
putenv('VIEW_COMPILED_PATH=/tmp/views');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_EVENTS_CACHE=/tmp/events.php');

$root = __DIR__ . '/../public';
$_SERVER['DOCUMENT_ROOT'] = $root;

require $root . '/index.php';

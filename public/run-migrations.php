<?php
/**
 * Standalone Artisan Migration Script
 * Bypasses Laravel's routing to avoid 404s and route caching issues.
 */

$secureToken = 'WmpCreativeSecureToken2026';

if (!isset($_GET['token']) || $_GET['token'] !== $secureToken) {
    http_response_code(403);
    die('Unauthorized access.');
}

// Boot Laravel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Run the migrations
echo "<h2>Running Migrations...</h2>";
echo "<pre style='background:#111; color:#0f0; padding:15px; border-radius:8px;'>";

try {
    $kernel->call('migrate', ['--force' => true]);
    echo htmlentities(\Illuminate\Support\Facades\Artisan::output());
} catch (\Exception $e) {
    echo "Error: " . htmlentities($e->getMessage());
}

echo "</pre>";
echo "<p><strong>Finished.</strong> <a href='/'>Go to Home</a></p>";

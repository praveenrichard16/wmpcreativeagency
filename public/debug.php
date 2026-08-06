<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$token = 'WmpCreativeSecureToken2026';
if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    die('Unauthorized access.');
}

echo "<h1>Diagnostic Report</h1>";

// 1. Check .env file
$envPath = dirname(__DIR__) . '/.env';
echo "<h3>1. Checking .env file</h3>";
if (file_exists($envPath)) {
    echo "✅ .env file exists.<br>";
    $lines = file($envPath);
    foreach ($lines as $line) {
        if (trim($line) === '' || strpos($line, '#') === 0) continue;
        $parts = explode('=', $line, 2);
        $key = trim($parts[0]);
        if (in_array($key, ['APP_NAME', 'APP_ENV', 'APP_DEBUG', 'APP_URL', 'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME'])) {
            echo htmlspecialchars(trim($line)) . "<br>";
        }
    }
} else {
    echo "❌ .env file does NOT exist at: " . htmlspecialchars($envPath) . "<br>";
}

// 2. Check vendor directory
$vendorPath = dirname(__DIR__) . '/vendor/autoload.php';
echo "<h3>2. Checking vendor autoload</h3>";
if (file_exists($vendorPath)) {
    echo "✅ vendor/autoload.php exists.<br>";
} else {
    echo "❌ vendor/autoload.php does NOT exist. You need to run composer install on the server.<br>";
}

// 3. Check storage directory write permissions
echo "<h3>3. Checking storage permissions</h3>";
$storagePath = dirname(__DIR__) . '/storage';
if (is_writable($storagePath)) {
    echo "✅ storage/ is writable.<br>";
} else {
    echo "❌ storage/ is NOT writable.<br>";
}

$cachePath = dirname(__DIR__) . '/bootstrap/cache';
if (is_writable($cachePath)) {
    echo "✅ bootstrap/cache/ is writable.<br>";
} else {
    echo "❌ bootstrap/cache/ is NOT writable.<br>";
}

// 4. Test Database Connection
echo "<h3>4. Testing Database Connection</h3>";
try {
    $dbType = 'mysql';
    $dbHost = '127.0.0.1';
    $dbPort = '3306';
    $dbName = 'u775883014_wmpcreative';
    $dbUser = 'u775883014_wmpcreative';
    $dbPass = 'Wmp@12345!@#Creative';
    
    $dsn = "$dbType:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5,
    ]);
    echo "✅ Successfully connected to database using PDO!<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . htmlspecialchars($e->getMessage()) . "<br>";
}

// 5. Read Laravel Log file (last 20 lines)
echo "<h3>5. Laravel Log File (Latest 20 lines)</h3>";
$logPath = dirname(__DIR__) . '/storage/logs/laravel.log';
if (file_exists($logPath)) {
    $logContent = file($logPath);
    $lastLines = array_slice($logContent, -20);
    echo "<pre style='background:#f4f4f4; padding:10px; border:1px solid #ccc; max-height: 400px; overflow: auto;'>";
    foreach ($lastLines as $line) {
        echo htmlspecialchars($line);
    }
    echo "</pre>";
} else {
    echo "ℹ️ laravel.log does not exist yet (or no errors logged).<br>";
}

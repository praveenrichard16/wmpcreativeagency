<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$token = 'WmpCreativeSecureToken2026';
if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    die('Unauthorized access.');
}

echo "<h1>Diagnostic & Repair Report</h1>";

// 1. Manually clear bootstrap cache files to force configuration reload
echo "<h3>1. Clearing bootstrap/cache/ files</h3>";
$cacheDir = dirname(__DIR__) . '/bootstrap/cache';
if (is_dir($cacheDir)) {
    $files = glob($cacheDir . '/*.php');
    if (empty($files)) {
        echo "✅ No bootstrap cache files found (configuration is not cached).<br>";
    } else {
        foreach ($files as $file) {
            if (unlink($file)) {
                echo "🗑️ Deleted cache file: " . htmlspecialchars(basename($file)) . "<br>";
            } else {
                echo "❌ Failed to delete cache file: " . htmlspecialchars(basename($file)) . "<br>";
            }
        }
    }
} else {
    echo "❌ bootstrap/cache directory not found.<br>";
}

// 2. Check .env file
$envPath = dirname(__DIR__) . '/.env';
echo "<h3>2. Checking .env file</h3>";
if (file_exists($envPath)) {
    echo "✅ .env file exists.<br>";
} else {
    echo "❌ .env file does NOT exist at: " . htmlspecialchars($envPath) . "<br>";
}

// 3. Check vendor directory
$vendorPath = dirname(__DIR__) . '/vendor/autoload.php';
echo "<h3>3. Checking vendor autoload</h3>";
if (file_exists($vendorPath)) {
    echo "✅ vendor/autoload.php exists.<br>";
} else {
    echo "❌ vendor/autoload.php does NOT exist.<br>";
}

// 4. Check storage directory write permissions
echo "<h3>4. Checking storage permissions</h3>";
$storagePath = dirname(__DIR__) . '/storage';
if (is_writable($storagePath)) {
    echo "✅ storage/ is writable.<br>";
} else {
    echo "❌ storage/ is NOT writable.<br>";
}

// 5. Test Database Connection and List Tables
echo "<h3>5. Testing Database Connection & Tables</h3>";
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
    
    $tablesQuery = $pdo->query("SHOW TABLES");
    $tables = $tablesQuery->fetchAll(PDO::FETCH_COLUMN);
    if (empty($tables)) {
        echo "⚠️ Database is empty. No tables found! You need to run migrations.<br>";
    } else {
        echo "✅ Tables in database: " . implode(', ', $tables) . "<br>";
    }
} catch (Exception $e) {
    echo "❌ Database connection failed: " . htmlspecialchars($e->getMessage()) . "<br>";
}

// 6. Read Laravel Log file for actual Exception messages
echo "<h3>6. Laravel Log File (Exceptions found)</h3>";
$logPath = dirname(__DIR__) . '/storage/logs/laravel.log';
if (file_exists($logPath)) {
    $logLines = file($logPath);
    $exceptions = [];
    
    for ($i = count($logLines) - 1; $i >= 0; $i--) {
        $line = $logLines[$i];
        if (preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\] [a-zA-Z0-9_]+\.(ERROR|CRITICAL|EMERGENCY|ALERT):/', $line)) {
            $errorBlock = $line;
            for ($j = 1; $j <= 4; $j++) {
                if (isset($logLines[$i + $j])) {
                    $next = $logLines[$i + $j];
                    if (strpos($next, '#') !== 0) {
                        $errorBlock .= $next;
                    } else {
                        break;
                    }
                }
            }
            $exceptions[] = $errorBlock;
            if (count($exceptions) >= 5) {
                break;
            }
        }
    }
    
    if (empty($exceptions)) {
        echo "ℹ️ No recent Laravel exceptions found in logs.<br>";
    } else {
        foreach ($exceptions as $ex) {
            echo "<pre style='background:#fee; color:#811; padding:10px; border:1px solid #ecc; margin-bottom:10px; white-space: pre-wrap;'>";
            echo htmlspecialchars($ex);
            echo "</pre>";
        }
    }
} else {
    echo "ℹ️ laravel.log does not exist yet.<br>";
}

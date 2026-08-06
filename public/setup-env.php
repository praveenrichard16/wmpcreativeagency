<?php
// Secure token check to prevent unauthorized execution
$token = 'WmpCreativeSecureToken2026';

if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    die('Unauthorized access.');
}

// Laravel root is one level up from public/
$envPath = dirname(__DIR__) . '/.env';

$envContent = <<<EOT
APP_NAME="WMP Creative Agency"
APP_ENV=production
APP_KEY=base64:3aa7g9ip9kL4ozxBNzt2voatm+JDHA8bNiLojDjyzNE=
APP_DEBUG=false
APP_URL=https://wmpcreativeagency.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u775883014_wmpcreative
DB_USERNAME=u775883014_wmpcreative
DB_PASSWORD="Wmp@12345!@#Creative"

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
CACHE_STORE=database

DEPLOYMENT_SECRET=mycustomsecrettoken123
EOT;

if (file_put_contents($envPath, $envContent)) {
    // Set appropriate permissions
    chmod($envPath, 0644);
    echo "<h3>Success: .env file has been created successfully on Hostinger!</h3>";
    echo "<p>Path: " . htmlspecialchars($envPath) . "</p>";
    echo "<p>Please delete this file (<code>public/setup-env.php</code>) immediately from your repository/server for security.</p>";
} else {
    echo "<h3>Error: Failed to write .env file.</h3>";
    echo "<p>Check folder permissions for: " . htmlspecialchars(dirname($envPath)) . "</p>";
}

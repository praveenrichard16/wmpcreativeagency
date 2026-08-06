<?php
// Secure token check to prevent unauthorized execution
$token = 'WmpCreativeSecureToken2026';

if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    die('Unauthorized access.');
}

$sshDir = '/home/u775883014/.ssh';
$authKeysFile = $sshDir . '/authorized_keys';

// Our generated public key
$publicKey = "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDJbUnVf0GXnuZ/TrAqzSkwukSLWzyDw8B1c+EFYzaC/GjqVQ+4mBspYnSwc1WIRvYsdTTXXY1wTY94YfeytCZoTgvnLrO3qpMcNKQidWSCmAJD+QkOwvE1iqXYHMp9idPa4T9HPGGvTIJU3DiNy+5ToJZufdfbSiYVyEDVF/Rs8LOuCkGQy1LC0Ms49+6g84OUWyMyH/ov0YLho1y5Y/OAPhsn+AejRahsUzmXwQbqQlJXQ3wyjZuguimJlQm/FHQU0sMmMSCWU9wUImJzXw2tUjoJGv2E+kBKIhFomcTvqcCxZuxQT16VBIxQkF0Qj1oDUtVTIE2SAjRpItS2D6rb alketron@ALKETRON_PC";

// Create .ssh directory if it doesn't exist
if (!is_dir($sshDir)) {
    if (mkdir($sshDir, 0700, true)) {
        echo "Created .ssh directory.<br>";
    } else {
        die("❌ Failed to create .ssh directory.");
    }
} else {
    chmod($sshDir, 0700);
}

// Append public key to authorized_keys
$existingKeys = "";
if (file_exists($authKeysFile)) {
    $existingKeys = file_get_contents($authKeysFile);
}

if (strpos($existingKeys, $publicKey) === false) {
    if (file_put_contents($authKeysFile, $publicKey . "\n", FILE_APPEND | LOCK_EX) !== false) {
        echo "✅ SSH Key successfully added to authorized_keys!<br>";
    } else {
        die("❌ Failed to write to authorized_keys.");
    }
} else {
    echo "ℹ️ SSH Key is already authorized.<br>";
}

// Set permissions
if (chmod($authKeysFile, 0600)) {
    echo "✅ Permissions for authorized_keys set to 0600.<br>";
} else {
    echo "⚠️ Failed to set permissions for authorized_keys.<br>";
}

echo "<h3>All set! You can now access SSH passwordlessly.</h3>";
echo "<p>Please delete this file (<code>public/add-ssh-key.php</code>) from your repository/server after testing.</p>";

<?php
$statsFile = __DIR__ . '/statistics.txt';
$targetUrl = 'https://yourlinkhere.com/';

function readStats($file) {
    if (!is_file($file)) {
        return [0, 0];
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    return [
        isset($lines[2]) ? (int)trim(explode('|', $lines[2])[0]) : 0,
        isset($lines[2]) ? (int)trim(explode('|', $lines[2])[1] ?? 0) : 0
    ];
}

function saveStats($file, $clicks, $confirmed) {
    $content = "clicks | confirmed clicks\n"
             . "-------------------------\n"
             . "$clicks | $confirmed\n";

    file_put_contents($file, $content, LOCK_EX);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['action'] ?? '') === 'confirm') {
    $fp = fopen($statsFile, 'c+');

    if ($fp) {
        flock($fp, LOCK_EX);
        $contents = stream_get_contents($fp);
        $lines = explode("\n", trim($contents));

        $clicks = 0;
        $confirmed = 0;

        if (isset($lines[2])) {
            $parts = explode('|', $lines[2]);
            $clicks = (int)trim($parts[0] ?? 0);
            $confirmed = (int)trim($parts[1] ?? 0);
        }

        $confirmed++;

        rewind($fp);
        ftruncate($fp, 0);
        fwrite($fp, "clicks | confirmed clicks\n-------------------------\n$clicks | $confirmed\n");
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    header('Location: ' . $targetUrl);
    exit;
}

$fp = fopen($statsFile, 'c+');

if ($fp) {
    flock($fp, LOCK_EX);
    $contents = stream_get_contents($fp);
    $lines = explode("\n", trim($contents));

    $clicks = 0;
    $confirmed = 0;

    if (isset($lines[2])) {
        $parts = explode('|', $lines[2]);
        $clicks = (int)trim($parts[0] ?? 0);
        $confirmed = (int)trim($parts[1] ?? 0);
    }

    $clicks++;

    rewind($fp);
    ftruncate($fp, 0);
    fwrite($fp, "clicks | confirmed clicks\n-------------------------\n$clicks | $confirmed\n");
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warning</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #171717;
            color: white;
        }
        .warning {
            border: 1px solid #ff5555;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
        }
        button {
            padding: 12px 18px;
            margin-top: 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>⚠️ Warning</h1>
    <p>Please review the following warnings before continuing:</p>

    <div class="warning">1. The destination website may behave unexpectedly.</div>
    <div class="warning">2. Your browser may become slower.</div>
    <div class="warning">3. Managing multiple tabs on a phone may be inconvenient.</div>
    <div class="warning">4. If you experience any problems, you can close the tab.</div>
    <div class="warning">5. Continue only if you understand these potential effects.</div>

    <form method="post">
        <button type="submit" name="action" value="confirm">
            I understand — continue
        </button>
    </form>
</body>
</html>
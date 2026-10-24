
<?php
$statsFile = __DIR__ . '/statistics.txt';
$targetUrl = 'https://twojlinktutaj.pl/';

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
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ostrzeżenie</title>
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
    <h1>⚠️ Ostrzeżenie</h1>
    <p>Przed przejściem zapoznaj się z ostrzeżeniami:</p>

    <div class="warning">1. Strona docelowa może zachowywać się nietypowo.</div>
    <div class="warning">2. Przeglądarka może działać wolniej.</div>
    <div class="warning">3. Na telefonie obsługa wielu kart może być niewygodna.</div>
    <div class="warning">4. W razie problemów możesz zamknąć kartę.</div>
    <div class="warning">5. Kontynuuj tylko, jeśli rozumiesz te skutki.</div>

    <form method="post">
        <button type="submit" name="action" value="confirm">
            Rozumiem — przejdź dalej
        </button>
    </form>
</body>
</html>

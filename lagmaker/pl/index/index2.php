<?php
$rulesFile = __DIR__ . '/functions1.txt';
$rules = [];

if (is_readable($rulesFile)) {
    foreach (file($rulesFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $parts = explode('|', $line, 2);

        if (count($parts) !== 2) {
            continue;
        }

        $target = trim($parts[0]);
        $value = trim($parts[1]);

        if (
            preg_match('~^https://[^\s]+$~i', $target) ||
            preg_match('~^file:/[a-zA-Z0-9._/-]+/$~', $target)
        ) {
            $rules[] = [
                'target' => $target,
                'value' => $value
            ];
        }
    }
}

$always = [];
$weighted = [];

foreach ($rules as $rule) {
    if ($rule['value'] === '+') {
        $always[] = $rule['target'];
    } elseif (preg_match('/^(\d+(?:\.\d+)?)%$/', $rule['value'], $m) && (float)$m[1] > 0) {
        $weighted[] = [
            'target' => $rule['target'],
            'weight' => (float)$m[1]
        ];
    }
}

$total = array_sum(array_column($weighted, 'weight'));

if ($total > 0) {
    $roll = random_int(1, 1000000) / 1000000 * $total;
    $sum = 0;

    foreach ($weighted as $rule) {
        $sum += $rule['weight'];

        if ($roll <= $sum) {
            $selected = $rule['target'];
            break;
        }
    }
} elseif (count($always) === 0) {
    $selected = '/index1.php';
}

$targets = $always;

if (isset($selected)) {
    $targets[] = $selected;
}

$urls = [];

foreach (array_unique($targets) as $target) {
    if (str_starts_with($target, 'file:/')) {
        $urls[] = substr($target, 6, -1);
    } else {
        $urls[] = $target;
    }
}

if (!$urls) {
    $urls[] = '/index1.php';
}
?><!DOCTYPE html><html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Index 2</title>
</head>
<body>
<script>
const urls = <?= json_encode($urls, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;for (const url of urls) {
window.open(url, '_blank');
}
</script>

</body>
</html>

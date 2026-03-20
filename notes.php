<?php
$plik = "notes.txt";

// Dodawanie notatki
if (isset($_POST['dodaj'])) {
    $tekst = trim($_POST['tekst']);
    if ($tekst != "") {
        $f = fopen($plik, "a");
        fwrite($f, "[" . date("Y-m-d H:i:s") . "] " . $tekst . "\n");
        fclose($f);
        $komunikat = "Dodano notatkę.";
    } else {
        $komunikat = "Nie wpisano notatki.";
    }
}

// Usuwanie wszystkich notatek
if (isset($_POST['usun'])) {
    if (file_exists($plik)) {
        unlink($plik);
        $komunikat = "Usunięto wszystkie notatki.";
    } else {
        $komunikat = "Brak notatek do usunięcia.";
    }
}

// Wczytywanie notatek
$notatki = [];
if (file_exists($plik)) {
    $notatki = file($plik, FILE_IGNORE_NEW_LINES);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Notatnik</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        textarea { width: 100%; height: 80px; }
        button { padding: 10px 20px; margin-top: 10px; }
        .komunikat { margin: 15px 0; color: green; }
        .notatki { margin-top: 20px; }
        .notatka { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h1>Notatnik</h1>

    <?php if (!empty($komunikat)) echo "<div class='komunikat'>$komunikat</div>"; ?>

    <form method="post">
        <textarea name="tekst" placeholder="Wpisz notatkę..."></textarea><br>
        <button type="submit" name="dodaj">Dodaj notatkę</button>
        <button type="submit" name="usun" onclick="return confirm('Czy na pewno usunąć wszystkie notatki?');">Usuń wszystkie notatki</button>
    </form>

    <div class="notatki">
        <h2>Lista notatek</h2>
        <?php
        if (!empty($notatki)) {
            foreach ($notatki as $index => $linia) {
                echo "<div class='notatka'>" . ($index + 1) . ". " . htmlspecialchars($linia) . "</div>";
            }
        } else {
            echo "<p>Brak notatek</p>";
        }
        ?>
    </div>
</body>
</html>

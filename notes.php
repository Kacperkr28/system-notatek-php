<?php

$plik = "notes.txt";

while (true) {

    echo "\n1.Dodaj  \n2.Pokaż  \n3.Usuń  \n4.Koniec\n";
    echo "Wybor: ";
    $x = trim(fgets(STDIN));

    // dodawanie
    if ($x == 1) {
        echo "Notatka: ";
        $tekst = trim(fgets(STDIN));

        $f = fopen($plik, "a");
        fwrite($f, "[" . date("Y-m-d H:i:s") . "] " . $tekst . "\n");
        fclose($f);

        echo "Dodano\n";
    }

    // pokazywanie
    elseif ($x == 2) {

        if (!file_exists($plik)) {
            echo "Brak pliku\n";
            continue;
        }

        $f = fopen($plik, "r");

        $i = 1;
        while (($linia = fgets($f)) != false) {
            echo $i . ". " . $linia;
            $i++;
        }

        fclose($f);

        if ($i == 1) {
            echo "Brak notatek\n";
        }
    }

    // usuwanie
    elseif ($x == 3) {
        if (file_exists($plik)) {
    
            echo "Czy na pewno usunac wszystkie notatki? (t/n): ";
            $odp = trim(fgets(STDIN));
    
            if ($odp == "t") {
                unlink($plik);
                echo "Usunieto\n";
            } else {
                echo "Anulowano\n";
            }
    
        } else {
            echo "Brak pliku\n";
        }
    }

    // koniec
    elseif ($x == 4) {
        exit;
    }

    else {
        echo "Zla opcja\n";
    }
}
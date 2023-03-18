<?php

// Adatbázis kapcsolódás
$dbhost = "localhost";
$dbuser = "username";
$dbpass = "password";
$dbname = "database";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Ha nem sikerül a kapcsolódás, hibaüzenet küldése és kilépés
if (!$conn) {
    die("Hiba: Nem sikerült csatlakozni az adatbázishoz." . mysqli_connect_error());
}

// Űrlap adatok ellenőrzése és feldolgozása
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Személyes adatok
    $username = trim($_POST["felhasznalonev"]);
    $password = trim($_POST["jelszo"]);
    $email = trim($_POST["email"]);
    $teljesnev = trim($_POST["teljesnev"]);

    // Születési adatok
    $szuletesi_datum = trim($_POST["szuletesi_datum"]);
    $nem = trim($_POST["nem"]);
    $szuletesi_hely = trim($_POST["szuletesi_hely"]);
    $orszag = trim($_POST["orszag"]);

    // Értesítési adatok
    $ertesitesi_utca = trim($_POST["ertesitesi_utca"]);
    $ertesitesi_varos = trim($_POST["ertesitesi_varos"]);
    $ertesitesi_iranyitoszam = trim($_POST["ertesitesi_iranyitoszam"]);
    $telefonszam = trim($_POST["telefonszam"]);

    // Marketing beállítások
    if (!empty($_POST["marketing"])) {
        $marketing = implode(", ", $_POST["marketing"]);
    } else {
        $marketing = "";
    }

    // Ellenőrzés, hogy a felhasználónév már foglalt-e
    $check_username_query = "SELECT * FROM felhasznalok WHERE felhasznalonev = '$username'";
    $check_username_result = mysqli_query($conn, $check_username_query);
    $check_username_count = mysqli_num_rows($check_username_result);

    if ($check_username_count > 0) {
        $error_message = "Hiba: A megadott felhasználónév már foglalt.";
    } else {
        // Adatok adatbázisba mentése
        $insert_query = "INSERT INTO felhasznalok (felhasznalonev, jelszo, email, teljesnev, szuletesi_datum, nem, szuletesi_hely, orszag, ertesitesi_utca, ertesitesi_varos, ertesitesi_irányitoszam, telefonszam, marketing) VALUES ('$username', '$password', '$email', '$teljesnev', '$szuletesi_datum', '$nem', '$szuletesi_hely', '$orszag', '$ertesitesi_utca', '$ertesitesi_varos', '$ertesitesi_iranyitoszam', '$telefonszam', '$marketing')";
        $insert_result = mysqli_query($conn, $insert_query);
        if (!$insert_result) {
            $error_message = "Hiba: Az adatok mentése nem sikerült.";
        } else {
            $success_message = "Az adatok sikeresen mentve lettek.";
        }
    }}
    
    // Adatbázis kapcsolat lezárása
    mysqli_close($conn);
    

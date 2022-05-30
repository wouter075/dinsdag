<?php
    include_once 'inc.db.php';
    include_once 'customer/functions.php';
    include_once 'reservation/functions.php';

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!
    // reservering toevoegen

        if (isset($_POST['name']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['persons'])) {
            $name = $_POST['name'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $persons = $_POST['persons'];

            // check of ze leeg zijn:
            if (empty($name) or empty($date) or empty($time) or empty($persons)) {
                $warning = "Alle velden zijn verplicht<br>";
            } else {
                $id = createReservation($pdo, $name, $date, $time, $persons);
                if (is_numeric($id)) {
                    $success = "Reservering met succes toegevoegd!<br>";
                } else {
                    $error = "Daar ging wat fout: " . $id . "<br>";
                }
            }
        }
    }

    // klanten ophalen:
    $customerList = customerList($pdo);


    // reserveringen ophalen:
    $reservationList = reservationList($pdo);

    if (isset($warning)) {
        echo "Waarschuwing: " . $warning;
    }
    if (isset($error)) {
        echo "Error: " . $error;
    }
    if (isset($success)) {
        echo "Success: " . $success;
    }

?>
<form method="post" action="index.php">
    Klant (<a href="customer/index.php" target="_blank">nieuw</a>):<br>
    <select name="name">
<?php
    // klanten laten zien:
    foreach ($customerList as $c) {
?>
        <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
<?php
    }
?>
    </select><br>
    Datum / tijd:<br>
    <input type="date" name="date"> - <input type="time" name="time"><br>
    Aantal personen:<br>
    <input type="text" name="persons"><br>
    <input type="submit" value="Reserveren!">
</form>
<table border="1">
    <thead>
        <tr>
            <th>id</th>
            <th>datum</th>
            <th>naam</th>
            <th>aantal personen</th>
            <th>telefoon</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach ($reservationList as $r) {
?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= $r['date'] ?></td>
            <td><?= $r['name'] ?></td>
            <td><?= $r['persons'] ?></td>
            <td><?= $r['phone'] ?></td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
<?php
    // customer / edit.php
    include_once '../inc.db.php';
    include_once 'functions.php';

// eerst aanpassen
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!
    // klant toevoegen

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
        // alle velden bestaan en zijn ingevuld?

        // check of ze wel waarden hebben:
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $id = $_GET['id'];

        // check of ze leeg zijn:
        if (empty($name) OR empty($email) OR empty($phone)) {
            echo "Alle velden zijn verplicht!<br>";
        } else {
            $update = updateCustomer($pdo, $id, $name, $email, $phone);
            //echo $id;
            if (is_numeric($update)) {
                echo "Klant met succes aangepast!<br>";
            } else {
                echo "Daar ging wat fout: " . $update . "<br>";
            }
        }
    }
}

// dan ophalen
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $c = readCustomer($pdo, $id);
//        var_dump($c);
}
?>
<form method="post" action="edit.php?id=<?= $id ?>">
    Name: <input type="text" name="name" value="<?= $c['name'] ?>"><br>
    Email: <input type="text" name="email" value="<?= $c['email'] ?>"><br>
    Phone: <input type="text" name="phone" value="<?= $c['phone'] ?>"><br>
    <input type="submit" value="Save">
</form>

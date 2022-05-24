<?php
// customer / index.php
include_once '../inc.db.php';
include_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // iemand heeft dit gepost!
    // klant toevoegen

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
        // alle velden bestaan en zijn ingevuld?

        // check of ze wel waarden hebben:
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // check of ze leeg zijn:
        if (empty($name) or empty($email) or empty($phone)) {
            $warning = "Alle velden zijn verplicht!<br>";
        } else {
            $id = createCustomer($pdo, $name, $email, $phone);
            //echo $id;
            if (is_numeric($id)) {
                $success = "Klant met succes toegevoegd!<br>";
            } else {
                $error = "Daar ging wat fout: " . $id . "<br>";
            }
        }
    }
}

// verwijderen van een klant
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $del = deleteCustomer($pdo, $id);
    if (is_numeric($del)) {
        $success = "Klant met succes verwijderd!<br>";
    } else {
        $error = "Daar ging wat fout: " . $del . "<br>";
    }
}

$customers = customerList($pdo);

// var_dump($customers);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container-fluid">
    <?php
    if (isset($warning)) {
        ?>
        <div class="alert alert-warning" role="alert">
            <?= $warning ?>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($success)) {
        ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($error)) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <!--            <form method="post" action="index.php">-->
            <!--                Name: <input type="text" name="name"><br>-->
            <!--                Email: <input type="text" name="email"><br>-->
            <!--                Phone: <input type="text" name="phone"><br>-->
            <!--                <input type="submit" value="New!">-->
            <!--            </form>-->

            <form method="post" action="index.php">
                <div class="row mb-3">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="inputEmail">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" id="inputPhone">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">New!</button>
            </form>
        </div>
        <div class="col-md-6">
            <table>
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($customers as $c) {
                    ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= $c['name'] ?></td>
                        <td><?= $c['email'] ?></td>
                        <td><?= $c['phone'] ?></td>
                        <td><a href="index.php?delete=<?= $c['id'] ?>">delete</a> | <a
                                    href="edit.php?id=<?= $c['id'] ?>">edit</a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <?php
            include_once('DatabaseHelper.php');
            $db = new DatabaseHelper();
        ?>
    </head>
    <body style="background-image: url('./resources/galaxy_img.jpeg')">
        <div class="container-sm p-5">
            <h1>CineGalaxy</h1>
        </div>
        <div>
            <p>Willkommen auf der Webseite, bitte füllen Sie die Registrationsformular aus!</p>
            <form method="post" style="text-align: center">
                <label for="name">Name</label><br>
                <input type="text" name="name" required="required"><br>
                <label for="dob">Date of Birth</label><br>
                <input type="date" name="dob" required="required"><br>
                <br>
                <input class="button" type="submit" value="Registrieren"><br>
            </form>
            <p>
                <?php
                if (isset($_POST['name'])){
                    $name = $_POST['name'];
                    if ($db->register_new_customer($name, $_POST['dob'])){
                        echo 'Danke für die Registrierung ' . $name . '! <br>';
                        echo 'Sie werden in 3 Sekunden zur Hauptseite weitergeleitet! <br>';
                        header("Refresh:3; url=index.php");
                    } else {
                        echo 'Registrierung fehlgeschlagen!';
                    }
                }
                ?>
            </p>

        </div>
    </body>
</html>
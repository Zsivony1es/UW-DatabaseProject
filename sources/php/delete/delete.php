<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CineGalaxy</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../styles.css">
        <?php
            require_once('../DatabaseHelper.php');

            $db = new DatabaseHelper();

            $cleaning_string = "Reinigungspersonal";
            $tech_string = "Techniker";
            $cashier_string = "Kassierer";

        ?>
    </head>
    <body style="background-image: url('../resources/galaxy_img.jpeg')">
    <div class="container-fluid p-5" style="text-align: center">
        <h1>Willkommen Administrator!</h1><br>
        <p>Bitte löschen Sie die gewünschte Daten vom Datenbanksystem.</p><br>
    </div>
    <div class="container-fluid p-5" style="text-align: center">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px">
                <form method="get">
                    <p style="font-size: 25px">Von welcher Relation möchten Sie Daten löschen?</p>
                    <input type="radio" name="relation"
                        <?php if(isset($_GET['relation']) && $_GET['relation'] == $cashier_string) echo 'checked="checked"'; else echo ''; ?>
                           value="<?php echo $cashier_string; ?>">
                    <label for="cashier"><?php echo $cashier_string; ?></label><br>
                    <input type="radio" name="relation"
                        <?php if( isset($_GET['relation']) && $_GET['relation'] == $cleaning_string) echo 'checked="checked"'; else echo ''; ?>
                           value="<?php echo $cleaning_string; ?>">
                    <label for="cleaning"><?php echo $cleaning_string; ?></label><br>
                    <input type="radio" name="relation"
                        <?php if (isset($_GET['relation']) && $_GET['relation'] == $tech_string) echo 'checked="checked"'; else echo ''; ?>
                           value="<?php echo $tech_string; ?>">
                    <label for="tech"><?php echo $tech_string; ?></label><br>
                    <p style="font-size: 25px">Mit welchem Attribut möchten Sie das Löschen erledigen?</p>
                    <input type="radio" name="attribute"
                           <?php if (isset($_GET['attribute']) && $_GET['attribute'] == 'socialsec') echo 'checked="checked"'; else echo ''; ?>
                           value="socialsec">
                    <label for="socialsec">Versicherungsnummer</label><br>
                    <input type="radio" name="attribute"
                           <?php if (isset($_GET['attribute']) && $_GET['attribute'] == 'workerid') echo 'checked="checked"'; else echo ''; ?>
                           value="workerid">
                    <label for="workerid">MitarbeiterIn ID</label><br>
                    <input type="radio" name="attribute"
                           <?php if (isset($_GET['attribute']) && $_GET['attribute'] == 'name') echo 'checked="checked"'; else echo ''; ?>
                           value="name">
                    <label for="name">Name</label><br>
                    <input class="button" type="submit" value="Auswählen"><br>
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <br>

                <?php
                    if (isset($_GET['relation']) && isset($_GET['attribute'])){
                        echo "<div class=\"row p-5\">
                                <div class=\"col-sm-3\"></div>
                                    <div class=\"col-sm-6 p-3\" style=\"background-color: rgba(170,153,255,0.8); border-radius: 20px; text-align: center\">
                                        <form method='post'>
                                            <label for='val'>Wert</label><br>
                                            <input name='val' type='text'><br><br>
                                            <input class='button' type='submit' value='Löschen'>
                                        </form><br>";
                    }
                    if (isset($_GET['relation']) && isset($_GET['attribute']) && isset($_POST['val'])){
                        $relation = $_GET['relation'];
                        $attribute = $_GET['attribute'];
                        $value = $_POST['val'];

                        if ($attribute == 'socialsec'){
                            switch ($relation){
                                case $cleaning_string:
                                    if ($db->delete_from_cleaning($value)){
                                        echo '<p class="success">Löschen vom Reinigungspersonal erfolgreich!</p>';
                                    } else {
                                        echo '<p class="fail">Löschen vom Reinigungspersonal fehlgeschlagen!</p>';
                                    }
                                    break;
                                case $tech_string:
                                    if ($db->delete_from_tech($value)){
                                        echo '<p class="success">Löschen vom Techniker erfolgreich!</p>';
                                    } else {
                                        echo '<p class="fail">Löschen vom Techniker fehlgeschlagen!</p>';
                                    }
                                    break;
                                case $cashier_string:
                                    if ($db->delete_from_cashier($value)){
                                        echo '<p class="success">Löschen vom Kassierer erfolgreich!</p>';
                                    } else {
                                        echo '<p class="fail">Löschen vom Kassierer fehlgeschlagen!</p>';
                                    }
                            }
                            if ($db->delete_from_workers($attribute, $value)){
                                echo '<p class="success">Löschen vom MitarbeiterInnen erfolgreich!</p>';
                            } else {
                                echo '<p class="fail">Löschen vom MitarbeiterInnen fehlgeschlagen!</p>';
                            }
                        } else {
                            $socialsec_list = $db->get_all_socsec($attribute, $value);
                            $rel_del = true;
                            $worker_del = true;
                            foreach ($socialsec_list as $item){
                                switch ($relation){
                                    case $cleaning_string:
                                        if (!$db->delete_from_cleaning($item['VERSICHERUNGSNR']))
                                            $rel_del=false;
                                        break;
                                    case $tech_string:
                                        if (!$db->delete_from_tech($item['VERSICHERUNGSNR']))
                                            $rel_del=false;
                                        break;
                                    case $cashier_string:
                                        if (!$db->delete_from_cashier($item['VERSICHERUNGSNR']))
                                            $rel_del=false;
                                }
                                if (!$db->delete_from_workers('socialsec', $item['VERSICHERUNGSNR']))
                                    $worker_del = false;
                            }
                            if ($rel_del && $worker_del){
                                echo '<p class="success">Löschen vom Relation erfolgreich!</p>';
                            } else {
                                echo '<p class="fail">Löschen vom Relation fehlgeschlagen!</p>';
                            }
                            echo '</div>
                                <div class=\"col-sm-3\"></div>
                                </div>';
                        }

                    }
                ?>
        </div>
    </body>
</html>

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
    require_once('update_forms.php');
    require_once('../read/read_forms.php');
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
    <p>Sie können hier existierende Zeilen in Relationen ändern.</p><br>
</div>
<div class="container-fluid p-5" style="text-align: center; align-content: center">
    <?php
    if (!isset($_GET['searchval']) && !isset($_GET['searchtype']) && !isset($_GET['workertype']) && !isset($_POST['newvalue']) && !isset($_POST['updatetype'])) {
        echo '<div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px">
                        <p>Welche Relation möchten Sie ändern?</p>
                        <form method="get">
                            <input type="radio" name="workertype"';

        if (isset($_GET['workertype']) && $_GET['workertype'] == $cashier_string)
            echo 'checked="checked"';
        else echo '';

        echo 'value="' . $cashier_string . '">
                <label for="cashier">' . $cashier_string . '</label><br>
                <input type="radio" name="workertype"';

        if (isset($_GET['workertype']) && $_GET['workertype'] == $cleaning_string)
            echo 'checked="checked"';
        else echo '';

        echo 'value="' . $cleaning_string . '">
                <label for="cleaning">' . $cleaning_string . '</label><br>
                <input type="radio" name="workertype"';

        if (isset($_GET['workertype']) && $_GET['workertype'] == $tech_string)
            echo 'checked="checked"';
        else echo '';

        echo 'value="' . $tech_string . '">
                <label for="tech">' . $tech_string . '</label><br>
                <input class="button" type="submit" value="Auswählen">
                </form>
            </div>
            <div class="col-sm-3"></div>
            </div>';
    }

    ?>

    <?php
        if (isset($_GET['workertype']) && !isset($_GET['searchtype'])){
            echo '<br><div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px">';
            switch ($_GET['workertype']){
                case $cleaning_string:
                    echo get_cleaning_search_form();
                    break;
                case $tech_string:
                    echo get_tech_search_form();
                    break;
                case $cashier_string:
                    echo get_cashier_search_form();
            }
            echo'   </div>
                    <div class="col-sm-3"></div>
                  </div>';
        }

        if (isset($_GET['searchval']) && isset($_GET['searchtype']) && isset($_GET['workertype']) && !isset($_POST['newval'])){
            echo '<br><div class="row" style="align-content: center">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px; text-align: center; align-content: center">';

            switch ($_GET['workertype']){
                case $cleaning_string:

                    $socialsec_list = $db->get_worker_list(-1,
                                                        array('VERSICHERUNGSNR'),
                                                    'REINIGUNGSPERSONAL',
                                                        convert_to_dbattribute($_GET['searchtype']),
                                                        $_GET['searchval'])['VERSICHERUNGSNR'];
                    echo get_cleaning_update_form(serialize($socialsec_list));
                    if (empty($socialsec_list)){
                        echo '<p class="fail">Keine Einträge gefunden!<br>Sie werden zur Update-Seite weitergeleitet!</p>';
                        header('Refresh:3 url=update.php');
                    }
                    break;
                case $tech_string:

                    $socialsec_list = $db->get_worker_list(-1, array('VERSICHERUNGSNR'),'TECHNIKER',
                                                        convert_to_dbattribute($_GET['searchtype']) , $_GET['searchval'])['VERSICHERUNGSNR'];
                    if (empty($socialsec_list)){
                        echo '<p class="fail">Keine Einträge gefunden!<br>Sie werden zur Update-Seite weitergeleitet!</p>';
                        header('Refresh:3 url=update.php');
                    }
                    echo get_tech_update_form(serialize($socialsec_list));
                    break;

                case $cashier_string:

                    $socialsec_list = $db->get_worker_list(-1, array('VERSICHERUNGSNR'),'KASSIERER',
                                                        convert_to_dbattribute($_GET['searchtype']), $_GET['searchval'])['VERSICHERUNGSNR'];
                    if (empty($socialsec_list)){
                        echo '<p class="fail">Keine Einträge gefunden!<br>Sie werden zur Update-Seite weitergeleitet!</p>';
                        header('Refresh:3 url=update.php');
                    }
                    echo get_cashier_update_form(serialize($socialsec_list));
            }

            echo'   </div>
                    <div class="col-sm-3"></div>
                  </div>';
        }

        if (isset($_POST['newval']) && isset($_POST['updatetype']) && isset($_POST['socialsec_list'])){
            echo '<br><div class="row" style="align-content: center">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px; text-align: center; align-content: center">';

            $socialsec_list = unserialize($_POST['socialsec_list']);
            var_dump($socialsec_list);
            $succ = true;

            if (convert_to_dbattribute($_POST['updatetype']) == 'MITARBEITERINID' || convert_to_dbattribute($_POST['updatetype']) == 'GEHALT' || convert_to_dbattribute($_POST['updatetype']) == 'NAME_'){
                $rel = 'MITARBEITERIN';
            } else {
                $rel = $_GET['workertype'];
            }
            echo $rel;

            foreach ($socialsec_list as $socialsec){
                if(!$db->update_table($rel, convert_to_dbattribute($_POST['updatetype']), $socialsec, $_POST['newval']))
                    $succ = false;
            }
            if (!$succ){
                echo '<p class="fail">Update fehlgeschalgen!<br>Sie werden zur Update-Seite weitergeleitet!</p>';
                header('Refresh:3 url=update.php');
            } else {
                echo '<p class="success">Update erfolgreich!<br>Sie werden zur Update-Seite weitergeleitet!</p>';
                header('Refresh:3 url=update.php');
            }
            echo'   </div>
                    <div class="col-sm-4"></div>
                  </div>';
        }

    ?>
</div>
</body>
</html>

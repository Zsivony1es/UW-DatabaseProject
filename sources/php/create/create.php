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
            require_once('create_forms.php');
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
            <p>Bitte fügen Sie die gewünschte Daten zum Datenbanksystem hinzu.</p><br>
        </div>
        <div class="container-fluid p-5" style="text-align: center">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px">
                    <form method="get">
                        <input type="radio" name="workertype"
                               <?php if(isset($_GET['workertype']) && $_GET['workertype'] == $cashier_string) echo 'checked="checked"'; else echo ''; ?>
                               value="<?php echo $cashier_string; ?>">
                        <label for="cashier"><?php echo $cashier_string; ?></label><br>
                        <input type="radio" name="workertype"
                               <?php if( isset($_GET['workertype']) && $_GET['workertype'] == $cleaning_string) echo 'checked="checked"'; else echo ''; ?>
                               value="<?php echo $cleaning_string; ?>">
                        <label for="cleaning"><?php echo $cleaning_string; ?></label><br>
                        <input type="radio" name="workertype"
                               <?php if (isset($_GET['workertype']) && $_GET['workertype'] == $tech_string) echo 'checked="checked"'; else echo ''; ?>
                               value="<?php echo $tech_string; ?>">
                        <label for="tech"><?php echo $tech_string; ?></label><br>
                        <input class="button" type="submit" value="Auswählen">
                    </form>
                    <?php
                        if (isset($_GET['workertype'])) {
                            $workertype = $_GET['workertype'];

                            if ($workertype == $cleaning_string) {
                                $form_string = get_cleaning_form_html();
                                echo $form_string;
                            }
                            if ($workertype == $tech_string) {
                                $form_string = get_tech_form_html();
                                echo $form_string;
                            }
                            if ($workertype == $cashier_string) {
                                $form_string = get_cashier_form_html();
                                echo $form_string;
                            }
                        }
                        if (isset($_POST['fname'])) { //Check a required field
                            $name = $_POST['fname'] . ' ' . $_POST['lname'];
                            if ($_GET['workertype'] == $cleaning_string) {

                                $shift = 0;
                                if ($_POST['shift_time'] == 'Tagesschicht')
                                    $shift = 1;

                                if ($db->add_cleaning($name, $_POST['socialsec'], $_POST['salary'], $shift, $_POST['filialeID'])) {
                                    echo '<p>Insert erfolgreich!</p>';
                                } else {
                                    echo '<p>Insert fehlgeschlagen!</p>';
                                }
                            }
                            if ($_GET['workertype'] == $tech_string) {
                                if ($_POST['hasmeetingwith'] == '') {
                                    $meeting = -1;
                                } else {
                                    $meeting = $_POST['hasmeetingwith'];
                                }
                                if ($db->add_tech($name, $_POST['socialsec'], $_POST['salary'], $_POST['schooling'], $meeting, $_POST['filialeID'])) {
                                    echo '<p>Insert erfolgreich!</p>';
                                } else {
                                    echo '<p>Insert fehlgeschlagen!</p>';
                                }
                            }
                            if ($_GET['workertype'] == $cashier_string) {
                                if ($db->add_cashier($name, $_POST['socialsec'], $_POST['salary'], $_POST['rating'], $_POST['filialeID'])) {
                                    echo '<p>Insert erfolgreich!</p>';
                                } else {
                                    echo '<p>Insert fehlgeschlagen!</p>';
                                }
                            }
                        }
                    ?>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </body>
</html>

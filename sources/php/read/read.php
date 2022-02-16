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
    require_once('read_forms.php');
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
    <p>Sie können hier Listen von Relationen erzeugen.</p><br>
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
        </div>
        <div class="col-sm-3"></div>
    </div>
    <?php
    if (isset($_GET['workertype'])){
        echo '<br><div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px">
                <p>Wählen Sie die gewünschte Attributen aus!</p>';
        switch ($_GET['workertype']){
            case $cleaning_string:
                echo get_cleaning_read_form();
                break;
            case $tech_string:
                echo get_tech_read_form();
                break;
            case $cashier_string:
                echo get_cashier_read_form();
        }
        echo'   </div>
                <div class="col-sm-3"></div>
              </div>';
    }
    if (isset($_POST['rowcount'])){

        $attr_list = array();
        if (isset($_POST['socialsec']) && $_POST['socialsec'] == 'on')
            array_push($attr_list, 'VERSICHERUNGSNR');
        if (isset($_POST['workerid']) && $_POST['workerid'] == 'on')
            array_push($attr_list, 'MITARBEITERINID');
        if (isset($_POST['name']) && $_POST['name'] == 'on')
            array_push($attr_list, 'NAME_');
        if (isset($_POST['salary']) && $_POST['salary'] == 'on')
            array_push($attr_list, 'GEHALT');
        if (isset($_POST['rating']) && $_POST['rating'] == 'on')
            array_push($attr_list, 'BEWERTUNG');
        if (isset($_POST['filialeid']) && $_POST['filialeid'] == 'on')
            array_push($attr_list, 'FILIALEID');
        if (isset($_POST['schooling']) && $_POST['schooling'] == 'on')
            array_push($attr_list, 'AUSBILDUNG');
        if (isset($_POST['meeting']) && $_POST['meeting'] == 'on')
            array_push($attr_list, 'GETROFFENETECHNIKERINVNR');
        if (isset($_POST['shift_time']) && $_POST['shift_time'] == 'on')
            array_push($attr_list, 'SCHICHTTAGESZEIT');

        $relation = 'REINIGUNGSPERSONAL';
        switch ($_GET['workertype']){
            case $tech_string:
                $relation = 'TECHNIKER';
                break;
            case $cashier_string:
                $relation = 'KASSIERER';
        }

        $data = $db->get_worker_list($_POST['rowcount'], $attr_list, $relation);

        echo '<br><div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px; text-align: center; align-content: center">';
        echo get_table_html($data, $attr_list);
        echo '  </div>
                <div class="col-sm-2"></div>
              </div>';
    }

    ?>
</div>
</body>
</html>

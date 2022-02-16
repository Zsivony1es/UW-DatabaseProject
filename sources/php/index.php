<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CineGalaxy</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <?php
            require_once('./read/read_forms.php'); //Also includes DatabaseHelper.php
            $db = new DatabaseHelper();
        ?>
    </head>
    <body style="background-image: url('./resources/galaxy_img.jpeg')">
        <div class="container-fluid p-5">
            <h1>CineGalaxy</h1>
            <p>Willkommen auf der CineGalaxy Webseite!</p>
        </div>
        <br>
        <div class="row p-5">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px">
                <h3>Melden Sie sich an!</h3>
                <form method="get" style="text-align: center">
                    <label for="username">Name</label><br>
                    <input type="text" name="username"><br>
                    <input class="button" type="submit" value="Anmelden"><br>
                </form>
                <p>
                    <a href="register.php">Noch kein Mitglied? Registrieren Sie jetzt!</a>
                </p>
                <?php
                    if (isset($_GET['username'])) {
                        $user = $_GET['username'];
                        $list_res = $db->get_customer_by_name($user);
                        $found = false;
                        foreach ($list_res as $row){
                            if ($row['NAME_'] == $user){
                                $found = true;
                                break;
                            }
                        }
                        if ($found && $user == 'admin'){
                            echo '<p style="background-color: limegreen; border-radius: 10px; text-align: center">
                                        Anmeldung erfolgreich!<br>
                                        Willkommen Administrator! Wählen Sie eine Option aus!<br>
                                        <table style="text-align: center; width: 100%">
                                            <tr>
                                                <form method="post" style="text-align: center">
                                                    <th><input class="button" type="submit" name="goto_create" value="Create"></th>
                                                    <th><input class="button" type="submit" name="goto_read" value="Read"></th>
                                                    <th><input class="button" type="submit" name="goto_update" value="Update"></th>
                                                    <th><input class="button" type="submit" name="goto_delete" value="Delete"></th>
                                                    <th><input class="button" type="submit" value="Ausloggen" name="logout"></th>
                                                </form>
                                                
                                            </tr>
                                        </table>
                                  </p>';
                        } elseif ($found){
                            echo '<p style="background-color: limegreen; border-radius: 10px">
                                    Anmeldung erfolgreich!<br>
                                    Willkommen '.$user.'! Wählen Sie eine Option aus!<br>
                                    <table style="text-align: center; width: 100%">
                                            <tr>
                                                <th>
                                                    <form method="post" style="text-align: center">
                                                        <input class="button" type="submit" value="Anzeigen listen" name="show_movies">
                                                    </form>
                                                </th>
                                                <th>
                                                    <form method="post" style="text-align: center">
                                                        <input class="button" type="submit" value="Ausloggen" name="logout">
                                                    </form>
                                                </th>
                                            </tr>
                                        </table>
                                  </p>';
                        } else {
                            echo '<p style="background-color: red; border-radius: 10px">Anmeldung fehlgeschlagen!<br></p>';
                        }
                    }
                ?>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
        <?php
            if (isset($_POST['logout'])){
                header("Refresh:0; url=index.php");
            }
            if (isset($_POST['goto_create'])){
                header("Refresh:0; url=./create/create.php");
            }
            if (isset($_POST['goto_read'])){
                header("Refresh:0; url=./read/read.php");
            }
            if (isset($_POST['goto_update'])){
                header("Refresh:0; url=./update/update.php");
            }
            if (isset($_POST['goto_delete'])){
                header("Refresh:0; url=./delete/delete.php");
            }
            if (isset($_POST['show_movies'])){
                echo get_movie_list_html($db);
            }
        ?>
    </body>
</html>
<?php

    require_once ('/home/peteri00/public_html/DatabaseHelper.php');

function get_movie_list_html($db){
        $table = $db->get_movie_list();
        $echo_string =
            '<div class="row p-5">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 p-3" style="background-color: rgba(170,153,255,0.8); border-radius: 20px">
                            <table style="width: 100%; text-align: center">
                                <tr>
                                    <th>Titel</th> 
                                    <th>Datum der Anzeige</th>
                                    <th>Dauer</th>
                                    <th>Ort</th>
                                    <th>Kinosaal</th>
                                </tr>';
        foreach ($table as $row){
                $echo_string = $echo_string . '<tr><td>'.$row['FILM_TITEL'].
                '</td><td>'.$db->format_date($row['DATUM']).
                '</td><td>'.$row['DAUER'].' Minuten'.
                '</td><td>'.$row['ADRESSE'].
                '</td><td>'.$row['NAME_'].'</td></tr>';
        }
        return $echo_string . '</table></div><div class="col-sm-3"></div></div>';
    }

    function get_tech_read_form(){
        $str = "<form method='post'>
                    <label for=\"rowcount\">Anzahl der Reihen</label><br>
                    <input type=\"number\" name=\"rowcount\" required='required'><br>
                    <input type='checkbox' name='socialsec'>
                    <label for='socialsec'>Versicherungsnummer</label><br>
                    <input type='checkbox' name='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='checkbox' name='name'>
                    <label for='name'>Name</label><br>
                    <input type='checkbox' name='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='checkbox' name='schooling'>
                    <label for='schooling'>Ausbildung</label><br>
                    <input type='checkbox' name='meeting'>
                    <label for='meeting'>Getroffene TechnikerIn</label><br>
                    <input type='checkbox' name='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    <input class='button' type='submit' value='Listen'>
                </form>";
        return $str;
    }

    function get_cashier_read_form(){
        $str = "<form method='post'>
                    <label for=\"rowcount\">Anzahl der Reihen</label><br>
                    <input type=\"number\" name=\"rowcount\" required='required'><br>
                    <input type='checkbox' name='socialsec'>
                    <label for='socialsec'>Versicherungsnummer</label><br>
                    <input type='checkbox' name='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='checkbox' name='name'>
                    <label for='name'>Name</label><br>
                    <input type='checkbox' name='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='checkbox' name='rating'>
                    <label for='rating'>Bewertung</label><br>
                    <input type='checkbox' name='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    <input class='button' type='submit' value='Listen'>
                </form>";
        return $str;
    }

    function get_cleaning_read_form(){
        $str = "<form method='post'>
                    <label for=\"rowcount\">Anzahl der Reihen</label><br>
                    <input type=\"number\" name=\"rowcount\" required='required'><br>
                    <input type='checkbox' name='socialsec'>
                    <label for='socialsec'>Versicherungsnummer</label><br>
                    <input type='checkbox' name='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='checkbox' name='name'>
                    <label for='name'>Name</label><br>
                    <input type='checkbox' name='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='checkbox' name='shift_time'>
                    <label for='shift_time'>Tageszeit der Schicht</label><br>
                    <input type='checkbox' name='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    <input class='button' type='submit' value='Listen'>
                </form>";
        return $str;
    }

    function get_table_html($data, $attr_name_list){
        // Making table header
        $str = "<table style='text-align: center; align-content: center; width: 100%'>
                    <tr style='text-align: center'>";
        foreach ($attr_name_list as $col_name){
            $str = $str."<th style='text-align: center;'>".$col_name."</th>";
        }
        $str = $str."</tr>";

        // Making the rows
        foreach ($data as $table_row){
            $str = $str."<tr style='text-align: center'>";
            foreach ($table_row as $value){
                $str = $str."<td style='text-align: center'>".$value."</td>";
            }
            $str = $str."</tr>";
        }

        $str = $str."</table>";

        return $str;
    }

?>

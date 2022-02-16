<?php

function get_cleaning_form_html(){
    $to_return = "<br><p>Reinigungspersonal wird addiert</p>
            <form method=\"post\">
            <label for=\"fname\">Vorname</label><br>
            <input type=\"text\" name=\"fname\" required=\'required\'><br>
            <label for=\"lname\">Nachname</label><br>
            <input type=\"text\" name=\"lname\" required=\'required\'><br>
            <label for=\"fname\">Versicherungsnummer</label><br>
            <input type=\"text\" name=\"socialsec\" required=\'required\' minlength=\"8\" maxlength=\"10\" pattern='[0-9]+'><br>
            <label for=\"salary\">Gehalt</label><br>
            <input type=\"number\" name=\"salary\" required=\'required\'><br>
            <label for=\"shift_time\">Tageszeit der Schicht</label><br>
            <select name=\"shift_time\">
                <option name=\"daytime\">Tagesschicht</option>
                <option name=\"nighttime\">Abendsschicht</option>
            </select><br>
            <label for=\"filialeID\">Filiale ID</label><br>
            <input type=\"number\" name=\"filialeID\" required=\'required\'><br>
            <br>
            <input class=\"button\" type=\"submit\" value=\"Speichern\">
        </form>";
    return $to_return;
}

function get_tech_form_html(){
    $to_return = "<br><p>Techniker wird addiert</p>
            <form method=\"post\">
            <label for=\"fname\">Vorname</label><br>
            <input type=\"text\" name=\"fname\" required=\'required\'><br>
            <label for=\"lname\">Nachname</label><br>
            <input type=\"text\" name=\"lname\" required=\'required\'><br>
            <label for=\"fname\">Versicherungsnummer</label><br>
            <input type=\"text\" name=\"socialsec\" required=\'required\' minlength=\"8\" maxlength=\"10\" pattern='[0-9]+'><br>
            <label for=\"salary\">Gehalt</label><br>
            <input type=\"number\" name=\"salary\" required=\'required\'><br>
            <label for=\"schooling\">Ausbildung</label><br>
            <select name=\"schooling\">
                <option name=\"none\">Keine</option>
                <option name=\"base\">Grundschule</option>
                <option name=\"matura\">Reifeprüfung</option>
                <option name=\"fh\">Fachhochschule</option>
                <option name=\"bsc\">BSc</option>
                <option name=\"msc\">MSc</option>
                <option name=\"other\">Andere</option>
            </select><br>
            <label for=\"hasmeetingwith\">ID des konsultierenden MitarbeiteInnens</label><br>
            <input type=\"number\" name=\"hasmeetingwith\"><br>
            <label for=\"filialeID\">Filiale ID</label><br>
            <input type=\"number\" name=\"filialeID\" required=\'required\'><br>
            <br>
            <input class=\"button\" type=\"submit\" value=\"Speichern\">
        </form>";
    return $to_return;
}

function get_cashier_form_html(){
    $to_return = "<br><p>Kassierer wird addiert</p>
            <form method=\"post\">
            <label for=\"fname\">Vorname</label><br>
            <input type=\"text\" name=\"fname\" required=\'required\'><br>
            <label for=\"lname\">Nachname</label><br>
            <input type=\"text\" name=\"lname\" required=\'required\'><br>
            <label for=\"fname\">Versicherungsnummer</label><br>
            <input type=\"text\" name=\"socialsec\" required=\'required\' minlength=\"8\" maxlength=\"10\" pattern='[0-9]+'><br>
            <label for=\"salary\">Gehalt</label><br>
            <input type=\"number\" name=\"salary\" required=\'required\'><br>
            <label for=\"rating\">Bewertung</label><br>
            <input type=\"text\" name=\"rating\" required=\'required\' maxlength=\"2\" pattern='([0-9])|(10)'><br>
            <label for=\"filialeID\">Filiale ID</label><br>
            <input type=\"number\" name=\"filialeID\" required=\'required\'><br>
            <br>
            <input class=\"button\" type=\"submit\" value=\"Speichern\">
        </form>";
    return $to_return;
}

?>


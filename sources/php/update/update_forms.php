<?php

    function get_cleaning_search_form(){
        $str = "<p>Mit welchem Attribut möchten Sie die Daten bestimmen, die Sie ändern wollen?</p>
                <form method='get'>
                    <input type=\"text\" name=\"workertype\" required='required' value='Reinigungspersonal' readonly hidden>
                    
                    <label for=\"searchval\">Wert der Suche</label><br>
                    <input type=\"text\" name=\"searchval\" required='required'><br>     
                    
                    <input type='radio' name='searchtype' value='socialsec'>
                    <label for='socialsec'>Versicherungsnummer</label><br>
                    <input type='radio' name='searchtype' value='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='radio' name='searchtype' value='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='radio' name='searchtype' value='shift_time'>
                    <label for='shift_time'>Tageszeit der Schicht</label><br>
                    
                    <input type='radio' name='searchtype' value='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    
                    <input class='button' type='submit' value='Auswählen'>
                </form>";
        return $str;
    }

    function get_tech_search_form(){
        $str = "<p>Mit welchem Attribut möchten Sie die Daten bestimmen, die Sie ändern wollen?</p>
                <form method='get'>
                    <input type=\"text\" name=\"workertype\" required='required' value='Techniker' readonly hidden>
                
                    <label for=\"searchval\">Wert der Suche</label><br>
                    <input type=\"text\" name=\"searchval\" required='required'><br>
                       
                    <input type='radio' name='searchtype' value='socialsec'>
                    <label for='socialsec'>Versicherungsnummer</label><br>
                    <input type='radio' name='searchtype' value='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='radio' name='searchtype' value='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='radio' name='searchtype' value='schooling'>
                    <label for='schooling'>Ausbildung</label><br>
                    <input type='radio' name='searchtype' value='meeting'>
                    <label for='meeting'>Getroffene TechnikerIn</label><br>
                    
                    <input type='radio' name='searchtype' value='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    
                    <input class='button' type='submit' value='Auswählen'>
                </form>";
        return $str;
    }

    function get_cashier_search_form(){
        $str = "<p>Mit welchem Attribut möchten Sie die Daten bestimmen, die Sie ändern wollen?</p>
                <form method='get'>
                    <input type=\"text\" name=\"workertype\" required='required' value='Kassierer' readonly hidden>
                
                    <label for=\"searchval\">Wert der Suche</label><br>
                    <input type=\"text\" name=\"searchval\" required='required'><br>
   
                    <input type='radio' name='searchtype' value='socialsec'>
                    <label for='socialsec'>Versicherungsnummer</label><br>
                    <input type='radio' name='searchtype' value='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='radio' name='searchtype' value='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='radio' name='searchtype' value='rating'>
                    <label for='rating'>Bewertung</label><br>
                    
                    <input type='radio' name='searchtype' value='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    
                    <input class='button' type='submit' value='Auswählen'>
                </form>";

        return $str;
    }

    function get_cleaning_update_form($list){
        $str = "<p>Welcher Attribut soll geändert werden?</p>
                <form method='post'>
                    <input type=\"text\" name=\"workertype\" required='required' value='Reinigungspersonal' readonly hidden>
                    <input type=\"text\" name=\"socialsec_list\" required='required' value='".$list."' readonly hidden>

                    <input type='radio' name='updatetype' value='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='radio' name='updatetype' value='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='radio' name='updatetype' value='shift_time'>
                    <label for='shift_time'>Tageszeit der Schicht</label><br>
                    <input type='radio' name='updatetype' value='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    
                    <label for=\"newval\">Neuer Wert</label><br>
                    <input type=\"text\" name=\"newval\" required='required'><br>
                    
                    <input class='button' type='submit' value='Auswählen'>
                </form>";

        return $str;
    }

    function get_tech_update_form($list){
        $str = "<p>Welcher Attribut soll geändert werden?</p>
                <form method='post'>
                    <input type=\"text\" name=\"workertype\" required='required' value='Techniker' readonly hidden>
                    <input type=\"text\" name=\"socialsec_list\" required='required' value='".$list."' readonly hidden>
  
                    <input type='radio' name='updatetype' value='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='radio' name='updatetype' value='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='radio' name='updatetype' value='schooling'>
                    <label for='schooling'>Ausbildung</label><br>
                    <input type='radio' name='updatetype' value='meeting'>
                    <label for='meeting'>Getroffene TechnikerIn</label><br>
                    <input type='radio' name='updatetype' value='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    
                    <label for=\"newval\">Neuer Wert</label><br>
                    <input type=\"text\" name=\"newval\" required='required'><br>
  
                    <input class='button' type='submit' value='Auswählen'>
                </form>";

        return $str;
    }

    function get_cashier_update_form($list){
        $str = "<p>Welcher Attribut soll geändert werden?</p>
                <form method='post'>
                    <input type=\"text\" name=\"workertype\" required='required' value='Kassierer' readonly hidden>
                    <input type=\"text\" name=\"socialsec_list\" required='required' value='".$list."' readonly hidden>
                
                    <input type='radio' name='updatetype' value='workerid'>
                    <label for='workerid'>MitarbeiterIn ID</label><br>
                    <input type='radio' name='updatetype' value='salary'>
                    <label for='salary'>Gehalt</label><br>
                    <input type='radio' name='updatetype' value='rating'>
                    <label for='rating'>Bewertung</label><br>
                    <input type='radio' name='updatetype' value='filialeid'>
                    <label for='filialeid'>Filiale ID</label><br>
                    
                    <label for=\"newval\">Neuer Wert</label><br>
                    <input type=\"text\" name=\"newval\" required='required'><br>
                    
                    <input class='button' type='submit' value='Auswählen'>
                </form>";

        return $str;
    }

    function convert_to_dbattribute($attr){
        switch ($attr){
            case 'socialsec':
                return 'VERSICHERUNGSNR';
            case 'workerid':
                return 'MITARBEITERINID';
            case 'salary':
                return 'GEHALT';
            case 'filialeid':
                return 'FILIALEID';
            case 'rating':
                return 'BEWERTUNG';
            case 'shift_time':
                return 'SCHICHTTAGESZEIT';
            case 'meeting':
                return 'GETROFFENETECHNIKERINVNR';
            case 'schooling':
                return 'AUSBILDUNG';
        }
        return '';
    }


?>
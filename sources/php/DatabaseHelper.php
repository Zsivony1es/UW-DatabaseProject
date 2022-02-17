<?php

class DatabaseHelper
{
    const username = 'DATABASE USERNAME (not public)';
    const password = 'DATABASE PASSWORD (not public)';
    const con_string = 'CONNECTION STRING (not public)';

    protected $conn;

    public function __construct(){
        try{
            $this->conn = @oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            if (!$this->conn){
                throw new Exception();
            }

        } catch (Exception $e) {
            die("DB Error: Connection can't be established!");
        }
    }

    public function __destruct(){
        @oci_close($this->conn);
    }

    public function register_new_customer($name, $dob){

        $current_date = date("Y-m-d");
        $diff = date_diff(date_create($dob), date_create($current_date));

        $sql = "INSERT INTO KUNDE (NAME_, AGE) VALUES('{$name}', '{$diff->format('%y')}')";
        $stmt = @oci_parse($this->conn, $sql);
        $success = @oci_execute($stmt) && @oci_commit($this->conn);
        @oci_free_statement($stmt);
        return $success;
    }

    public function add_cleaning($name, $socialsec, $salary, $shift_time, $filialeid){

        $sql = "INSERT INTO MITARBEITERIN (VERSICHERUNGSNR, NAME_, GEHALT)
                VALUES (".$socialsec.", '$name', ".$salary.")";
        $stmt = @oci_parse($this->conn, $sql);
        $succ = @oci_execute($stmt) && @oci_commit($this->conn);
        @oci_free_statement($stmt);

        if ($succ){
            $sql = "INSERT INTO REINIGUNGSPERSONAL
                    VALUES (".$socialsec.", ".$shift_time.", ".$filialeid.")";
            $stmt = @oci_parse($this->conn, $sql);
            $succ = @oci_execute($stmt) && @oci_commit($this->conn);
            @oci_free_statement($stmt);

            return $succ;

        } else {
            throw new Exception('Insertion into MITARBEITERIN relation failed!');
        }

    }

    public function add_tech($name, $socialsec, $salary, $schooling, $met_cowerker, $filialeid){

        $sql = "INSERT INTO MITARBEITERIN (VERSICHERUNGSNR, NAME_, GEHALT)
                VALUES (".$socialsec.", '$name', ".$salary.")";
        $stmt = @oci_parse($this->conn, $sql);
        $succ = @oci_execute($stmt) && @oci_commit($this->conn);
        @oci_free_statement($stmt);

        if ($succ){
            if ($met_cowerker == -1){
                $sql = "INSERT INTO TECHNIKER (VERSICHERUNGSNR, AUSBILDUNG, FILIALEID)
                        VALUES (".$socialsec.", '$schooling', ".$filialeid.")";
            } else {
                $sql = "INSERT INTO TECHNIKER (VERSICHERUNGSNR, AUSBILDUNG, GETROFFENETECHNIKERINVNR, FILIALEID)
                        VALUES (".$socialsec.", '$schooling', ".$met_cowerker.", ".$filialeid.")";
            }

            $stmt = @oci_parse($this->conn, $sql);
            $succ = @oci_execute($stmt) && @oci_commit($this->conn);
            @oci_free_statement($stmt);

            return $succ;

        } else {
            throw new Exception('Insertion into MITARBEITERIN relation failed!');
        }

    }

    public function add_cashier($name, $socialsec, $salary, $rating, $filialeid){

        $sql = "INSERT INTO MITARBEITERIN (VERSICHERUNGSNR, NAME_, GEHALT)
                VALUES (".$socialsec.", '$name', ".$salary.")";
        $stmt = @oci_parse($this->conn, $sql);
        $succ = @oci_execute($stmt) && @oci_commit($this->conn);
        @oci_free_statement($stmt);

        if ($succ){

            $sql = "INSERT INTO KASSIERER (VERSICHERUNGSNR, BEWERTUNG, FILIALEID)
                VALUES (".$socialsec.", ".$rating.", ".$filialeid.")";

            $stmt = @oci_parse($this->conn, $sql);
            $succ = @oci_execute($stmt) && @oci_commit($this->conn);
            @oci_free_statement($stmt);

            return $succ;

        } else {
            throw new Exception('Insertion into MITARBEITERIN relation failed!');
        }

    }

    public function get_all_customer_names(){

        $sql = "SELECT NAME_ FROM KUNDE 
                ORDER BY NAME_ ASC";
        $stmt = @oci_parse($this->conn, $sql);
        @oci_execute($stmt);
        $res = array(array());
        @oci_fetch_all($stmt, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($stmt);

        return $res;

    }

    public function get_customer_by_name($name){

        $sql = "SELECT NAME_ FROM KUNDE
                WHERE NAME_ = '{$name}'
                ORDER BY NAME_ ASC";
        $stmt = @oci_parse($this->conn, $sql);
        @oci_execute($stmt);
        $res = array(array());
        @oci_fetch_all($stmt, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($stmt);

        return $res;

    }

    public function get_movie_list(){

        $sql = "SELECT * FROM FIRST_20_MOVIES";
        $stmt = @oci_parse($this->conn, $sql);
        @oci_execute($stmt);
        $res = array(array());
        @oci_fetch_all($stmt, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($stmt);

        return $res;

    }

    public function delete_from_workers($attribute_type, $attribute_value){

        switch($attribute_type){
            case 'workerid':
                $type = "MITARBEITERINID";
                break;
            case 'socialsec':
                $type = "VERSICHERUNGSNR";
                break;
            case 'name':
                $type = "NAME_";
        }

        $sql = "DELETE FROM MITARBEITERIN WHERE ".$type."=".$attribute_value;

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $succ = @oci_commit($this->conn);
        @oci_free_statement($statement);

        return $succ;
    }

    public function delete_from_cleaning($attribute_value){

        $sql = "DELETE FROM REINIGUNGSPERSONAL WHERE VERSICHERUNGSNR=".$attribute_value;

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $succ = @oci_commit($this->conn);
        @oci_free_statement($statement);

        return $succ;
    }

    public function delete_from_tech($attribute_value){

        $sql = "DELETE FROM TECHNIKER WHERE VERSICHERUNGSNR=".$attribute_value;

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $succ = @oci_commit($this->conn);
        @oci_free_statement($statement);

        return $succ;
    }

    public function delete_from_cashier($attribute_value){

        $sql = "DELETE FROM KASSIERER WHERE VERSICHERUNGSNR=".$attribute_value;

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $succ = @oci_commit($this->conn);
        @oci_free_statement($statement);

        return $succ;
    }

    public function get_all_socsec($search_attribute, $val){
        if ($search_attribute == 'name'){
            $sql = "SELECT VERSICHERUNGSNR FROM MITARBEITERIN
                    WHERE NAME_ = '$val'";
        } else {
            $sql = "SELECT VERSICHERUNGSNR FROM MITARBEITERIN
                    WHERE MITARBEITERINID = ".$val;
        }

        $stmt = @oci_parse($this->conn, $sql);
        @oci_execute($stmt);
        $res = array(array());
        @oci_fetch_all($stmt, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($stmt);

        return $res;

    }

    public function get_worker_list($row_count, $attr_arr, $table, $constraint_attr = '', $constraint_val = -1){

        $sql = "SELECT ";
        $first = true;
        foreach ($attr_arr as $attr){

            if ($attr == 'VERSICHERUNGSNR')
                $attr = 'a.'.$attr;

            if ($first){
                $first=false;
                $sql = $sql.$attr;
                continue;
            }
            $sql = $sql.', '.$attr;

        }

        $sql = $sql." FROM ".$table." a INNER JOIN MITARBEITERIN b ON a.VERSICHERUNGSNR=b.VERSICHERUNGSNR";

        if ($constraint_attr != '')
            $sql = $sql." WHERE a.".$constraint_attr."=".$constraint_val;

        if ($row_count != -1)
            $sql = $sql." FETCH FIRST ".$row_count." ROWS ONLY";

        $stmt = @oci_parse($this->conn, $sql);
        @oci_execute($stmt);
        $res = array(array());

        if ($constraint_attr == ''){
            @oci_fetch_all($stmt, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        } else {
            @oci_fetch_all($stmt, $res, 0, 0, OCI_FETCHSTATEMENT_BY_COLUMN);
        }

        @oci_free_statement($stmt);

        return $res;

    }

    public function update_table($relation, $attr, $socialsec, $newval){

        $sql = "UPDATE ".$relation." SET ".$attr." = ";

        if (is_string($newval))
            $sql = $sql."'".$newval."' WHERE VERSICHERUNGSNR = ".$socialsec;
        else
            $sql = $sql.$newval." WHERE VERSICHERUNGSNR = ".$socialsec;

        $stmt = @oci_parse($this->conn, $sql);
        $succ = @oci_execute($stmt) && @oci_commit($this->conn);
        @oci_free_statement($stmt);

        return $succ;

    }

    public function format_date($str){
        // Format: 05-JAN-22 06.00.00.000000 PM
        if (((int)substr($str, 7, 2)) < 50){ // Works until 2050 - lol
            $yr = '20'.substr($str, 7, 2);
        } else {
            $yr = substr($str, 7, 2);
        }

        if (substr($str,26,2) == 'PM') {
            $hr = (int)(substr($str, 10, 2)) + 12;
        } else {
            $hr = (int)(substr($str, 10, 2));
        }

        return
            substr($str, 0, 2).
            '.'.substr($str, 3, 3).
            '.'.$yr.
            ' '.$hr.
            ':'.substr($str, 13, 2);
    }

}

?>

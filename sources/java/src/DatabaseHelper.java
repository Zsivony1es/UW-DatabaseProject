import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class DatabaseHelper {

    private static final String DB_CONNECTION_URL = "jdbc:oracle:thin:@oracle-lab.cs.univie.ac.at:1521:lab";
    private static final String USER = "a11922002";
    private static final String PASS = "okolare1";

    private static Connection con;
    private static PreparedStatement prepStmt;
    private static Statement stmt;

    public DatabaseHelper(){
        try {
            con = DriverManager.getConnection(DB_CONNECTION_URL, USER, PASS);
            stmt = con.createStatement();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void insertIntoKinoFiliale(int id, String filialeLeiter, String adresse){
        try {

            String statementString = "INSERT INTO KINO_FILIALE VALUES(?, ?, ?)";
            prepStmt = con.prepareStatement(statementString);

            prepStmt.setInt(1, id);
            prepStmt.setString(2, filialeLeiter);
            prepStmt.setString(3, adresse);
            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into KinoFiliale!");
            System.out.println("Values: " + id + ", " + filialeLeiter + ", " + adresse);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());

        }
    }

    public void insertIntoKinosaal(int filialeID, String roomName, int amountOfColumns, int amountOfRows){

       try {

           String statementString = "INSERT INTO KINOSAAL VALUES(?, ?, ?, ?)";
           prepStmt = con.prepareStatement(statementString);

           prepStmt.setInt(1, filialeID);
           prepStmt.setString(2, roomName);
           prepStmt.setInt(3, amountOfColumns);
           prepStmt.setInt(4, amountOfRows);
           prepStmt.executeUpdate();
           prepStmt.close();

           System.out.println("Record inserted into Kinosaal!");
           System.out.println("Values: " + filialeID + ", " + roomName + ", " + amountOfColumns + ", " + amountOfRows);

       } catch (SQLException e){
           System.out.println("INSERT FAILED:\n" + e.getMessage());
           e.printStackTrace();
       }

    }

    public void insertIntoSitzplatz(int filialeID, String roomName, int seatNr, int rowNr, int columnNr){

        try {

            String statementString = "INSERT INTO SITZPLATZ VALUES(?, ?, ?, ?, ?)";
            prepStmt = con.prepareStatement(statementString);

            prepStmt.setInt(1, filialeID);
            prepStmt.setString(2, roomName);
            prepStmt.setInt(3, seatNr);
            prepStmt.setInt(4, rowNr);
            prepStmt.setInt(5, columnNr);
            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into Sitzplatz!");
            System.out.println("Values: " + filialeID + ", " + roomName + ", " + seatNr + ", " + rowNr + ", " + columnNr);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoAnzeige(int filialeID, String roomName, Timestamp date, int length, String movieTitle){

        try {

            String statementString = "INSERT INTO ANZEIGE VALUES(?, ?, ?, ?, ?)";
            prepStmt = con.prepareStatement(statementString);

            prepStmt.setInt(1, filialeID);
            prepStmt.setString(2, roomName);
            prepStmt.setTimestamp(3, date);
            prepStmt.setInt(4, length);
            prepStmt.setString(5, movieTitle);
            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into Anzeige!");
            System.out.println("Values: " + filialeID + ", " + roomName + ", " + date.toString() + ", " + length + ", " + movieTitle);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoMitarbeiterIn(String name, int socialSecurityNr, float salary){

        String statementString = "INSERT INTO MITARBEITERIN (VERSICHERUNGSNR, NAME_, GEHALT) VALUES(?, ?, ?)";

        try {

            prepStmt = con.prepareStatement(statementString);

            prepStmt.setInt(1, socialSecurityNr);
            prepStmt.setString(2, name);
            prepStmt.setFloat(3, salary);
            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into MitarbeiterIn!");
            System.out.println("Values: " + name + ", " + socialSecurityNr + ", " + salary);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoTechniker(int filialeID, int socialSecurityNr, String schooling, int meetingWithID){

        String statementString;
        //meetsWithID is -1 if there is no relation
        if (meetingWithID != -1)
            statementString = "INSERT INTO TECHNIKER (VERSICHERUNGSNR, AUSBILDUNG, FILIALEID, GETROFFENEMITARBEITERINID) VALUES(?, ?, ?, ?)";
        else
            statementString = "INSERT INTO TECHNIKER (VERSICHERUNGSNR, AUSBILDUNG, FILIALEID) VALUES(?, ?, ?)";

        try {

            prepStmt = con.prepareStatement(statementString);

            prepStmt.setInt(1, socialSecurityNr);
            prepStmt.setString(2, schooling);
            prepStmt.setInt(3, filialeID);
            if (meetingWithID != -1)
                prepStmt.setInt(4, meetingWithID);
            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into Techniker!");
            System.out.println("Values: " + filialeID + ", " + socialSecurityNr + ", " + schooling + ", " + ((meetingWithID == -1) ? "null" : meetingWithID) );

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoKassierer(int filialeID, int socialSecurityNr, float rating){

        String statementString = "INSERT INTO KASSIERER (VERSICHERUNGSNR, BEWERTUNG, FILIALEID) VALUES(?, ?, ?)";

        try {

            prepStmt = con.prepareStatement(statementString);

            prepStmt.setInt(1, socialSecurityNr);
            prepStmt.setFloat(2, rating);
            prepStmt.setInt(3, filialeID);

            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into Kassierer!");
            System.out.println("Values: " + filialeID + ", " + socialSecurityNr + ", " + rating);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoReinigungspersonal(int filialeID, int socialSecurityNr, boolean shiftTime){

        String statementString = "INSERT INTO REINIGUNGSPERSONAL (VERSICHERUNGSNR, SCHICHTTAGESZEIT, FILIALEID) VALUES(?, ?, ?)";

        try {

            prepStmt = con.prepareStatement(statementString);

            prepStmt.setInt(1, socialSecurityNr);
            prepStmt.setInt(2, (shiftTime) ? 1 : 0);
            prepStmt.setInt(3, filialeID);

            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into Reinigungspersonal!");
            System.out.println("Values: " + filialeID + ", " + socialSecurityNr + ", " + ((shiftTime) ? "Tagesschicht" : "Nachtschicht") );

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoKunde(String name, int age){

        String statementString = "INSERT INTO KUNDE (NAME_, AGE) VALUES(?, ?)";

        try {

            prepStmt = con.prepareStatement(statementString);

            prepStmt.setString(1, name);
            prepStmt.setInt(2, age);

            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into Kunde!");
            System.out.println("Values: " + name + ", " + age);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoBuchung(float price, Date date, int socialSecurity, int customerID){

        String statementString = "INSERT INTO BUCHUNG (PREIS, DATUM, VERSICHERUNGSNR, KUNDENID) VALUES(?, ?, ?, ?)";

        try {

            prepStmt = con.prepareStatement(statementString);

            prepStmt.setFloat(1, price);
            prepStmt.setDate(2, date);
            prepStmt.setInt(3, socialSecurity);
            prepStmt.setInt(4, customerID);

            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into Buchung!");
            System.out.println("Values: " + date.toString() + ", " + price + ", " + socialSecurity + ", " + customerID);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoVerweistAuf(int bookingNr, int seatNr, String roomName, int filialeID){

        String statementString = "INSERT INTO VERWEIST_AUF (BUCHUNGID, SITZPLATZNR, NAME_, FILIALEID) VALUES(?, ?, ?, ?)";

        try {

            prepStmt = con.prepareStatement(statementString);

            prepStmt.setInt(1, bookingNr);
            prepStmt.setInt(2, seatNr);
            prepStmt.setString(3, roomName);
            prepStmt.setInt(4, filialeID);

            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into verweist_auf!");
            System.out.println("Values: " + filialeID + ", " + roomName + ", " + seatNr + ", " + bookingNr);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public void insertIntoBetreuen(int socialSecurity, String roomName, int filialeID){

        String statementString = "INSERT INTO BETREUEN (VERSICHERUNGSNR, NAME_, FILIALEID) VALUES(?, ?, ?)";

        try {

            prepStmt = con.prepareStatement(statementString);

            prepStmt.setFloat(1, socialSecurity);
            prepStmt.setString(2, roomName);
            prepStmt.setInt(3, filialeID);

            prepStmt.executeUpdate();
            prepStmt.close();

            System.out.println("Record inserted into betreuen!");
            System.out.println("Values: " + filialeID + ", " + roomName + ", " + socialSecurity);

        } catch (SQLException e){
            System.out.println("INSERT FAILED:\n" + e.getMessage());
            e.printStackTrace();
        }

    }

    public List<TheaterRoom> getTheaterRoomList(){

        List<TheaterRoom> ret = new ArrayList<>();

        try {

            ResultSet rs = stmt.executeQuery("SELECT * FROM KINOSAAL");
            while (rs.next()){
                ret.add(new TheaterRoom(
                        rs.getInt("FILIALEID"),
                        rs.getString("NAME_"),
                        rs.getInt("ANZAHL_SPALTEN"),
                        rs.getInt("ANZAHL_REIHEN")
                ));
            }
            rs.close();

        } catch (Exception e) {
            System.err.println(("Error at: getTheaterRoomList\n message: " + e.getMessage()).trim());
        }

        return ret;

    }

    public List<Integer> getCashierSocSec(){

        List<Integer> ret = new ArrayList<>();

        try {

            ResultSet rs = stmt.executeQuery("SELECT VERSICHERUNGSNR FROM KASSIERER");
            while (rs.next()){
                ret.add(rs.getInt("VERSICHERUNGSNR"));
            }
            rs.close();

        } catch (Exception e) {
            System.err.println(("Error at: getCashierSocSec\n message: " + e.getMessage()).trim());
        }

        return ret;

    }

    public List<Integer> getTechSocSec(){

        List<Integer> ret = new ArrayList<>();

        try {

            ResultSet rs = stmt.executeQuery("SELECT VERSICHERUNGSNR FROM TECHNIKER");
            while (rs.next()){
                ret.add(rs.getInt("VERSICHERUNGSNR"));
            }
            rs.close();

        } catch (Exception e) {
            System.err.println(("Error at: getTechSocSec\n message: " + e.getMessage()).trim());
        }

        return ret;

    }

    public void close()  {
        try {
            prepStmt.close(); //clean up
            con.close();
        } catch (Exception ignored) {
        }
    }


}

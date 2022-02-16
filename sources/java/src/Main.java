import java.sql.Date;
import java.sql.Timestamp;
import java.util.List;
import java.util.Random;

public class Main {

    static final int NUMBER_OF_MOVIE_THEATERS = 10;

    public static void main(String[] args) {

        System.out.println(1643673600000L + 1640995200000L);

        Random rand = new Random();
        DatabaseHelper helper = new DatabaseHelper();
        RandomDataGenerator randomGen = new RandomDataGenerator();


        //INSERT FOR KINO_FILIALE
        for (int i = 1; i <= NUMBER_OF_MOVIE_THEATERS; ++i){
            helper.insertIntoKinoFiliale(i, randomGen.generateName(), randomGen.generateAddress());
        }

        //INSERT FOR KINOSAAL
        for (int i = 1; i <= NUMBER_OF_MOVIE_THEATERS; ++i){
            for (int j = 1; j <= 3; ++j){
                helper.insertIntoKinosaal(rand.nextInt(NUMBER_OF_MOVIE_THEATERS)+1,
                        randomGen.generateTheaterRoomName(),
                        rand.nextInt(10)+5,
                        rand.nextInt(10)+5);
            }
        }

        //INSERT FOR SITZPLATZ
        List<TheaterRoom> roomList = helper.getTheaterRoomList();

        for (TheaterRoom room : roomList){
            for (int i = 1; i <= room.getRowCount(); ++i){
                for (int j = 1; j <= room.getColumnCount(); ++j){
                    helper.insertIntoSitzplatz(room.getFilialeID(), room.getName(), (i-1)*room.getColumnCount()+j, i, j);
                }
            }
        }

        //INSERT FOR ANZEIGE
        for (TheaterRoom room : roomList){
            for (int j = 0; j < 31; ++j){
                for (int i = 0; i < 5; ++i){
                    String str = "2022-02-01";
                    helper.insertIntoAnzeige(
                            room.getFilialeID(),
                            room.getName(),
                            new Timestamp(1643706000000L + i*10800000L + j*86400000L), // i - 3 hours, j - 1 day
                            rand.nextInt(120)+65,
                            randomGen.generateMovieTitle());
                }
            }
        }

        //INSERT FOR TECHNIKER
        for (int i = 1; i <= NUMBER_OF_MOVIE_THEATERS; ++i){
            for (int j = 0; j < 5; ++j){
                int socSec = randomGen.generateSocialSecurityNumber();

                helper.insertIntoMitarbeiterIn(
                        randomGen.generateName(),
                        socSec,
                        rand.nextInt(50000)+50000
                        );

                helper.insertIntoTechniker(
                        i,
                        socSec,
                        randomGen.generateSchoolingType(),
                        -1
                        );
            }
        }

        //INSERT FOR KASSIERER
        for (int i = 1; i <= NUMBER_OF_MOVIE_THEATERS; ++i){
            for (int j = 0; j < 5; ++j){
                int socSec = randomGen.generateSocialSecurityNumber();

                helper.insertIntoMitarbeiterIn(
                        randomGen.generateName(),
                        socSec,
                        rand.nextInt(50000)+35000
                );

                helper.insertIntoKassierer(
                        i,
                        socSec,
                        rand.nextFloat(10)
                );
            }
        }

        //INSERT FOR REINIGUNGSPERSONAL
        for (int i = 1; i <= NUMBER_OF_MOVIE_THEATERS; ++i){
            for (int j = 0; j < 5; ++j){
                int socSec = randomGen.generateSocialSecurityNumber();

                helper.insertIntoMitarbeiterIn(
                        randomGen.generateName(),
                        socSec,
                        rand.nextInt(50000)+25000
                );

                helper.insertIntoReinigungspersonal(
                        i,
                        socSec,
                        rand.nextBoolean()
                );
            }
        }

        //INSERT FOR KUNDE
        for (int i = 0; i < 2000; ++i){
            helper.insertIntoKunde(
                    randomGen.generateName(),
                    rand.nextInt(80)+18);
        }
        helper.insertIntoKunde("admin", 21); // for website login

        //INSERT FOR BUCHUNG
        List<Integer> cashierSocSec = helper.getCashierSocSec();

        for (int i = 1; i <= 2000; ++i){
            helper.insertIntoBuchung(
                    rand.nextFloat(10)+10f,
                    new Date(rand.nextLong(3284668800000L) + 1640995200000L), //Between 2022-01-01 and 2022-02-02
                    cashierSocSec.get(rand.nextInt(cashierSocSec.size())),
                    rand.nextInt(1999)+1
                    );
        }

        //INSERT FOR VERWEIST_AUF
        for (int i = 1; i <= 2000; ++i){
            int roomIndex = rand.nextInt(roomList.size());
            helper.insertIntoVerweistAuf(
                    i,
                    rand.nextInt(roomList.get(roomIndex).getRowCount() * roomList.get(roomIndex).getColumnCount() )+1,
                    roomList.get(roomIndex).getName(),
                    roomList.get(roomIndex).getFilialeID()
            );
        }

        //INSERT FOR BETREUEN
        List<Integer> techSocSecList = helper.getTechSocSec();
        for (int i = 0; i < 20; ++i){
            int roomIndex = rand.nextInt(roomList.size());
            helper.insertIntoBetreuen(
                    techSocSecList.get(rand.nextInt(techSocSecList.size())),
                    roomList.get(roomIndex).getName(),
                    roomList.get(roomIndex).getFilialeID()
            );
        }

        helper.close();

    }
}

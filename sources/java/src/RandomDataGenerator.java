import java.io.BufferedReader;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;

public class RandomDataGenerator {

    private Random rand = new Random();
    private static String[] streets = {
            "Hetz", "Herz", "Stern", "Zirkus", "Große Mohr", "Optik",
            "Lens", "Berg", "Bürger", "Paris", "Berliner", "Moskau", "Josef", "Marokkaner",
            "Maria", "Bruh", "Welt", "Bauer", "Baum", "Europa", "Amerikaner", "Luft", "Wasser", "Waag"};

    private List<String> firstNames;
    private List<String> lastNames;

    private static String[] schooling = {"Grundschule", "Reifeprüfung", "Fachhochschule", "BSc", "MSc", "Andere"};

    private List<String> movieList;
    private int nextMovie = -1;
    private List<String> roomNameList;
    private int nextRoomName = -1;
    private int currentSocialSec = 1523100000;

    public RandomDataGenerator(){
        // Read movie_titles.csv
        try (BufferedReader br = Files.newBufferedReader(Paths.get("resources/movie_titles.csv"))) {
            String DELIMITER = ",";
            String line;
            List<String> list = new ArrayList<>();
            while ((line = br.readLine()) != null)
                list.add(line);
            movieList = list;
        } catch (IOException ex) {
            ex.printStackTrace();
        }

        // Read movie_titles.csv
        try (BufferedReader br = Files.newBufferedReader(Paths.get("resources/room_names.csv"))) {
            String DELIMITER = ",";
            String line;
            List<String> list = new ArrayList<>();
            while ((line = br.readLine()) != null)
                list.add(line);
            roomNameList = list;
        } catch (IOException ex) {
            ex.printStackTrace();
        }

        //read name_list.csv
        try (BufferedReader br = Files.newBufferedReader(Paths.get("resources/name_list.csv"))) {
            String DELIMITER = ",";
            String line;
            List<String> flist = new ArrayList<>();
            List<String> llist = new ArrayList<>();
            while ((line = br.readLine()) != null){
                String[] name = line.split(DELIMITER);
                flist.add(name[0]);
                llist.add(name[1]);
            }
            firstNames = flist;
            lastNames = llist;
        } catch (IOException ex) {
            ex.printStackTrace();
        }

    }

    public int generateSocialSecurityNumber(){
        return currentSocialSec++;
    }

    public String generateAddress(){
        return (1000 + 10 * (rand.nextInt(22)+1)) // PLZ
                + " Wien, "
                + streets[rand.nextInt(streets.length)] //random street name
                + ((rand.nextBoolean()) ? "gasse " : "strasse ") //strasse or gasse
                + (rand.nextInt(200)+1); // house number
    }

    public String generateName(){
        return firstNames.get(rand.nextInt(firstNames.size())) + " " + lastNames.get(rand.nextInt(lastNames.size()));
    }

    public String generateTheaterRoomName(){
        nextRoomName++;
        if (nextRoomName > 35)
            nextRoomName = 0;
        return roomNameList.get(nextRoomName) + " Raum";
    }

    public String generateMovieTitle(){
        nextMovie++;
        if (nextMovie > 999)
            nextMovie = 0;
        return movieList.get(nextMovie);
    }

    public String generateSchoolingType(){
        return schooling[rand.nextInt(schooling.length)];
    }

    public int getMovieListLength(){
        return movieList.size();
    }

    public int getRoomNameListLength(){
        return roomNameList.size();
    }




}

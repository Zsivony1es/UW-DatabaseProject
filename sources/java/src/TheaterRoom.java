public class TheaterRoom {

    private int filialeID;
    private String name;
    private int columnCount;
    private int rowCount;

    public TheaterRoom(int filialeID, String name, int columnCount, int rowCount){
        this.filialeID = filialeID;
        this.name = name;
        this.columnCount = columnCount;
        this.rowCount = rowCount;
    }

    public int getFilialeID() {
        return filialeID;
    }

    public String getName() {
        return name;
    }

    public int getColumnCount() {
        return columnCount;
    }

    public int getRowCount() {
        return rowCount;
    }
}

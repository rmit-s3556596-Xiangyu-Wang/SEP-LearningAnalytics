import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

/**
 * This class creates ArrayLists for adding info from the input file. The
 * constructor creates new objects and the data using those objects is written
 * to a new .sql file.
 * 
 * @author Nebs
 *
 */
public class Main {

	private String Student_Id;
	private String Family_Name;
	private String Given_Name;
	private String Program_Code;
	private int Program_GPA;
	private int Total_Units_Pass;
	private int Total_Units_Attempt;
	private String Student_Email_Address;

	/**
	 * This method will create commands to insert into the data table
	 * 
	 * @return SQL commands for the data table
	 */
	public String printData() {

		String output = "insert into data values (" + Student_Id + ", '" + Family_Name + "', " + Given_Name + ", '"
				+ Program_Code + "', " + Program_GPA + ", '" + Total_Units_Pass + "', " + Total_Units_Attempt + ", "
				+ Student_Email_Address + ");";

		return output;
	}

	protected static ArrayList<Main> data = new ArrayList<Main>();

	public Main(String Student_Id, String Family_Name, String Given_Name, String Program_Code, int Program_GPA,
			int Total_Units_Pass, int Total_Units_Attempt, String Student_Email_Address) {
		this.Student_Id = Student_Id;
		this.Family_Name = Family_Name;
		this.Given_Name = Given_Name;
		this.Program_Code = Program_Code;
		this.Program_GPA = Program_GPA;
		this.Total_Units_Pass = Total_Units_Pass;
		this.Total_Units_Attempt = Total_Units_Attempt;
		this.Student_Email_Address = Student_Email_Address;
	}

	public static void main(String[] args) {

		IO rw = new IO();

		// start performance outputs
		long startOpenFile = System.currentTimeMillis();
		rw.openFile();
		long finishOpenFile = System.currentTimeMillis();

		long startReadWrite = System.currentTimeMillis();
		rw.readFile();
		long finishReadWrite = System.currentTimeMillis();

		rw.closeFile();

		System.out.println("Open file: " + (finishOpenFile - startOpenFile) + " ms.");
		System.out.println("Read/write: " + (finishReadWrite - startReadWrite) / 1000 + " s.");

		System.out.println();
		System.out.println();
		// end performance outputs

		try {
			// name of the output file
			PrintWriter writer = new PrintWriter("output.sql", "UTF-8");

			// Create data table (header row)
			writer.println(
					"create table data(Student_Id INT NOT NULL, Family_Name VARCHAR(50), Given_Name VARCHAR(50), Program_Code INT, Program_GPA INT, Total_Units_Pass INT, Total_Units_Attempt INT, Student_Email_Address VARCHAR(30), PRIMARY KEY(Student_Id));");
			// Create data table (data)
			for (int i = 0; i < data.size(); i++)
				writer.println(data.get(i).printData());

			writer.close();
		} catch (IOException e) {
			// error message
			System.err.println("Could not write file.");
		}

		System.out.println("Finished.");

	}

}
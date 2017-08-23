import java.io.File;
import java.util.Scanner;

/**
 * This class reads in the input.txt file (converted .csv file) and adds the
 * information to an ArrayList.
 * 
 * @author Nebs
 *
 */
public class IO {
	private Scanner reader;

	@SuppressWarnings("resource")
	public void openFile() {
		try {
			// location of the input file
			reader = new Scanner(new File("input.txt")).useDelimiter("\t|\n");
		} catch (Exception e) {
			// error message if input file not found
			System.err.println("File could not be found.");
		}
	}

	@SuppressWarnings("unused")
	public void readFile() {
		while (reader.hasNext()) {

			// read in all info from the file
			String Student_Id = reader.next();
			String Family_Name = reader.next();
			String Given_Name = reader.next();
			String Academic_Career = reader.next();
			int Acad_Level = reader.nextInt();
			String Program_Campus = reader.next();
			int Term = reader.nextInt();
			String Program_Code = reader.next();
			String Academic_Plan = reader.next();
			int Admit_Term = reader.nextInt();
			String Course_Owner = reader.next();
			int Course_Id = reader.nextInt();
			String Course_Description = reader.next();
			String Subject_Id = reader.next();
			int Catalogue_Number = reader.nextInt();
			int Class_Number = reader.nextInt();
			String Session_Code = reader.next();
			String Section_Code = reader.next();
			String Class_Campus = reader.next();
			int Grade_Entered = reader.nextInt();
			String Grade_Official = reader.next();
			int Grade_Roster_Input = reader.nextInt();
			String Grade_In_Roster_Status = reader.next();
			int Term_GPA = reader.nextInt();
			int Program_GPA = reader.nextInt();
			int Total_Units_Attempt = reader.nextInt();
			int Total_Units_Pass = reader.nextInt();
			String Funding_Source = reader.next();
			String ACADPR_Comments = reader.next();
			int Total_Units_Credit = reader.nextInt();
			int Cumulative_Units = reader.nextInt();
			String Student_Email_Address = reader.next();

			// add to ArrayList
			Main.data.add(new Main(Student_Id, Family_Name, Given_Name, Program_Code, Program_GPA, Total_Units_Pass,
					Total_Units_Attempt, Student_Email_Address));

		}
	}

	public void closeFile() {
		reader.close();
	}

}

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

import javax.swing.JButton;
import javax.swing.JFileChooser;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.filechooser.FileSystemView;

public class encrypt_csv extends JFrame implements ActionListener
{
	// record for later compare
	static int cipher_count = 0;
	ArrayList<String> ID_List = new ArrayList<String>();
	ArrayList<String> FName_List = new ArrayList<String>();
	ArrayList<String> GName_List = new ArrayList<String>();
	ArrayList<String> Email_List = new ArrayList<String>();
	JButton open = null;
	
	public encrypt_csv()
	{
		open = new JButton("choose a file to de-identify");  
        this.add(open);
        this.setBounds(400, 200, 200, 200);
        this.setVisible(true);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        open.addActionListener(this);
    }
	
	@Override  
    public void actionPerformed(ActionEvent e)
    {	
		JFileChooser jfc = new JFileChooser();  
        jfc.setFileSelectionMode(JFileChooser.FILES_AND_DIRECTORIES);
        jfc.showDialog(new JLabel(), "Choose a file");
        File selected_file = jfc.getSelectedFile();          
        
        String output_file_name = (String) JOptionPane.showInputDialog(null, "Please input a output file name", "Input required", JOptionPane.QUESTION_MESSAGE, null, null, "output1");
        
        File output_file = new File(output_file_name + ".csv");
		BufferedReader br = null;
		PrintWriter writer = null;
		try
		{
			br = new BufferedReader(new FileReader(selected_file));
		}
		catch(FileNotFoundException e1)
		{
			e1.printStackTrace();
		}
		try
		{
			writer = new PrintWriter(new FileWriter(output_file));
		}
		catch(IOException e2)
		{
			e2.printStackTrace();
		}
		String line = "";
		try
		{
			line = br.readLine();
			while(line.contains("Student Id") == false)
			{
				line = br.readLine();
				System.out.println(line);
			}
			line = br.readLine();
			while(line != null)
			{
				if(selected_file.getName().contains(".csv"))
				{
					String item[] = line.split(",");
					
					if(item.length == 0)
					{
						break;
					}
					
					if(ID_List.contains(item[0]) == false)
					{
						ID_List.add(item[0]);
						FName_List.add(item[1]);
						GName_List.add(item[2]);
						Email_List.add(item[item.length - 1]);				
						item[0] = cipherID(cipher_count);
						item[1] = cipherFName(cipher_count);
						item[2] = cipherGName(cipher_count);
						item[item.length - 1] = cipherEMail(cipher_count);
						cipher_count++;
					}
					else
					{
						item[0] = cipherID(ID_List.indexOf(item[0]));
						item[1] = cipherFName(FName_List.indexOf(item[1]));
						item[2] = cipherGName(GName_List.indexOf(item[2]));
						item[item.length - 1] = cipherEMail(Email_List.indexOf(item[item.length - 1]));
					}
						
					for(int i = 0; i < item.length; i++)
					{
						System.out.print(item[i] + ",");
						writer.write(item[i] + ",");
					}
				}
				else if(selected_file.getName().contains(".txt"))
				{
					String item[] = line.split("\t");
						
					if(item.length == 0)
					{
						break;
					}
						
					if(ID_List.contains(item[0]) == false)
					{
						ID_List.add(item[0]);
						FName_List.add(item[1]);
						GName_List.add(item[2]);
						Email_List.add(item[item.length - 1]);				
						item[0] = cipherID(cipher_count);
						item[1] = cipherFName(cipher_count);
						item[2] = cipherGName(cipher_count);
						item[item.length - 1] = cipherEMail(cipher_count);
						cipher_count++;
					}
					else
					{
						item[0] = cipherID(ID_List.indexOf(item[0]));
						item[1] = cipherFName(FName_List.indexOf(item[1]));
						item[2] = cipherGName(GName_List.indexOf(item[2]));
						item[item.length - 1] = cipherEMail(Email_List.indexOf(item[item.length - 1]));
					}
						
					for(int i = 0; i < item.length; i++)
					{
						System.out.print(item[i] + ",");
						writer.write(item[i] + ",");
					}
				}					
				System.out.println();
				writer.println();
				line = br.readLine();				
			}
			br.close();
			writer.close();
			JOptionPane.showMessageDialog(null, output_file.getAbsolutePath(), "The output file directory is", JOptionPane.INFORMATION_MESSAGE);
		}
		catch(IOException e3)
		{
			e3.printStackTrace();
		} 
    }
	
	public static void main(String[] args)
	{
		new encrypt_csv();		
	}
	
	public static String cipherID(int count)
	{
		return ("ID" + count);
	}
	
	public static String cipherFName(int count)
	{
		return ("FName" + count);
	}
	
	public static String cipherGName(int count)
	{
		return ("GName" + count);
	}
	
	public static String cipherEMail(int count)
	{
		return ("EMail" + count);
	}
}
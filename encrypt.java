import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;

import javax.swing.JButton;
import javax.swing.JFileChooser;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.filechooser.FileSystemView;

public class encrypt extends JFrame implements ActionListener
{
	// record for later compare
	static String lastID = "";
	static String lastFName = "";
	static String lastGName = "";
	static String lastEMail = "";
	static int cipher_count = 0;
	JButton open=null;
	
	public encrypt()
	{  
        open=new JButton("choose a file to de-identify");  
        this.add(open);  
        this.setBounds(400, 200, 200, 200);  
        this.setVisible(true);  
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);  
        open.addActionListener(this);  
    }
	
	@Override  
    public void actionPerformed(ActionEvent e) 
    {  
        // TODO Auto-generated method stub  
        JFileChooser jfc=new JFileChooser();  
        jfc.setFileSelectionMode(JFileChooser.FILES_AND_DIRECTORIES);  
        jfc.showDialog(new JLabel(), "Choose a file");
        File selected_file=jfc.getSelectedFile();
        
        File output_file = new File("test_output.txt");
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
		boolean encrypt_on = false;
		// record the column position of the four fields that are going to change
		//int studentID = 0;
		//int fName = 0;
		//int gName = 0;
		//int eMail = 0;
		try
		{
			line = br.readLine();
			while(line != null)
			{
				if(encrypt_on == true)
				{
					String item[] = line.split("\t");
					if(lastID.equals(item[0]))
					{
						item[0] = cipherID();
					}
					else
					{
						lastID = item[0];
						cipher_count++;
						item[0] = cipherID();
					}
					
					if(lastFName == item[1])
					{
						item[1] = cipherFName();
					}
					else
					{
						lastFName = item[1];
						item[1] = cipherFName();
					}
					
					if(lastGName == item[2])
					{
						item[2] = cipherGName();
					}
					else
					{
						lastGName = item[2];
						item[2] = cipherGName();
					}
					
					if(lastEMail == item[item.length-1])
					{
						item[item.length-1] = cipherEMail();
					}
					else
					{
						lastEMail = item[item.length-1];
						item[item.length-1] = cipherEMail();
					}

					for(int i = 0; i < item.length; i++)
					{
						System.out.print(item[i] + "\t");
						writer.print(item[i] + "\t");
					}
					System.out.println();
					writer.println();
				}
				else
				{
					if(line.contains("Student Id"))
					{
						encrypt_on = true;
						/* Not working, may test them later
						String item[] = line.split("\t");
						for(int i = 0; i < item.length; i++)
						{
							if(item[i] == "Student Id")
							{
								studentID = i;
							}
							if(item[i] == "Family Name")
							{
								fName = i;
							}
							if(item[i] == "Given Name")
							{
								gName = i;
							}
							if(item[i] == "Student Email Address")
							{
								eMail = i;
							}
						}
						*/
					}
					System.out.println(line);
				}
				line = br.readLine();				
			}			
		}
		catch(IOException e3)
		{
			e3.printStackTrace();
		}
        
        /* code below is used to test
		if(selected_file.isDirectory())
        {  
            System.out.println("文件夹:"+selected_file.getAbsolutePath());  
        }else if(selected_file.isFile())
        {  
            System.out.println("文件:"+selected_file.getAbsolutePath());  
        }  
        System.out.println(jfc.getSelectedFile().getName());
        */   
    }
	
	public static void main(String[] args)
	{
		new encrypt();		
	}
	
	public static String cipherID()
	{
		return ("ID" + cipher_count);
	}
	
	public static String cipherFName()
	{
		return ("FName" + cipher_count);
	}
	
	public static String cipherGName()
	{
		return ("GName" + cipher_count);
	}
	
	public static String cipherEMail()
	{
		return ("EMail" + cipher_count);
	}
}

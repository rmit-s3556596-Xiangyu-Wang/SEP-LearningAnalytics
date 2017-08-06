package rmit.learningAnalytics.DAO;

import rmit.learningAnalytics.model.*;

public interface LoginDAO {
	public boolean checkLogin(String userName, String userPassword);
}

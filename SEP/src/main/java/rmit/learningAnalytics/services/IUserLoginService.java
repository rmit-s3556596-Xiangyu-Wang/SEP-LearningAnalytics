package rmit.learningAnalytics.services;

import rmit.learningAnalytics.entites.User;

public interface IUserLoginService {
//	boolean findByUsername(String username, String password);
	User getUserByName(String name);
}

package rmit.learningAnalytics.services;

import rmit.learningAnalytics.entites.User;

public interface IUserLoginService {
	User getDataByUserName(String username);
	boolean findByLogin(String username, String password);
}

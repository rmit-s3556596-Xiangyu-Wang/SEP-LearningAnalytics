package rmit.learningAnalytics.services;

import rmit.learningAnalytics.entites.User;

public interface IUserLoginService {
	User getDataByUserName(String username);
	User findByUsername(String username);
}

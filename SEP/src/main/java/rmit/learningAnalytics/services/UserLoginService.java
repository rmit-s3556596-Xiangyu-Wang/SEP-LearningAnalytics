package rmit.learningAnalytics.services;

import java.util.List;

import org.hibernate.Query;
import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.orm.hibernate5.HibernateTemplate;
import org.springframework.stereotype.Repository;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import rmit.learningAnalytics.DAO.UserDAO;
import rmit.learningAnalytics.entites.User;
import rmit.learningAnalytics.repository.UserRepository;
@Service
public class UserLoginService implements IUserLoginService{
	
	@Autowired
	private UserRepository userRepository;

	@Override
	public User getUserByName(String name) {
		// TODO Auto-generated method stub
		return userRepository.getUserByName(name);
	}
	
	public boolean checkLogin(String name, String pwd, User user) {
		if(user.getUserName().equals(name)&&user.getUserPassword().equals(pwd)) {
			return true;
		}
		return false;
	}
//	@Override
//	public boolean findByUsername(String username, String password) {
//		// TODO Auto-generated method stub
//		User user = null;
//		for (int i=0;i<userRepository.findAll().size();i++) {
//			if (userRepository.findAll().get(i).getUserName().equals(username))
//				user = userRepository.findAll().get(i);
//		}
//		if(user != null && user.getUserPassword().equals(password))
//			return true;
//		else
//			return false;
//	}
	
}

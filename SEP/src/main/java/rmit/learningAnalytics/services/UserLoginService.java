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
	
	private SessionFactory sessionFactory;
	@Autowired
	private UserRepository userRepository;
	
	@Override
	public boolean findByUsername(String username, String password) {
		// TODO Auto-generated method stub
		User user = userRepository.findByUserName(username);
		if(user != null && user.getUserPassword().equals(password))
			return true;
		else
			return false;
	}
}

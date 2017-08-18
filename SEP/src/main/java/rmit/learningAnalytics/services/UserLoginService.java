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
	private UserDAO userDAO;
	@Override
	public User getDataByUserName(String username) {
		// TODO Auto-generated method stub
		return userDAO.getActiveUser(username);
	}
	@Override
	public User findByUsername(String username) {
		// TODO Auto-generated method stub
		return userRepository.findByUsername(username);
	}
	
	public boolean checkLogin(String username, String password) {
		String hql = "select user.user_name , user.user_password from user where user.user_name='"+username+"' and user.user_password='"+password+"'";
		Query query = sessionFactory.getCurrentSession().createQuery(hql);
		List list = query.list();
		if (list.size()>0)
			return true;
		else
			return false;
		
	}
}

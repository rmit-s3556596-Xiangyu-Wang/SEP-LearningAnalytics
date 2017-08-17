package rmit.learningAnalytics.DAO;

import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.orm.hibernate5.HibernateTemplate;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;
import rmit.learningAnalytics.entites.*;
@Repository
@Transactional
public class UserDAO {
	@Autowired
	private HibernateTemplate hibernateTemplate;
	public User getActiveUser(String userName) {
		User activeUserInfo = new User();
		List<?> list = hibernateTemplate.find("FROM User WHERE username=?",
				userName);
		if(!list.isEmpty()) {
			activeUserInfo = (User)list.get(0);
		}
		return activeUserInfo;
	}
} 

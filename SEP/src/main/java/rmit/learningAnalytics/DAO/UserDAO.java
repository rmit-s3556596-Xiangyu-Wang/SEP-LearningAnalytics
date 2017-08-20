package rmit.learningAnalytics.DAO;

import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.orm.hibernate5.HibernateTemplate;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;
import rmit.learningAnalytics.entites.*;

public class UserDAO {

	private HibernateTemplate hibernateTemplate;
	public User getActiveUser(String userName) {
		return null;
	}
} 

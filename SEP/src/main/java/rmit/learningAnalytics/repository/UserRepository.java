package rmit.learningAnalytics.repository;

import rmit.learningAnalytics.DAO.*;
import rmit.learningAnalytics.entites.User;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;

import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

@Repository(value="UserDAO")
public class UserRepository implements UserDAO{
	
	private EntityManager em = null;
	
	@Override
	@Transactional(readOnly = true)
	public User getUserByName(String name) {
		// TODO Auto-generated method stub
		return em.find(User.class, name);
	}
	
}

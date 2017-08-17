package rmit.learningAnalytics.repository;

import rmit.learningAnalytics.DAO.*;
import rmit.learningAnalytics.entites.User;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface UserRepository extends JpaRepository<User, Integer>{
	User findByUsername(String username);
}

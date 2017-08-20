package rmit.learningAnalytics.repository;

import rmit.learningAnalytics.DAO.*;
import rmit.learningAnalytics.entites.User;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

@Repository
public interface UserRepository extends JpaRepository<User, Integer>{
//	@Query("select user_name from user where user.username = :username")
//	User findByUserName(@Param("username") String username);
	User findByUserName(String name);
}

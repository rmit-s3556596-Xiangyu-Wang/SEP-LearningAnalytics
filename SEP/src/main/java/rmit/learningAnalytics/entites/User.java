package rmit.learningAnalytics.entites;

import javax.persistence.*;
import org.hibernate.HibernateException; 
import org.hibernate.Session; 
import org.hibernate.Transaction;
import org.hibernate.SessionFactory;
import org.hibernate.cfg.Configuration;

@Entity
@Table(name = "user", schema = "public")
public class User{
//	private SessionFactory sessionFactory = new Configuration().configure().buildSessionFactory();
	
	@Id
	@Column(name = "id", length = 7)
	private Long id;
	
	@Basic
	@Column(name = "user_name")
	String username;

	@Basic
	@Column(name = "user_password")
	String password;
	
	public Long getId() {
		return id;
	}


	public void setId(Long id) {
		this.id = id;
	} 

	public String getUserName() {
		return username;
	}

	public void setUserName(String username) {
		this.username = username;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String userPassword) {
		this.password = userPassword;
	}
	
	@Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        User that = (User) o;

        if (id != that.id) return false;
        if (username != null ? !username.equals(that.username) : that.username != null) return false;
        if (password != null ? !password.equals(that.password) : that.password != null) return false;

        return true;
    }
	
	@Override
    public int hashCode() {
        int result = (int) (id ^ (id >>> 32));
        result = 31 * result + (username != null ? username.hashCode() : 0);
        result = 31 * result + (password != null ? password.hashCode() : 0);

        return result;
    }
}
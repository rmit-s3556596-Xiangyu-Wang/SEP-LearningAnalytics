package rmit.learningAnalytics.model;

import javax.persistence.*;

@Entity
@Table(name = "user", schema = "public")
public class User{


	@Id
	@Column(name = "id", length = 7)
	private Long id;
	
	@Basic
	@Column(name = "user_name")
	String userName;

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
		return userName;
	}

	public void setUserName(String userName) {
		this.userName = userName;
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
        if (userName != null ? !userName.equals(that.userName) : that.userName != null) return false;
        if (password != null ? !password.equals(that.password) : that.password != null) return false;

        return true;
    }
	
	@Override
    public int hashCode() {
        int result = (int) (id ^ (id >>> 32));
        result = 31 * result + (userName != null ? userName.hashCode() : 0);
        result = 31 * result + (password != null ? password.hashCode() : 0);

        return result;
    }
}
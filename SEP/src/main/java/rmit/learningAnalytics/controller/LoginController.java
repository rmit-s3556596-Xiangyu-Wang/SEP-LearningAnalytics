package rmit.learningAnalytics.controller;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.SessionAttributes;
import javax.validation.Valid;

import rmit.learningAnalytics.entites.User;
import rmit.learningAnalytics.repository.UserRepository;
import rmit.learningAnalytics.services.IUserLoginService;
import rmit.learningAnalytics.services.*;

import org.springframework.validation.BindingResult;
import org.springframework.validation.ObjectError;
import java.sql.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpRequest;
import org.springframework.security.core.Authentication;

import java.util.Map;

@Controller
@SessionAttributes("user")
public class LoginController {

	@Autowired
	UserLoginService uls;
	
//	@RequestMapping(value = "/index/login", method = RequestMethod.POST)
//    public String userCheck() {
////		    String userid = request.getParameter("loginName");    
////		    String pwd = request.getParameter("password");
////		    Class.forName("org.postgresql.Driver");
////		    Connection con = DriverManager.getConnection("jdbc:postgresql://ec2-54-221-254-72.compute-1.amazonaws.com:dtb2d40pikkr8",
////		            "znnuybwdzqhavc", "872a6885f75972f76e867e38ceb6a92a27bc81aedc795dbd2e5fa1317119166e");
////		    Statement st = con.createStatement();
////		    ResultSet rs;
////		    rs = st.executeQuery("select * from user where user_name='" + userid + "' and password='" + pwd + "'");
////		    if (rs.next()) {
////		        session.setAttribute("loginName", userid);
////		        //out.println("welcome " + userid);
////		        //out.println("<a href='logout.jsp'>Log out</a>");
////		        response.sendRedirect("home.jsp");
////		    } else {
////		        out.println("Invalid password <a href='index.jsp'>try again</a>");
////		    }
//        return "home";
//    }
	
	@RequestMapping(value="/login", method = {RequestMethod.POST})
	public String login(@Valid @ModelAttribute("user") User user, BindingResult result) {
		if(result.hasErrors()) {
			return "index";
		} else {
			boolean found = uls.findByLogin(user.getUserName(), user.getUserPassword());
			if (found) {
				return "home";
			}
			else return "loginfail";
		}
	}
//    public String login(User user, Model model){
////		uls = new UserLoginService();
//        if(uls.checkLogin(user.getUserName(),user.getPassword())) {
//        	model.addAttribute(user);
//        	return "home";
//        }
//        else
//        	return "loginfail";
//    }
	
	@RequestMapping(value = "/", method = RequestMethod.GET)
    public String index(){
        return "index";
    }
//	@Autowired
//	public LoginService loginService;
//
////	@RequestMapping(method = RequestMethod.GET)
////	public String showForm(Map<String, LoginForm> model) {
////		LoginForm loginForm = new LoginForm();
////		model.put("loginForm", loginForm);
////		return "loginform";
////	}
////	
//	@RequestMapping(value="/", method = RequestMethod.GET)
//	public String login(){
//		return "redirect:views/login.jsp";
//	}
//
////	@RequestMapping(method = RequestMethod.POST)
////	public String processForm(@Valid LoginForm loginForm, BindingResult result, Map<String, LoginForm> model) {
////
////		if (result.hasErrors()) {
////			return "loginform";
////		}
////
////		/*
////		 * String userName = "UserName"; String password = "password"; loginForm =
////		 * (LoginForm) model.get("loginForm"); if
////		 * (!loginForm.getUserName().equals(userName) ||
////		 * !loginForm.getPassword().equals(password)) { return "loginform"; }
////		 */
////		boolean userExists = loginService.checkLogin(loginForm.getUserName(), loginForm.getPassword());
////		if (userExists) {
////			model.put("loginForm", loginForm);
////			return "loginsuccess";
////		} else {
////			result.rejectValue("userName", "invaliduser");
////			return "loginform";
////		}
////
////	}
//	@RequestMapping(method = RequestMethod.POST)
//	public String checkLogin() {
//		return "redirect:success.jsp";
//	}
}

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

	UserLoginService uls;

	private User user;
	
	@Autowired
	UserRepository userRepository;
	
	@RequestMapping(value="/login", method= RequestMethod.GET)
	public String login(Model model) {
		User user = new User();
		model.addAttribute(user);
		return "login";
	}
	
	@RequestMapping(value="/login", method = {RequestMethod.POST})
	public String login(@ModelAttribute("user") User user, BindingResult result) {
		this.user = userRepository.findByUserName(user.getUserName());
		if(result.hasErrors()) {
			return "index";
		} else {
			boolean found = uls.findByUsername(user.getUserName(), user.getUserPassword());
			if (found) {
				return "home";
			}
			else return "loginfail";
		}
	}
	
	@RequestMapping(value = "/", method = RequestMethod.GET)
    public String index(){
        return "index";
    }
}

package rmit.learningAnalytics.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import rmit.learningAnalytics.forms.LoginForm;
import rmit.learningAnalytics.service.LoginService;

import org.springframework.validation.BindingResult;
import org.springframework.validation.ObjectError;

import org.springframework.beans.factory.annotation.Autowired;

import java.util.Map;
import javax.validation.Valid;

@Controller
public class LoginController {

	@Autowired
	public LoginService loginService;

//	@RequestMapping(method = RequestMethod.GET)
//	public String showForm(Map<String, LoginForm> model) {
//		LoginForm loginForm = new LoginForm();
//		model.put("loginForm", loginForm);
//		return "loginform";
//	}
//	
	@RequestMapping(value="/", method = RequestMethod.GET)
	public String login(){
		return "redirect:views/login.jsp";
	}

//	@RequestMapping(method = RequestMethod.POST)
//	public String processForm(@Valid LoginForm loginForm, BindingResult result, Map<String, LoginForm> model) {
//
//		if (result.hasErrors()) {
//			return "loginform";
//		}
//
//		/*
//		 * String userName = "UserName"; String password = "password"; loginForm =
//		 * (LoginForm) model.get("loginForm"); if
//		 * (!loginForm.getUserName().equals(userName) ||
//		 * !loginForm.getPassword().equals(password)) { return "loginform"; }
//		 */
//		boolean userExists = loginService.checkLogin(loginForm.getUserName(), loginForm.getPassword());
//		if (userExists) {
//			model.put("loginForm", loginForm);
//			return "loginsuccess";
//		} else {
//			result.rejectValue("userName", "invaliduser");
//			return "loginform";
//		}
//
//	}
	@RequestMapping(method = RequestMethod.POST)
	public String checkLogin() {
		return "redirect:success.jsp";
	}
}

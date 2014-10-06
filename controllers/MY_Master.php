<?php
	
class MY_Master extends CI_Controller {
	
	public $layout 				   = 'layouts/master';
	public $is_logged_session_name = 'is_logged';
	public $is_admin_session_name  = 'is_admin';
	
	public $error_css_class        = 'alert alert-danger';
	public $message_css_class      = 'alert alert-warning';          

	/**
	  * Display master view with included content and passed params.
	  * 
	  * - To display content inside view '<?php echo $content_view; ?>'
	  */
	public function render($view, $params=[], $messages=[], $errors=[]) {
		
		$data['content_view'] = $view;
		$data['error_css_class'] = $this->error_css_class;
		$data['message_css_class'] = $this->message_css_class;
		$data['is_logged'] = $this->session->userdata($this->is_logged_session_name);
		$data['is_admin']  = $this->session->userdata($this->is_admin_session_name);
		
 		if($this->session->userdata('messages'))
		{
			$data['messages']     = $this->session->userdata('messages');
		}
		if($this->session->userdata('errors'))
		{
			$data['errors'] = $this->session->userdata('errors');
		}
		if(count($messages)>0)
		{
			if($this->session->userdata('messages'))
			{
				$data['messages'] = array_merge($this->session->userdata('messages'), $messages);
			}
			else 
			{
				$data['messages'] = $messages;
			}
		}
		if(count($errors)>0)
		{
			if($this->session->userdata('errors'))
			{
				$data['errors'] = array_merge($this->session->userdata('errors'), $messages);
			}
			else 
			{
				$data['errors'] = $errors;
			}
		}
		$new_data = array_merge($data, $params);
		$this->load->view($this->layout, $new_data);
		
		// remove all messages and errors
		$this->session->unset_userdata('messages');
		$this->session->unset_userdata('errors');
	}
	
	/**
	  * redirect to homepage if not logged
	  */
	public function filter_logged($to='') {
		if($this->session->userdata('is_logged') === FALSE || $this->session->userdata('is_logged') == false)
		{
			redirect($to, 'refresh');
		}
	}
	
	/**
	  * redirect to homepage if not admin
	  */
	public function filter_admin($to='') {
		filter_logged($to);
		
		if($this->session->userdata('is_admin') === FALSE || $this->session->userdata('is_admin') == false)
		{
			redirect($to, 'refresh');
		}
	}
	
	/** 
	  * redirect with messages and errors
	  */
	public function redirect_with($to, $messages=[], $errors=[]) {
		$this->session->set_userdata('messages', $messages);
		$this->session->set_userdata('errors', $errors);
		redirect($to, 'refresh');
	}
}
	
?>
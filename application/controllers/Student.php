<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Student_M");
    }

	public function index()
	{
		
		$companyList = $this->Student_M->get_all_companies();
		$locationList = $this->Student_M->get_all_locations();
		$universityList = $this->Student_M->get_all_universities();

		$eventLocationList = $this->Student_M->get_all_event_locations();

		$result['companyList'] 	= $companyList;
		$result['locationList'] = $locationList;
		$result['universityList'] 	= $universityList;

		$result['eventLocationList'] = $eventLocationList;
		$this->load->view('Student',$result);
	}

	public function get_search_results(){
		$arrayToSend = array(); 
		$company_name 	= trim($this->input->post('companyName')," ");
		$location_name 	= trim($this->input->post('companyLocation')," ");
		$posted_before 	= trim($this->input->post('postedBefore')," ");
		$posted_after  	= trim($this->input->post('postedAfter')," ");
		
		$arrayToSend = $this->Student_M->get_search_results($company_name, $location_name, $posted_before, $posted_after);

		echo $jsonformat=json_encode($arrayToSend);

	}

	public function get_company_uni_stats()
	{
		$uni_id 	= trim($this->input->post('uniId')," ");
		$arrayToSend = $this->Student_M->get_company_uni_stats($uni_id);
		echo $jsonformat=json_encode($arrayToSend);		
	}

	public function get_event_search_results(){
		$company_name 	= trim($this->input->post('eventName')," ");
		$location_name 	= trim($this->input->post('eventLocation')," ");
		$posted_before 	= trim($this->input->post('postedBefore')," ");
		$posted_after  	= trim($this->input->post('postedAfter')," ");

		$arrayToSend = $this->Student_M->get_event_search_results($company_name, $location_name, $posted_before, $posted_after);

		echo $jsonformat=json_encode($arrayToSend);

	}


}

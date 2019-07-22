<?php
class Student_M extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function get_all_companies(){
		$query = "SELECT c.companyId, c.companyName FROM ".COMPANY." c";
		$result = $this->db->query($query);
		$result = $result->result_array();

		return $result;
	}

	public function get_all_locations(){
		$query = "SELECT DISTINCT city, state FROM ".COMPANY." c";
		$result = $this->db->query($query);
		$result = $result->result_array();

		return $result;
	}

	public function get_all_event_locations(){
		$query = "SELECT DISTINCT eventLocation FROM ".CAREER_EVENT."";
		$result = $this->db->query($query);
		$result = $result->result_array();
		
		return $result;
	}
	public function get_search_results($company_name, $location_name, $posted_before, $posted_after){

		$query = "SELECT co.companyId, companyName, city, state, companyEmail, careerName, careerDescription, postingDate, closingDate, jobType FROM ".COMPANY." co JOIN ".CAREER." ca ON co.companyId=ca.companyId ";

		if($company_name !="" || $location_name!="" || $posted_before!="" || $posted_after !=""){

			$query .= "WHERE ";
		}



		if($company_name != ""){
			$query .= "co.companyName='$company_name' AND ";
		}
		if($location_name != ""){

			$city 	= explode(', ',$location_name)[0];
			$state 	= explode(', ',$location_name)[1];
			$query .= "co.city ='$city' AND co.state='$state' AND ";

		}
		if($posted_before != ""){
			$query .= "ca.postingDate <='$posted_before' AND ";
		}
		if($posted_after != ""){
			$query .= "ca.postingDate>='$posted_after'";
		}

		$query = trim($query,"AND ");

		
		$result = $this->db->query($query);
		$result = $result->result_array();

		return $result;

	}

	public function get_company_uni_stats($uni_id){
		$query = "  SELECT c.companyName, count(*) as num FROM [Group0504_03.Company] c 
			JOIN 
				[Group0504_03.Career] ca
				ON c.companyId=ca.companyId
				JOIN
				[Group0504_03.Apply] a
				ON ca.careerNo=a.careerNo
				WHERE 
				a.stdId in (
					SELECT stdId FROM [Group0504_03.Student] s where uniId='$uni_id'
				)
				GROUP BY c.companyName";

		$result = $this->db->query($query);
		$result = $result->result_array();

		return $result;

	}

	public function get_all_universities(){
		$query = "SELECT uniId,uniName FROM ".UNIVERSITY."";

		$result = $this->db->query($query);
		$result = $result->result_array();

		return $result;

	}

	public function get_event_search_results($event_name, $location_name, $posted_before, $posted_after){

		$query = "SELECT co.companyId, companyName, city, state, companyEmail, eventName, eventDescription, eventTime, closingDate, eventLocation FROM ".COMPANY." co JOIN ".CAREER_EVENT." ca ON co.companyId=ca.companySponsor ";

		if($event_name !="" || $location_name!="" || $posted_before!="" || $posted_after !=""){

			$query .= "WHERE ";
		}

		if($event_name != ""){
			$query .= "UPPER(ca.eventName) like UPPER('%$event_name%') AND ";//UPPER(@@VERSION) NOT LIKE '%AZURE%'
		}
		if($location_name != ""){

			$query .= "ca.eventLocation='$location_name' AND ";

		}
		if($posted_before != ""){
			$query .= "ca.eventTime <='$posted_before' AND ";
		}
		if($posted_after != ""){
			$query .= "ca.eventTime>='$posted_after'";
		}

		$query = trim($query,"AND ");

		
		$result = $this->db->query($query);
		$result = $result->result_array();

		return $result;
	}

}
?>
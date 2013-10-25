<?php 

	class In_events_model extends CI_Model {

		public function __construct() {
			$this->load->database();
		}

		public function get_in_events( $id = FALSE ) {

			if( $id === FALSE ) {
				$this->db->select("in_events.*, persons.first_name as persons_first_name, persons.last_name as persons_last_name, organizations.name as organizations_name, events.name as events_name");
				$this->db->from("in_events");
				$this->db->join("persons", "persons.id = in_events.fk_persons" );
				$this->db->join("organizations", "organizations.id = in_events.fk_organizations" );
				$this->db->join("events", "events.id = in_events.fk_events" );
				$query = $this->db->get();
				return $query->result_array();
			} 

			$query = $this->db->get_where( "in_events", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_in_event() {

			$data = array(
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" ),
					"fk_persons" => $this->input->post( "fk_persons" ),
					"fk_organizations" => $this->input->post( "fk_organizations" ),
					"fk_events" => $this->input->post( "fk_events" )
				);

			return $this->db->insert( "in_events", $data );

		}

		public function update_in_event( $id ) {

			$data = array(
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" ),
					"fk_persons" => $this->input->post( "fk_persons" ),
					"fk_organizations" => $this->input->post( "fk_organizations" ),
					"fk_events" => $this->input->post( "fk_events" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "in_events", $data );

		}

		public function delete_in_event( $id ) {

			return $this->db->delete( "in_events", array( "id" => $id ) );

		}

		public function get_persons() {
		
			$query = $this->db->get( "persons" );
			return $query->result_array();
		
		}

		public function get_organizations() {
		
			$query = $this->db->get( "organizations" );
			return $query->result_array();
		
		}

		public function get_events() {

			$query = $this->db->get( "events" );
			return $query->result_array();
		
		}
	}

?>
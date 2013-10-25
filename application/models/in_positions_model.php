<?php 

	class In_positions_model extends CI_Model {

		public function __construct() {
			$this->load->database();
		}

		public function get_in_positions( $id = FALSE ) {

			if( $id === FALSE ) {
				$this->db->select("in_positions.*, persons.first_name as persons_first_name, persons.last_name as persons_last_name, organizations.name as organizations_name, positions.name as positions_name");
				$this->db->from("in_positions");
				$this->db->join("persons", "persons.id = in_positions.fk_persons" );
				$this->db->join("organizations", "organizations.id = in_positions.fk_organizations" );
				$this->db->join("positions", "positions.id = in_positions.fk_positions" );
				$query = $this->db->get();
				return $query->result_array();
			} 

			$query = $this->db->get_where( "in_positions", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_in_position() {

			$data = array(
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" ),
					"fk_persons" => $this->input->post( "fk_persons" ),
					"fk_organizations" => $this->input->post( "fk_organizations" ),
					"fk_positions" => $this->input->post( "fk_positions" )
				);

			return $this->db->insert( "in_positions", $data );

		}

		public function update_in_position( $id ) {

			$data = array(
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" ),
					"fk_persons" => $this->input->post( "fk_persons" ),
					"fk_organizations" => $this->input->post( "fk_organizations" ),
					"fk_positions" => $this->input->post( "fk_positions" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "in_positions", $data );

		}

		public function delete_in_position( $id ) {

			return $this->db->delete( "in_positions", array( "id" => $id ) );

		}

		public function get_persons() {
		
			$query = $this->db->get( "persons" );
			return $query->result_array();
		
		}

		public function get_organizations() {
		
			$query = $this->db->get( "organizations" );
			return $query->result_array();
		
		}

		public function get_positions() {

			$query = $this->db->get( "positions" );
			return $query->result_array();
		
		}
	}

?>
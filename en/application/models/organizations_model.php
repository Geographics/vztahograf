<?php 

	class Organizations_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_organizations( $id = FALSE ) {

			if( $id === FALSE ) {
				$query = $this->db->get( "organizations" );
				$this->db->select("organizations.*, organizations_types.name as organizations_types_name");
				$this->db->from("organizations");
				$this->db->join("organizations_types", "organizations_types.id = organizations.fk_organizations_types" );
				$query = $this->db->get();
				return $query->result_array();
			} 

			$query = $this->db->get_where( "organizations", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_organization() {

			$data = array(
					"abbr" => $this->input->post( "abbr" ),
					"name" => $this->input->post( "name" ),
					"fk_organizations_types" => $this->input->post( "fk_organizations_types" ),
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" )
				);

			return $this->db->insert( "organizations", $data );

		}

		public function update_organization( $id ) {

			$data = array(
					"abbr" => $this->input->post( "abbr" ),
					"name" => $this->input->post( "name" ),
					"fk_organizations_types" => $this->input->post( "fk_organizations_types" ),
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "organizations", $data );

		}

		public function delete_organization( $id ) {

			return $this->db->delete( "organizations", array( "id" => $id ) );

		}

		public function get_organizations_types() {
			$query = $this->db->get( "organizations_types" );
			return $query->result_array();
		}
	}

?>

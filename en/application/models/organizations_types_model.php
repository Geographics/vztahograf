<?php 

	class Organizations_types_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_organizations_types( $id = FALSE ) {

			if( $id === FALSE ) {
				$query = $this->db->get( "organizations_types" );
				return $query->result_array();
			} 

			$query = $this->db->get_where( "organizations_types", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_organizations_type() {

			
			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			return $this->db->insert( "organizations_types", $data );

		}

		public function update_organizations_type( $id ) {

			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "organizations_types", $data );

		}

		public function delete_organizations_type( $id ) {

			return $this->db->delete( "organizations_types", array( "id" => $id ) );

		}
	}

?>

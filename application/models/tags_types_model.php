<?php 

	class Tags_types_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_tags_types( $id = FALSE ) {

			if( $id === FALSE ) {
				$query = $this->db->get( "tags_types" );
				return $query->result_array();
			} 

			$query = $this->db->get_where( "tags_types", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_tags_type() {

			
			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			return $this->db->insert( "tags_types", $data );

		}

		public function update_tags_type( $id ) {

			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "tags_types", $data );

		}

		public function delete_tags_type( $id ) {

			return $this->db->delete( "tags_types", array( "id" => $id ) );

		}
	}

?>

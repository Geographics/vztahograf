<?php 

	class Relations_types_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_relations_types( $id = FALSE ) {

			if( $id === FALSE ) {
				$query = $this->db->get( "relations_types" );
				return $query->result_array();
			} 

			$query = $this->db->get_where( "relations_types", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_relations_type() {

			
			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			return $this->db->insert( "relations_types", $data );

		}

		public function update_relations_type( $id ) {

			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "relations_types", $data );

		}

		public function delete_relations_type( $id ) {

			return $this->db->delete( "relations_types", array( "id" => $id ) );

		}
	}

?>
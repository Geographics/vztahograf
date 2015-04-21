<?php 

	class Positions_types_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_positions_types( $id = FALSE ) {

			if( $id === FALSE ) {
				$query = $this->db->get( "positions_types" );
				return $query->result_array();
			} 

			$query = $this->db->get_where( "positions_types", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_positions_type() {

			
			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			return $this->db->insert( "positions_types", $data );

		}

		public function update_positions_type( $id ) {

			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "positions_types", $data );

		}

		public function delete_positions_type( $id ) {

			return $this->db->delete( "positions_types", array( "id" => $id ) );

		}
	}

?>

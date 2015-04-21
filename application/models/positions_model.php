<?php 

	class Positions_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_positions( $id = FALSE ) {

			if( $id === FALSE ) {
				$this->db->select("positions.*, positions_types.name as positions_types_name");
				$this->db->from("positions");
				$this->db->join("positions_types", "positions_types.id = positions.fk_positions_types" );
				$query = $this->db->get();
				return $query->result_array();
			} 

			$query = $this->db->get_where( "positions", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_position() {

			
			$data = array(
					"name" => $this->input->post( "name" ),
					"fk_positions_types" => $this->input->post( "fk_positions_types" ),
					"description" => $this->input->post( "description" )
				);

			return $this->db->insert( "positions", $data );

		}

		public function update_position( $id ) {

			$data = array(
					"name" => $this->input->post( "name" ),
					"fk_positions_types" => $this->input->post( "fk_positions_types" ),
					"description" => $this->input->post( "description" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "positions", $data );

		}

		public function delete_position( $id ) {

			return $this->db->delete( "positions", array( "id" => $id ) );

		}

		public function get_positions_types() {
			$query = $this->db->get( "positions_types" );
			return $query->result_array();
		}
	}

?>

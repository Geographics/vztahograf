<?php 

	class Events_types_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_events_types( $id = FALSE ) {

			if( $id === FALSE ) {
				$query = $this->db->get( "events_types" );
				return $query->result_array();
			} 

			$query = $this->db->get_where( "events_types", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_events_type() {

			
			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			return $this->db->insert( "events_types", $data );

		}

		public function update_events_type( $id ) {

			$data = array(
					"name" => $this->input->post( "name" ),
					"description" => $this->input->post( "description" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "events_types", $data );

		}

		public function delete_events_type( $id ) {

			return $this->db->delete( "events_types", array( "id" => $id ) );

		}
	}

?>
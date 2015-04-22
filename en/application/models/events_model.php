<?php 

	class Events_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_events( $id = FALSE ) {

			if( $id === FALSE ) {
				$this->db->select("events.*, events_types.name as events_types_name");
				$this->db->from("events");
				$this->db->join("events_types", "events_types.id = events.fk_events_types" );
				$query = $this->db->get();
				return $query->result_array();
			} 

			$query = $this->db->get_where( "events", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_event() {

			
			$data = array(
					"name" => $this->input->post( "name" ),
					"fk_events_types" => $this->input->post( "fk_events_types" ),
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" )
				);

			return $this->db->insert( "events", $data );

		}

		public function update_event( $id ) {

			$data = array(
					"name" => $this->input->post( "name" ),
					"fk_events_types" => $this->input->post( "fk_events_types" ),
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "events", $data );

		}

		public function delete_event( $id ) {

			return $this->db->delete( "events", array( "id" => $id ) );

		}

		public function get_events_types() {
			$query = $this->db->get( "events_types" );
			return $query->result_array();
		}
	}

?>

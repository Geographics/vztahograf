<?php 

	class Persons_model extends CI_Model {

		public function __construct() {

			$this->load->database();

		}

		public function get_persons( $id = FALSE ) {

			if( $id === FALSE ) {
				$query = $this->db->get( "persons" );
				$this->db->select("persons.*, tags_types.name as tags_types_name");
				$this->db->from("persons");
				$this->db->join("tags_types", "tags_types.id = persons.fk_tags_types" );
				$query = $this->db->get();
				return $query->result_array();
			} 

			$query = $this->db->get_where( "persons", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_person() {

			/*$this->load->helper( "url" );
			$slug = url_title( $this->input->post( "title" ), "dash", TRUE );*/

			$data = array(
					"first_name" => $this->input->post( "first_name" ),
					"last_name" => $this->input->post( "last_name" ),
					"title" => $this->input->post( "title" ),
					"fk_tags_types" => $this->input->post( "fk_tags_types" ),
					"date_of_birth" => $this->input->post( "date_of_birth" ),
					"place_of_birth" => $this->input->post( "place_of_birth" ),
					"photo_url" => $this->input->post( "photo_url" ),
					"contact" => $this->input->post( "contact" ),
					"relative" => $this->input->post( "relative" ),
					"property" => $this->input->post( "property" ),
					"description" => $this->input->post( "description" )
				);

			return $this->db->insert( "persons", $data );

		}

		public function update_person( $id ) {

			$data = array(
					"first_name" => $this->input->post( "first_name" ),
					"last_name" => $this->input->post( "last_name" ),
					"title" => $this->input->post( "title" ),
					"fk_tags_types" => $this->input->post( "fk_tags_types" ),
					"date_of_birth" => $this->input->post( "date_of_birth" ),
					"place_of_birth" => $this->input->post( "place_of_birth" ),
					"photo_url" => $this->input->post( "photo_url" ),
					"contact" => $this->input->post( "contact" ),
					"relative" => $this->input->post( "relative" ),
					"property" => $this->input->post( "property" ),
					"description" => $this->input->post( "description" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "persons", $data );

		}

		public function delete_person( $id ) {

			return $this->db->delete( "persons", array( "id" => $id ) );

		}

		public function get_tags_types() {
		
			$query = $this->db->get( "tags_types" );
			return $query->result_array();
		
		}
	}

?>

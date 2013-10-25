<?php 

	class Relations_model extends CI_Model {

		public function __construct() {
			$this->load->database();
		}

		public function get_relations( $id = FALSE ) {

			if( $id === FALSE ) {
				//$query = $this->db->get("relations");
				$this->db->select("relations.*, relations_types.name as relations_types_name");
				$this->db->from("relations");
				$this->db->join("relations_types", "relations_types.id = relations.fk_relations_types" );
				$query = $this->db->get();

				//get info for foreign keys
				$arr = array();
				foreach ($query->result_array() as $row) {

					$firstEntityInfo = $this->getEntityInformation( $row[ "fk_first_entity" ] );
					$secondEntityInfo = $this->getEntityInformation( $row[ "fk_second_entity" ] );

					//normalize column names
					if( !isset( $firstEntityInfo["name"] ) ) {
						$firstEntityInfo["name"] = $firstEntityInfo["first_name"] . " " . $firstEntityInfo["last_name" ];
					}
					if( !isset( $secondEntityInfo["name"] ) ) {
						$secondEntityInfo["name"] = $secondEntityInfo["first_name"] . " " . $secondEntityInfo["last_name" ];
					}

					$row["firstEntityInfo"] = $firstEntityInfo;
					$row["secondEntityInfo"] = $secondEntityInfo;

				    array_push( $arr, $row );
				}

				return $arr;//$query->result_array();
			} 

			$query = $this->db->get_where( "relations", array( "id" => $id ) );
			return $query->row_array();

		}	

		public function set_relations() {

			$data = array(
					"name" => $this->input->post( "name" ),
					"fk_relations_types" => $this->input->post( "fk_relations_types" ),
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" ),
					"fk_first_entity" => $this->input->post( "fk_first_entity" ),
					"fk_second_entity" => $this->input->post( "fk_second_entity" ),
					"direction" => $this->input->post( "direction" )
				);

			return $this->db->insert( "relations", $data );

		}

		public function update_relations( $id ) {

			$data = array(
					"name" => $this->input->post( "name" ),
					"fk_relations_types" => $this->input->post( "fk_relations_types" ),
					"description" => $this->input->post( "description" ),
					"date_of_start" => $this->input->post( "date_of_start" ),
					"date_of_end" => $this->input->post( "date_of_end" ),
					"fk_first_entity" => $this->input->post( "fk_first_entity" ),
					"fk_second_entity" => $this->input->post( "fk_second_entity" ),
					"direction" => $this->input->post( "direction" )
				);

			$this->db->where( "id", $id );
			return $this->db->update( "relations", $data );

		}

		public function delete_relations( $id ) {

			return $this->db->delete( "relations", array( "id" => $id ) );

		}

		public function get_relations_types() {
			$query = $this->db->get( "relations_types" );
			return $query->result_array();
		}

		public function get_persons( $id = FALSE ) {
			if( $id === FALSE ) {
				$query = $this->db->get( "persons" );
				return $query->result_array();
			}

			//$query = $this->db->get_where( "persons", array( "id" => $id ) );
			$this->db->select("persons.*, in_positions.fk_organizations, organizations.abbr as organization_abbr, tags_types.name as tags_types_name");
			$this->db->from("persons");
			$this->db->where( "persons.id", $id );
			$this->db->join( "in_positions", "persons.id = in_positions.fk_persons" );
			$this->db->join( "organizations", "in_positions.fk_organizations = organizations.id" );
			$this->db->join( "tags_types", "persons.fk_tags_types = tags_types.id" );
			$query = $this->db->get();

			//print_r( $this->db->last_query() );
			//print_r( $query->num_rows() );
			//temp - check if something return, if not, probably person missing from in_positions
			if( $query->num_rows() == 0) {
				$query = $this->db->get_where( "persons", array( "id" => $id ) );
			}
		
			return $query->row_array();
		}

		public function get_organizations( $id = FALSE ) {
			if( $id === FALSE ) {
				$query = $this->db->get( "organizations" );
				return $query->result_array();
			}

			$query = $this->db->get_where( "organizations", array( "id" => $id ) );
			return $query->row_array();
		}

		public function get_positions( $id = FALSE ) {
			if( $id === FALSE ) {
				$query = $this->db->get( "positions" );
				return $query->result_array();
			}

			$query = $this->db->get_where( "positions", array( "id" => $id ) );
			return $query->row_array();
		}

		public function getEntityInformation( $idWithTablePrefix ) {

			$dashPosition = strpos( $idWithTablePrefix, "_" );
			$tablePrefix = substr( $idWithTablePrefix, 0, $dashPosition );
			$id = substr( $idWithTablePrefix, $dashPosition+1 );

			$results = null;

			switch( $tablePrefix ) {
				case "pers":
					$results = $this->get_persons( $id );
					break;
				case "org":
					$results  = $this->get_organizations( $id );
					break;
				case "pos":
					$results  = $this->get_positions( $id );
					break;
			}
			return $results;
		}

		public function get_graph_relations() {

			//$query = $this->db->get("relations");
			$this->db->select("relations.*, relations_types.name as relations_types_name");
			$this->db->from("relations");
			$this->db->join("relations_types", "relations_types.id = relations.fk_relations_types" );
			$query = $this->db->get();

			//get info for foreign keys
			$arr = array();
			foreach ($query->result_array() as $row) {

				$firstEntityInfo = $this->getEntityInformation( $row[ "fk_first_entity" ] );
				//print_r( $firstEntityInfo );
				$secondEntityInfo = $this->getEntityInformation( $row[ "fk_second_entity" ] );
				//print_r( $secondEntityInfo );

				//normalize column names
				if( !isset( $firstEntityInfo["name"] ) ) {
					$firstEntityInfo["name"] = $firstEntityInfo["first_name"] . " " . $firstEntityInfo["last_name" ];
				}
				if( !isset( $secondEntityInfo["name"] ) ) {
					$secondEntityInfo["name"] = $secondEntityInfo["first_name"] . " " . $secondEntityInfo["last_name" ];
				}

				$row["firstEntityInfo"] = $firstEntityInfo;
				$row["secondEntityInfo"] = $secondEntityInfo;

			    array_push( $arr, $row );
			}
			
			return $arr;

		}	
	}

?>
<?php
	
	class Relations extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "relations_model" );

		}

		public function index() {

			$data[ "relations" ] = $this->relations_model->get_relations();
			$data[ "title" ] = "Vztahy";

			$this->load->view( "templates/header", $data );
			$this->load->view( "relations/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "in_position" ] = $this->relations_model->get_relations( $id );

			if( empty( $data[ "in_position" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "in_position" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "relations/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř vztah";

			$data[ "persons" ] = $this->relations_model->get_persons();
			$data[ "relations_types" ] = $this->relations_model->get_relations_types();
			$data[ "organizations" ] = $this->relations_model->get_organizations();
			
			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "relations/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->relations_model->set_relations();
				//return to normal page
				redirect( "/relations" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav v pozici";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "relation" ] = $this->relations_model->get_relations( $id );
			$data[ "relations_types" ] = $this->relations_model->get_relations_types();
			$data[ "persons" ] = $this->relations_model->get_persons();
			$data[ "organizations" ] = $this->relations_model->get_organizations();
			$data[ "positions" ] = $this->relations_model->get_positions();

			$this->form_validation->set_rules( "description", "Popis", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "relations/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->relations_model->update_relations( $id );
				redirect( "/relations" );
			}

		}

		public function delete( $id ) {
			$this->relations_model->delete_relations( $id );

			//return to normal page
			redirect( "/relations" );
		}

		
		
	}

?>
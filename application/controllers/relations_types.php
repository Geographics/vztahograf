<?php
	
	class Relations_types extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "relations_types_model" );
		}

		public function index() {

			$data[ "relations_types" ] = $this->relations_types_model->get_relations_types();
			$data[ "title" ] = "Positions types archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "relations_types/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "relations_type" ] = $this->relations_types_model->get_relations_types( $id );

			if( empty( $data[ "relations_type" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "relations_type" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "relations_types/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř nový typ vztahu";

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "relations_types/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->relations_types_model->set_relations_type();
				//return to normal page
				redirect( "/relations_types" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav typ vztahu";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "relations_type" ] = $this->relations_types_model->get_relations_types( $id );

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "relations_types/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->relations_types_model->update_relations_type( $id );
				redirect( "/relations_types" );
			}

		}

		public function delete( $id ) {
			$this->relations_types_model->delete_relations_type( $id );

			//return to normal page
			redirect( "/relations_types" );
		}

		
		
	}

?>
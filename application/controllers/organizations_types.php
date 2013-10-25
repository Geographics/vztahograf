<?php
	
	class Organizations_types extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "organizations_types_model" );
		}

		public function index() {

			$data[ "organizations_types" ] = $this->organizations_types_model->get_organizations_types();
			$data[ "title" ] = "Organizations types archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "organizations_types/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "organizations_type" ] = $this->organizations_types_model->get_organizations_types( $id );

			if( empty( $data[ "organizations_type" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "organizations_type" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "organizations_types/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř nový typ organizace";

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "organizations_types/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->organizations_types_model->set_organizations_type();
				//return to normal page
				redirect( "/organizations_types" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav pozici";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "organizations_type" ] = $this->organizations_types_model->get_organizations_types( $id );

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "organizations_types/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->organizations_types_model->update_organizations_type( $id );
				redirect( "/organizations_types" );
			}

		}

		public function delete( $id ) {
			$this->organizations_types_model->delete_organizations_type( $id );

			//return to normal page
			redirect( "/organizations_types" );
		}

		
		
	}

?>
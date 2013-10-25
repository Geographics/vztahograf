<?php
	
	class Organizations extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "organizations_model" );
		}

		public function index() {

			$data[ "organizations" ] = $this->organizations_model->get_organizations();
			$data[ "title" ] = "Organizations archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "organizations/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "organization" ] = $this->organizations_model->get_organizations( $id );
			
			if( empty( $data[ "organization" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "organization" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "organizations/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř organizaci";
			$data[ "organizations_types" ] = $this->organizations_model->get_organizations_types();

			$this->form_validation->set_rules( "name", "Jméno", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "organizations/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->organizations_model->set_organization();
				//return to normal page
				redirect( "/organizations" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav organizaci";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "organization" ] = $this->organizations_model->get_organizations( $id );
			$data[ "organizations_types" ] = $this->organizations_model->get_organizations_types();

			$this->form_validation->set_rules( "name", "Jméno", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "organizations/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->organizations_model->update_organization( $id );
				redirect( "/organizations" );
			}

		}

		public function delete( $id ) {
			$this->organizations_model->delete_organization( $id );

			//return to normal page
			redirect( "/organizations" );
		}

		
		
	}

?>
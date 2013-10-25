<?php
	
	class Persons extends CI_Controller {

		public function __construct() {

			parent::__construct();
			
			$this->load->helper('url');
			$this->load->model( "persons_model" );
		}

		public function index() {

			$data[ "persons" ] = $this->persons_model->get_persons();
			$data[ "title" ] = "Persons archive";
			
			$this->load->view( "templates/header", $data );
			$this->load->view( "persons/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "person" ] = $this->persons_model->get_persons( $id );

			if( empty( $data[ "person" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "person" ][ "first_name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "persons/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Create a persons item";
			$data[ "fk_tags_types" ] = $this->persons_model->get_tags_types();
			
			$this->form_validation->set_rules( "first_name", "First name", "required" );
			$this->form_validation->set_rules( "last_name", "Last name", "required" );

			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "persons/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->persons_model->set_person();
				//return to normal page
				redirect( "/persons" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Update a persons item";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "person" ] = $this->persons_model->get_persons( $id );
			$data[ "fk_tags_types" ] = $this->persons_model->get_tags_types();
			
			$this->form_validation->set_rules( "first_name", "First name", "required" );
			$this->form_validation->set_rules( "last_name", "Last name", "required" );

			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "persons/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->persons_model->update_person( $id );
				redirect( "/persons" );
			}

		}

		public function delete( $id ) {
			$this->persons_model->delete_person( $id );

			//return to normal page
			redirect( "/persons" );
		}

		
		
	}

?>
<?php
	
	class Events_types extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "events_types_model" );
		}

		public function index() {

			$data[ "events_types" ] = $this->events_types_model->get_events_types();
			$data[ "title" ] = "Events types archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "events_types/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "events_type" ] = $this->events_types_model->get_events_types( $id );

			if( empty( $data[ "events_type" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "events_type" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "events_types/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř nový typ události";

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "events_types/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->events_types_model->set_events_type();
				//return to normal page
				redirect( "/events_types" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav událost";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "events_type" ] = $this->events_types_model->get_events_types( $id );

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "events_types/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->events_types_model->update_events_type( $id );
				redirect( "/events_types" );
			}

		}

		public function delete( $id ) {
			$this->events_types_model->delete_events_type( $id );

			//return to normal page
			redirect( "/events_types" );
		}

		
		
	}

?>
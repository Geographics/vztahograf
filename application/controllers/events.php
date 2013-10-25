<?php
	
	class Events extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "events_model" );
		}

		public function index() {

			$data[ "events" ] = $this->events_model->get_events();
			$data[ "title" ] = "Události archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "events/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "events" ] = $this->events_model->get_events( $id );

			if( empty( $data[ "events" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "events" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "events/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř organizaci";
			$data[ "events_types" ] = $this->events_model->get_events_types();

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "events/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->events_model->set_event();
				//return to normal page
				redirect( "/events" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav organizaci";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "event" ] = $this->events_model->get_events( $id );
			$data[ "events_types" ] = $this->events_model->get_events_types();

			$this->form_validation->set_rules( "name", "Jméno", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "events/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->events_model->update_event( $id );
				redirect( "/events" );
			}

		}

		public function delete( $id ) {
			$this->events_model->delete_event( $id );

			//return to normal page
			redirect( "/events" );
		}

		
		
	}

?>
<?php
	
	class In_events extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "in_events_model" );

		}

		public function index() {

			$data[ "in_events" ] = $this->in_events_model->get_in_events();
			$data[ "title" ] = "In events archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "in_events/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "in_event" ] = $this->in_events_model->get_in_events( $id );

			if( empty( $data[ "in_event" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "in_event" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "in_events/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř V události";

			$data[ "persons" ] = $this->in_events_model->get_persons();
			$data[ "organizations" ] = $this->in_events_model->get_organizations();
			$data[ "events" ] = $this->in_events_model->get_events();

			$this->form_validation->set_rules( "fk_events", "Událost", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "in_events/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->in_events_model->set_in_event();
				//return to normal page
				redirect( "/in_events" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav V události";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "in_event" ] = $this->in_events_model->get_in_events( $id );
			$data[ "persons" ] = $this->in_events_model->get_persons();
			$data[ "organizations" ] = $this->in_events_model->get_organizations();
			$data[ "events" ] = $this->in_events_model->get_events();

			$this->form_validation->set_rules( "fk_events", "Událost", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "in_events/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->in_events_model->update_in_event( $id );
				redirect( "/in_events" );
			}

		}

		public function delete( $id ) {
			$this->in_events_model->delete_in_event( $id );

			//return to normal page
			redirect( "/in_events" );
		}

		
		
	}

?>
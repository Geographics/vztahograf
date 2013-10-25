<?php
	
	class Positions extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "positions_model" );
		}

		public function index() {

			$data[ "positions" ] = $this->positions_model->get_positions();
			$data[ "title" ] = "Positions archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "positions/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "position" ] = $this->positions_model->get_positions( $id );

			if( empty( $data[ "position" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "position" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "positions/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř pozici";
			$data[ "positions_types" ] = $this->positions_model->get_positions_types();

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "positions/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->positions_model->set_position();
				//return to normal page
				redirect( "/positions" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav pozici";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "position" ] = $this->positions_model->get_positions( $id );
			$data[ "positions_types" ] = $this->positions_model->get_positions_types();

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "positions/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->positions_model->update_position( $id );
				redirect( "/positions" );
			}

		}

		public function delete( $id ) {
			$this->positions_model->delete_position( $id );

			//return to normal page
			redirect( "/positions" );
		}

		
		
	}

?>
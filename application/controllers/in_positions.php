<?php
	
	class In_positions extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "in_positions_model" );

		}

		public function index() {

			$data[ "in_positions" ] = $this->in_positions_model->get_in_positions();
			$data[ "title" ] = "In positions archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "in_positions/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "in_position" ] = $this->in_positions_model->get_in_positions( $id );

			if( empty( $data[ "in_position" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "in_position" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "in_positions/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř Ve funkci";

			$data[ "persons" ] = $this->in_positions_model->get_persons();
			$data[ "organizations" ] = $this->in_positions_model->get_organizations();
			$data[ "positions" ] = $this->in_positions_model->get_positions();

			$this->form_validation->set_rules( "fk_persons", "Jméno", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "in_positions/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->in_positions_model->set_in_position();
				//return to normal page
				redirect( "/in_positions" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav v pozici";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "in_position" ] = $this->in_positions_model->get_in_positions( $id );
			$data[ "persons" ] = $this->in_positions_model->get_persons();
			$data[ "organizations" ] = $this->in_positions_model->get_organizations();
			$data[ "positions" ] = $this->in_positions_model->get_positions();

			$this->form_validation->set_rules( "fk_persons", "Jméno", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "in_positions/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->in_positions_model->update_in_position( $id );
				redirect( "/in_positions" );
			}

		}

		public function delete( $id ) {
			$this->in_positions_model->delete_in_position( $id );

			//return to normal page
			redirect( "/in_positions" );
		}

		
		
	}

?>
<?php
	
	class Positions_types extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "positions_types_model" );
		}

		public function index() {

			$data[ "positions_types" ] = $this->positions_types_model->get_positions_types();
			$data[ "title" ] = "Positions types archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "positions_types/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "positions_type" ] = $this->positions_types_model->get_positions_types( $id );

			if( empty( $data[ "positions_type" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "positions_type" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "positions_types/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř nový typ funkce";

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "positions_types/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->positions_types_model->set_positions_type();
				//return to normal page
				redirect( "/positions_types" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav funkci";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "positions_type" ] = $this->positions_types_model->get_positions_types( $id );

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "positions_types/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->positions_types_model->update_positions_type( $id );
				redirect( "/positions_types" );
			}

		}

		public function delete( $id ) {
			$this->positions_types_model->delete_positions_type( $id );

			//return to normal page
			redirect( "/positions_types" );
		}

		
		
	}

?>
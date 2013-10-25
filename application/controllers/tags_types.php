<?php
	
	class Tags_types extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "tags_types_model" );
		}

		public function index() {

			$data[ "tags_types" ] = $this->tags_types_model->get_tags_types();
			$data[ "title" ] = "tags types archive";

			$this->load->view( "templates/header", $data );
			$this->load->view( "tags_types/index", $data );
			$this->load->view( "templates/footer" );

		}

		public function view( $id ) {

			$data[ "tags_type" ] = $this->tags_types_model->get_tags_types( $id );

			if( empty( $data[ "tags_type" ] ) ) {
				show_404();
			}

			$data[ "title" ] = $data[ "tags_type" ][ "name" ];

			$this->load->view( "templates/header", $data );
			$this->load->view( "tags_types/view", $data );
			$this->load->view( "templates/footer", $data );

		}

		public function create() {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Vytvoř nový typ štítku";

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "tags_types/create" );
				$this->load->view( "templates/footer" );
			} else {
				$this->tags_types_model->set_tags_type();
				//return to normal page
				redirect( "/tags_types" );
			}

		}

		public function update( $id ) {

			$this->load->helper( "form" );
			$this->load->library( "form_validation" );

			$data[ "title" ] = "Uprav štítek";
			$data[ "id" ] = $id;

			//get data to populate the form
			$data[ "tags_type" ] = $this->tags_types_model->get_tags_types( $id );

			$this->form_validation->set_rules( "name", "Název", "required" );
			
			if( $this->form_validation->run() === FALSE ) {
				$this->load->view( "templates/header", $data );
				$this->load->view( "tags_types/update" );
				$this->load->view( "templates/footer" );
			} else {
				$this->tags_types_model->update_tags_type( $id );
				redirect( "/tags_types" );
			}

		}

		public function delete( $id ) {
			$this->tags_types_model->delete_tags_type( $id );

			//return to normal page
			redirect( "/tags_types" );
		}

		
		
	}

?>
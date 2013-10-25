<?php
	
	class Graph extends CI_Controller {

		public function __construct() {

			parent::__construct();

			$this->load->helper('url');
			$this->load->model( "relations_model" );
		}

		public function index() {

			$data[ "title" ] = "Graph";
			$data[ "relations" ] = $this->relations_model->get_graph_relations();

			$this->load->view( "graph/index", $data );
			
		}
		
	}

?>
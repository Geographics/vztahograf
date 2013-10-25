<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>VZTAHOGRAF</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  		<link href="<?php echo base_url(); ?>css/normalize.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
		
        <link href="<?php echo base_url(); ?>css/spritesheet.css" rel="stylesheet" type="text/css" />
        <!--<link href="<?php echo base_url(); ?>css/2@spritesheet.css" rel="stylesheet" type="text/css" media="(-webkit-min-device-pixel-ratio: 2) and (min-resolution: 192dpi)" />
		-->

        <link href="<?php echo base_url(); ?>css/graph.css" rel="stylesheet" type="text/css" />

        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>

        <script src="<?php echo base_url(); ?>js/vendor/modernizr-2.6.2.min.js"></script>

        <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
        <!-- <script src="http://codeorigin.jquery.com/jquery-1.10.2.js"></script> -->
       
    </head>
    <body>
    	<header class="clearfix">
    		<h1 class="ir logo">Vztahograf beta</h1>
    		<div id="controls-panel">
				<div id="group-panel" class="panel">
					<a href="#" class="group-btn btn">Seskupit <span class="dropdown-arrow-down"></span></a>
					<div class="control-menu">
						<input type="radio" name="group-radio-group" value="relations" checked="true">Vzájemné vztahy<br />
						<input type="radio" name="group-radio-group" value="parties">Politická příslušnost<br />
						<input type="radio" name="group-radio-group" value="tags">Povolání osoby
					</div>
				</div>
				<div id="filter-panel" class="panel">
					<a href="#" class="filter-btn btn">Filtrovat <span class="dropdown-arrow-down"></span></a>
					<div class="control-menu">
						<input type="checkbox" name="types" value="KauzalityNodePersonType" checked="true"/> Osoby<br />
						<input type="checkbox" name="types" value="KauzalityOrganizationType" checked="true"/> Organizace
					</div>
				</div>
				<div id="about-panel" class="panel">
					<a href="o-datech" class="about-btn btn" title="O Vztahografu">O Vztahografu</a>
				</div>
			</div>
		</header>

		<div id="popup-box">
		    <h2>hello hello</h2>
		    <ul></ul>
		</div>
		<div id="list-panel">
			<div class="total header clearfix"><span></span><h2>Záznamů v grafu</h2></div>
		</div>
		<div id="zoom-panel" class="panel">
			<a href="#" class="zoom-in zoom-btn" title="Přiblížit"><span class="zoom-in-icon"></span></a>
			<a href="#" class="zoom-out zoom-btn" title="Oddálit"><span class="zoom-out-icon"></span></a>
		</div>
		
		<div id="about-page" class="clearfix">
			<a href="#" class="about-page-close-btn ir" title="Zavřít O Vztahografu">Zavřít</a>
			<h2>O Vztahografu</h2>
			<p>všechna data pochází z “Mapy české korupce” vytvořené Nadačním fondem proti korupci na <a href="http://www.nfpk.cz/_userfiles/soubory/mapa/4_graf.pdf" target="_blank" title="Zdroj dat">tadytom linku.</a></p>
		</div>


		<script type="text/javascript" src="<?php echo base_url(); ?>js/vendor/d3.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/globals.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/shims.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/utils/OrganizationsUtil.js"></script>
		
		<script type="text/javascript" src="<?php echo base_url(); ?>js/Links.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/Link.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/Nodes.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/Node.js"></script>
		
		<script type="text/javascript" src="<?php echo base_url(); ?>js/FilterPanel.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/GroupPanel.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/PopupBox.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/Graph.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/Panel.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/App.js"></script>

		<script>

			var linkData = <?php echo json_encode($relations); ?>;
			var app = new Kauzality.App();
			app.init( linkData );

		</script>

</body>
</html>
<?php 
	$compiledCss = true;
	$compiledJs = true;
?>

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
        <meta content="width=1200" name="viewport">

        <?php if ($compiledCss): ?>
        	<link href="<?php echo base_url(); ?>css/styles.css" rel="stylesheet" type="text/css" />
	    <?php else: ?>
        	<link href="<?php echo base_url(); ?>css/jquery.jscrollpane.css" rel="stylesheet" type="text/css" />
	        <link href="<?php echo base_url(); ?>css/normalize.css" rel="stylesheet" type="text/css" />
	        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
			<link href="<?php echo base_url(); ?>css/spritesheet.css" rel="stylesheet" type="text/css" />-->
	        <!--<link href="<?php echo base_url(); ?>css/2@spritesheet.css" rel="stylesheet" type="text/css" media="(-webkit-min-device-pixel-ratio: 2) and (min-resolution: 192dpi)" />
			-->
			<link href="<?php echo base_url(); ?>css/graph.css" rel="stylesheet" type="text/css" />
		<?php endif; ?>
        
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
				<div id="color-panel" class="panel">
					<a href="#" class="color-btn btn">Rozlišit <span class="dropdown-arrow-down"></span></a>
					<div class="control-menu">
						<input type="radio" name="color-radio-group" value="parties" checked="true">Politická příslušnost<br />
						<input type="radio" name="color-radio-group" value="tags">Povolání osoby
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
					<a href="o-datech" class="about-btn btn" title="O Vztahografu">O projektu</a>
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
			<article>
				<h2>Mapování korupce</h2>
				<p>Korupce má v České republice zásdní vliv na hospodaření s veřejnými prostředky a její spletitý systém 
				dosahuje až do pater nejvyšší politiky. Orientace v takovém prostředí je velmi složitá a jeho mapováním se 
				zabývá jen hrstka lidí. Věříme, že vytvořením silného nástroje pro mapování takového prostředí se dá alespoň 
				část korupčního jednání zastavit.</p>
			</article>
			<article>
				<h2>Aplikace</h2>
				<p>Vztahograf je zkušební betaverzí a odrazovým můstkem připravované aplikace Kauzality. Ta bude obsahovat 
				mnohem širší možnosti zobrazení dat, více komplexních analytických nástrojů a řadu dalších funkcí, které 
				zde chybí a víme o tom.</p>
			</article>
			<article>
				<h2>Data</h2>
				<p>Všechna zdrojová data pochází především z dokumentu <a href="http://www.nfpk.cz/_userfiles/soubory/mapa/4_graf.pdf" target="_blank" title="Zdroj dat">Mapa české korupce</a> a dalších menších dokumentů 
				sestavených Nadačním fondem proti korupci. Dokumenty jsou dostupné na  <a href="http://www.nfpk.cz/mapa" target="_blank" title="Mapa korupce NFPK">webu NFPK</a>. Open verze těchto dat je 
				ke stažení <a href="<?php echo site_url('data'); ?>" target="_blank" title="Open data">zde</a>.</p>
			</article>
		</div>

		<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/vendor/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/vendor/jquery.mousewheel.js"></script>
		-->
		
		<?php if ($compiledJs): ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/scripts-ck.js"></script>
		<?php else: ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/vendor/d3.min.js"></script>
		
			<script type="text/javascript" src="<?php echo base_url(); ?>js/globals.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/shims.js"></script>

			<script type="text/javascript" src="<?php echo base_url(); ?>js/utils/OrganizationsUtil.js"></script>
			
			<script type="text/javascript" src="<?php echo base_url(); ?>js/Links.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/Link.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/Nodes.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/Node.js"></script>
			
			<script type="text/javascript" src="<?php echo base_url(); ?>js/FilterPanel.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/ColorPanel.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/GroupPanel.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/PopupBox.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/Graph.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/Panel.js"></script>

			<script type="text/javascript" src="<?php echo base_url(); ?>js/App.js"></script>
		<?php endif; ?>

		<script>

			var linkData = <?php echo json_encode($relations); ?>;
			var app = new Kauzality.App();
			app.init( linkData );

			/*$(function()
			{
				$('#list-panel').jScrollPane();
			});*/

		</script>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-45172769-1', 'geographics.cz');
		  ga('send', 'pageview');

		</script>

</body>
</html>
<h2>Zdrojová data</h2>
<table>
	<tr>
		<th>Název</th>
		<th>Typ</th>
		<th>První aktér</th>
		<th>První aktér - organizace</th>
		<th>První aktér - typ povolání</th>
		<th>Druhý aktér</th>
		<th>Druhý aktér - organizace</th>
		<th>Druhý aktér - typ povolání</th>
		<th>Směr</th>
	</tr>

	<?php foreach( $relations as $relation ) : ?>

		<?php 
			$firstOrganization = ( isset( $relation["firstEntityInfo"]["organization_abbr"] ) ) ? $relation["firstEntityInfo"]["organization_abbr"] : "-";
			$firstTag = ( isset( $relation["firstEntityInfo"]["fk_tags_type"] ) ) ? $relation["firstEntityInfo"]["fk_tags_type"] : "-";
			$secondOrganization = ( isset( $relation["secondEntityInfo"]["organization_abbr"] ) ) ? $relation["secondEntityInfo"]["organization_abbr"] : "-";
			$secondTag = ( isset( $relation["secondEntityInfo"]["fk_tags_type"] ) ) ? $relation["secondEntityInfo"]["fk_tags_type"] : "-";
		?>
		<tr>
			<td><?php echo $relation["name"]; ?></td>
			<td><?php echo $relation["relations_types_name"]; ?></td>
			<td><?php echo $relation["firstEntityInfo"]["name"]; ?></td>
			<td><?php echo $firstOrganization; ?></td>
			<td><?php echo $firstTag; ?></td>
			<td><?php echo $relation["secondEntityInfo"]["name"]; ?></td>
			<td><?php echo $secondOrganization; ?></td>
			<td><?php echo $secondTag; ?></td>
			<td><?php echo $relation["direction"]; ?></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-45172769-1', 'geographics.cz');
	ga('send', 'pageview');
</script>

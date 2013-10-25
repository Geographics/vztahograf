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
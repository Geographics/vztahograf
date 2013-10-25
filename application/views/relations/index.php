<h2>Vztah (tabulka Relations)</h2>
<a href="relations/create">Vytvoř nový vztah</a>
<table>
	<tr>
		<th>Id</th>
		<th>Název</th>
		<th>Typ</th>
		<th>Popis</th>
		<th>Vznik</th>
		<th>Zánik</th>
		<th>První aktér</th>
		<th>Druhý aktér</th>
		<th>Směr</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $relations as $relation ) : ?>

		<tr>
			<td><?php echo $relation["id"]; ?></td>
			<td><?php echo $relation["name"]; ?></td>
			<td><?php echo $relation["fk_relations_types"] . " - " . $relation["relations_types_name"]; ?></td>
			<td><?php echo $relation["description"]; ?></td>
			<td><?php echo $relation["date_of_start"]; ?></td>
			<td><?php echo $relation["date_of_end"]; ?></td>
			<td><?php echo $relation["fk_first_entity"] . " - " .$relation["firstEntityInfo"]["name"]; ?></td>
			<td><?php echo $relation["fk_second_entity"]  . " - " .$relation["secondEntityInfo"]["name"]; ?></td>
			<td><?php echo $relation["direction"]; ?></td>
			<td class="update"><a href="relations/update/<?php echo $relation['id']; ?>">Update</a></td>
			<td class="delete"><a href="relations/delete/<?php echo $relation['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
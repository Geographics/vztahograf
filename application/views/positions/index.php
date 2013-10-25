<h2>Funkce (tabulka Positions)</h2>
<a href="positions/create">Vytvoř novou funkci</a>
<table>
	<tr>
		<th>Id</th>
		<th>Jméno</th>
		<th>Typ</th>
		<th>Popis</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $positions as $position ) : ?>

		<tr>
			<td><?php echo $position["id"]; ?></td>
			<td><?php echo $position["name"]; ?></td>
			<td><?php echo $position["fk_positions_types"] . " - " . $position["positions_types_name"]; ?></td>
			<td><?php echo $position["description"]; ?></td>
			<td class="update"><a href="positions/update/<?php echo $position['id']; ?>">Update</a></td>
			<td class="delete"><a href="positions/delete/<?php echo $position['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
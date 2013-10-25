<h2>Typy funkcí (tabulka Positions_types)</h2>
<a href="positions_types/create">Vytvoř nový typ funkce</a>
<table>
	<tr>
		<th>Id</th>
		<th>Název</th>
		<th>Popis</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $positions_types as $positions_type ) : ?>

		<tr>
			<td><?php echo $positions_type["id"]; ?></td>
			<td><?php echo $positions_type["name"]; ?></td>
			<td><?php echo $positions_type["description"]; ?></td>
			<td class="update"><a href="positions_types/update/<?php echo $positions_type['id']; ?>">Update</a></td>
			<td class="delete"><a href="positions_types/delete/<?php echo $positions_type['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
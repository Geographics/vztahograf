<h2>Typy událostí (tabulka Events_types)</h2>
<a href="events_types/create">Vytvoř nový typ události</a>
<table>
	<tr>
		<th>Id</th>
		<th>Název</th>
		<th>Popis</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $events_types as $events_type ) : ?>

		<tr>
			<td><?php echo $events_type["id"]; ?></td>
			<td><?php echo $events_type["name"]; ?></td>
			<td><?php echo $events_type["description"]; ?></td>
			<td class="update"><a href="events_types/update/<?php echo $events_type['id']; ?>">Update</a></td>
			<td class="delete"><a href="events_types/delete/<?php echo $events_type['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
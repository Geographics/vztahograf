<h2>Události (tabulka Events)</h2>
<a href="events/create">Vytvoř novou událost</a>
<table>
	<tr>
		<th>Id</th>
		<th>Název</th>
		<th>Typ</th>
		<th>Popis</th>
		<th>Vznik</th>
		<th>Zánik</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $events as $event ) : ?>

		<tr>
			<td><?php echo $event["id"]; ?></td>
			<td><?php echo $event["name"]; ?></td>
			<td><?php echo $event["fk_events_types"] . " - " . $event["events_types_name"]; ?></td>
			<td><?php echo $event["description"]; ?></td>
			<td><?php echo $event["date_of_start"]; ?></td>
			<td><?php echo $event["date_of_end"]; ?></td>
			<td class="update"><a href="events/update/<?php echo $event['id']; ?>">Update</a></td>
			<td class="delete"><a href="events/delete/<?php echo $event['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
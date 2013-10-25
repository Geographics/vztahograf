<h2>V události (tabulka In_Events)</h2>
<a href="in_events/create">Vytvoř nové V události</a>
<table>
	<tr>
		<th>Id</th>
		<th>Osoba</th>
		<th>Organizace</th>
		<th>Událost</th>
		<th>Popis</th>
		<th>Vznik</th>
		<th>Zánik</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $in_events as $in_event ) : ?>

		<tr>
			<td><?php echo $in_event["id"]; ?></td>
			<td><?php echo $in_event["fk_persons"] . " - " . $in_event["persons_first_name"] . " " . $in_event["persons_last_name"]; ?></td>
			<td><?php echo $in_event["fk_organizations"] . " - " . $in_event["organizations_name"]; ?></td>
			<td><?php echo $in_event["fk_events"] . " - " . $in_event["events_name"]; ?></td>
			<td><?php echo $in_event["description"]; ?></td>
			<td><?php echo $in_event["date_of_start"]; ?></td>
			<td><?php echo $in_event["date_of_end"]; ?></td>
			<td class="update"><a href="in_events/update/<?php echo $in_event['id']; ?>">Update</a></td>
			<td class="delete"><a href="in_events/delete/<?php echo $in_event['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
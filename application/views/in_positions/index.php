<h2>Ve funkci (tabulka In_Positions)</h2>
<a href="in_positions/create">Vytvoř nové Ve funkci</a>
<table>
	<tr>
		<th>Id</th>
		<th>Osoba</th>
		<th>Funkce</th>
		<th>Organizace</th>
		<th>Popis</th>
		<th>Vznik</th>
		<th>Zánik</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $in_positions as $in_position ) : ?>

		<tr>
			<td><?php echo $in_position["id"]; ?></td>
			<td><?php echo $in_position["fk_persons"] . " - " . $in_position["persons_first_name"] . " " . $in_position["persons_last_name"]; ?></td>
			<td><?php echo $in_position["fk_positions"] . " - " . $in_position["positions_name"]; ?></td>
			<td><?php echo $in_position["fk_organizations"] . " - " . $in_position["organizations_name"]; ?></td>
			<td><?php echo $in_position["description"]; ?></td>
			<td><?php echo $in_position["date_of_start"]; ?></td>
			<td><?php echo $in_position["date_of_end"]; ?></td>
			<td class="update"><a href="in_positions/update/<?php echo $in_position['id']; ?>">Update</a></td>
			<td class="delete"><a href="in_positions/delete/<?php echo $in_position['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
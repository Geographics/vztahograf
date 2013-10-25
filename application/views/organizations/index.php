<h2>Organizace (tabulka Organizations)</h2>
<a href="organizations/create">Vytvoř novou organizaci</a>
<table>
	<tr>
		<th>Id</th>
		<th>Zkratka</th>
		<th>Jméno</th>
		<th>Typ</th>
		<th>Popis</th>
		<th>Vznik</th>
		<th>Zánik</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $organizations as $organization ) : ?>

		<tr>
			<td><?php echo $organization["id"]; ?></td>
			<td><?php echo $organization["abbr"]; ?></td>
			<td><?php echo $organization["name"]; ?></td>
			<td><?php echo $organization["fk_organizations_types"] . " - " . $organization["organizations_types_name"]; ?></td>
			<td><?php echo $organization["description"]; ?></td>
			<td><?php echo $organization["date_of_start"]; ?></td>
			<td><?php echo $organization["date_of_end"]; ?></td>
			<td class="update"><a href="organizations/update/<?php echo $organization['id']; ?>">Update</a></td>
			<td class="delete"><a href="organizations/delete/<?php echo $organization['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
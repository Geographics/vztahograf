<h2>Typy organizací (tabulka Organizations_types)</h2>
<a href="organizations_types/create">Vytvoř nový typ organizace</a>
<table>
	<tr>
		<th>Id</th>
		<th>Název</th>
		<th>Popis</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $organizations_types as $organization_type ) : ?>

		<tr>
			<td><?php echo $organization_type["id"]; ?></td>
			<td><?php echo $organization_type["name"]; ?></td>
			<td><?php echo $organization_type["description"]; ?></td>
			<td class="update"><a href="organizations_types/update/<?php echo $organization_type['id']; ?>">Update</a></td>
			<td class="delete"><a href="organizations_types/delete/<?php echo $organization_type['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
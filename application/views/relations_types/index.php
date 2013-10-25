<h2>Typy vztahů (tabulka Relations_types)</h2>
<a href="relations_types/create">Vytvoř nový typ vztahu</a>
<table>
	<tr>
		<th>Id</th>
		<th>Název</th>
		<th>Popis</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $relations_types as $relations_type ) : ?>

		<tr>
			<td><?php echo $relations_type["id"]; ?></td>
			<td><?php echo $relations_type["name"]; ?></td>
			<td><?php echo $relations_type["description"]; ?></td>
			<td class="update"><a href="relations_types/update/<?php echo $relations_type['id']; ?>">Update</a></td>
			<td class="delete"><a href="relations_types/delete/<?php echo $relations_type['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
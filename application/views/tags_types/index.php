<h2>Typy štítků (tabulka Tags_types)</h2>
<a href="tags_types/create">Vytvoř nový typ štítku</a>
<table>
	<tr>
		<th>Id</th>
		<th>Název</th>
		<th>Popis</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $tags_types as $tag_type ) : ?>

		<tr>
			<td><?php echo $tag_type["id"]; ?></td>
			<td><?php echo $tag_type["name"]; ?></td>
			<td><?php echo $tag_type["description"]; ?></td>
			<td class="update"><a href="tags_types/update/<?php echo $tag_type['id']; ?>">Update</a></td>
			<td class="delete"><a href="tags_types/delete/<?php echo $tag_type['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
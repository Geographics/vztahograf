<h2>Osoby (tabulka Persons)</h2>
<a href="persons/create">Vytvoř novou osobu</a>
<table>
	<tr>
		<th>Id</th>
		<th>Titul</th>
		<th>Štítek</th>
		<th>Jméno</th>
		<th>Příjmení</th>
		<th>Datum narození</th>
		<th>Místo narození</th>
		<th>URL fotky</th>
		<th>Kontakt</th>
		<th>Příbuzní</th>
		<th>Majetkové přiznání</th>
		<th>Popis</th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach( $persons as $person ) : ?>

		<?php $name = $person["first_name"] . " " . $person["last_name"]; ?>

		<tr>
			<td><?php echo $person["id"]; ?></td>
			<td><?php echo $person["title"]; ?></td>
			<td><?php echo $person["fk_tags_types"] . " - " . $person["tags_types_name"];  ?></td>
			<td><?php echo $person["first_name"]; ?></td>
			<td><?php echo $person["last_name"]; ?></td>
			<td><?php echo $person["date_of_birth"]; ?></td>
			<td><?php echo $person["place_of_birth"]; ?></td>
			<td><?php echo $person["photo_url"]; ?></td>
			<td><?php echo $person["contact"]; ?></td>
			<td><?php echo $person["relative"]; ?></td>
			<td><?php echo $person["property"]; ?></td>
			<td><?php echo $person["description"]; ?></td>
			<td class="update"><a href="persons/update/<?php echo $person['id']; ?>">Update</a></td>
			<td class="delete"><a href="persons/delete/<?php echo $person['id']; ?>">Delete</a></td>
		</tr>

	<?php endforeach ?>
</table>

<script>
	
	$( document ).ready( function() {
		initTable();
	});

</script>
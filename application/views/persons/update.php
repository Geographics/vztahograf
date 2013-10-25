<h2>Osoby (tabulka Persons)</h2>
<h3>Uprav osobu</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('persons/update/' . $id ) ?>
	<label for="first_name">Jméno</label>
	<input type="input" name="first_name" value="<?php echo $person['first_name']; ?>"/><br />

	<label for="last_name">Příjmení</label>
	<input type="input" name="last_name" value="<?php echo $person['last_name']; ?>"/><br />

	<label for="title">Titul</label>
	<input type="input" name="title" value="<?php echo $person['title']; ?>"/><br />

	<label for="fk_tags_types">Štítek</label>
	<select name="fk_tags_types">
		<?php foreach( $fk_tags_types as $fk_tags_type ) : ?>	
			<option value="<?php echo $fk_tags_type['id']; ?>" <?php if( $fk_tags_type["id"] == $person["fk_tags_types"] ) echo "selected";?>><?php echo $fk_tags_type["id"] . " - " . $fk_tags_type["name"] ; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="date_of_birth">Datum narození</label>
	<input type="date" name="date_of_birth" value="<?php echo date( "Y-m-d", strtotime( $person['date_of_birth'] ) ); ?>"/><br />

	<label for="place_of_birth">Místo narození</label>
	<input type="input" name="place_of_birth" value="<?php echo $person['place_of_birth']; ?>"/><br />

	<label for="photo_url">URL fotky</label>
	<input type="input" name="photo_url" value="<?php echo $person['photo_url']; ?>"/><br />

	<label for="contact">Kontakt</label>
	<input type="input" name="contact" value="<?php echo $person['contact']; ?>"/><br />

	<label for="relative">Příbuzní</label>
	<input type="input" name="relative" value="<?php echo $person['relative']; ?>"/><br />

	<label for="property">Majetkové přiznání</label>
	<input type="input" name="property" value="<?php echo $person['property']; ?>"/><br />

	<label for="description">Popis</label>
	<input type="input" name="description" value="<?php echo $person['description']; ?>"/><br />

	<input type="submit" name="submit" value="Uprav osobu" />

</form>

<script>
	
	$( document ).ready( function() {
		initForm();
	});

</script>
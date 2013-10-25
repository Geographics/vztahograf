<h2>Osoby (tabulka Persons)</h2>
<h3>Vytvoř osobu</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('persons/create') ?>

	<label for="first_name">Jméno</label>
	<input type="input" name="first_name" /><br />

	<label for="last_name">Příjmení</label>
	<input type="input" name="last_name" /><br />

	<label for="title">Titul</label>
	<input type="input" name="title" /><br />

	<label for="fk_tags_types">Štítek</label>
	<select name="fk_tags_types">
		<?php foreach( $fk_tags_types as $fk_tags_type ) : ?>	
			<option value="<?php echo $fk_tags_type['id']; ?>"><?php echo $fk_tags_type["id"] . " - " . $fk_tags_type["name"] ; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="date_of_birth">Datum narození</label>
	<input type="date" name="date_of_birth" /><br />

	<label for="place_of_birth">Místo narození</label>
	<input type="input" name="place_of_birth" /><br />

	<label for="photo_url">URL fotky</label>
	<input type="input" name="photo_url" /><br />

	<label for="contact">Kontakt</label>
	<input type="input" name="contact" /><br />

	<label for="relative">Příbuzní</label>
	<input type="input" name="relative" /><br />

	<label for="property">Majetkové přiznání</label>
	<input type="input" name="property" /><br />

	<label for="description">Popis</label>
	<input type="input" name="description" /><br />

	<input type="submit" name="submit" value="Vytvoř osobu" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
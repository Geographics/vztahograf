<h2>Organizace (tabulka Organizations)</h2>
<h3>Vytvoř organizaci</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('organizations/create') ?>
	
	<label for="abbr">Zkratka</label>
	<input type="input" name="abbr" /><br />

	<label for="name">Název</label>
	<input type="input" name="name" /><br />

	<label for="fk_organizations_types">Typ</label>
	<select name="fk_organizations_types">
		<?php foreach( $organizations_types as $organizations_type ) : ?>	
			<option value="<?php echo $organizations_type['id']; ?>"><?php echo $organizations_type["id"] . " - " . $organizations_type["name"] ; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="description">Popis</label>
	<textarea name="description"></textarea><br />

	<label for="date_of_start">Datum vzniku</label>
	<input type="date" name="date_of_start" /><br />

	<label for="date_of_end">Datum zániku</label>
	<input type="date" name="date_of_end" /><br />

	<input type="submit" name="submit" value="Vytvoř novou organizaci" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
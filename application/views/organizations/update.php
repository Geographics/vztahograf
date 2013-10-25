<h2>Organizace (tabulka Organizations)</h2>
<h3>Uprav organizaci</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('organizations/update/' .$id ) ?>
	
	<label for="abbr">Zkratka</label>
	<input type="input" name="abbr" value="<?php echo $organization['abbr']; ?>"/><br />

	<label for="name">Název</label>
	<input type="input" name="name" value="<?php echo $organization['name']; ?>"/><br />

	<label for="fk_organizations_types">Typ</label>
	<select name="fk_organizations_types">
		<?php foreach( $organizations_types as $organizations_type ) : ?>	
			<option value="<?php echo $organizations_type['id']; ?>" <?php if( $organizations_type["id"] == $organization["fk_organizations_types"] ) echo "selected";?>><?php echo $organizations_type["id"] . " - " . $organizations_type["name"] ; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="description">Popis</label>
	<textarea name="description"><?php echo $organization['description']; ?></textarea>

	<label for="date_of_start">Datum vzniku</label>
	<input type="date" name="date_of_start" value="<?php echo date( "Y-m-d", strtotime( $organization['date_of_start'] ) ); ?>"/><br />

	<label for="date_of_end">Datum zániku</label>
	<input type="date" name="date_of_end" value="<?php echo date( "Y-m-d", strtotime( $organization['date_of_end'] ) ); ?>"/><br />

	<input type="submit" name="submit" value="Uprav organizaci" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
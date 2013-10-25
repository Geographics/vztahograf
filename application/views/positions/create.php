<h2>Funkce (tabulka Positions)</h2>
<h3>Vytvoř novou funkci</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('positions/create') ?>
	
	<label for="name">Název</label>
	<input type="input" name="name" /><br />

	<label for="fk_positions_types">Typ</label>
	<select name="fk_positions_types">
		<?php foreach( $positions_types as $positions_type ) : ?>	
			<option value="<?php echo $positions_type['id']; ?>"><?php echo $positions_type["id"] . " - " . $positions_type["name"] ; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="description">Popis</label>
	<textarea name="description"></textarea><br />

	<input type="submit" name="submit" value="Vytvoř novou funkci" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
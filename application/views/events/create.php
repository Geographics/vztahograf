<h2>Události (tabulka Events)</h2>
<h3>Vytvoř událost</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('events/create') ?>

	<label for="name">Název</label>
	<input type="input" name="name" /><br />

	<label for="fk_events_types">Typ</label>
	<select name="fk_events_types">
		<?php foreach( $events_types as $events_type ) : ?>	
			<option value="<?php echo $events_type['id']; ?>"><?php echo $events_type["id"] . " - " . $events_type["name"] ; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="description">Popis</label>
	<textarea name="description"></textarea><br />

	<label for="date_of_start">Datum vzniku</label>
	<input type="date" name="date_of_start" /><br />

	<label for="date_of_end">Datum zániku</label>
	<input type="date" name="date_of_end" /><br />

	<input type="submit" name="submit" value="Vytvoř novou událost" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
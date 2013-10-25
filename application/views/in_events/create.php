<h2>V události (tabulka In_Events)</h2>
<h3>Vytvoř V události</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('in_events/create') ?>
	
	<label for="fk_persons">Osoba</label>
	<select name="fk_persons">
		<?php foreach( $persons as $person ) : ?>	
			<option value="<?php echo $person['id']; ?>"><?php echo $person["id"] . " - " . $person["first_name"] . " " . $person["last_name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="fk_organizations">Organizace</label>
	<select name="fk_organizations">
		<?php foreach( $organizations as $organization ) : ?>	
			<option value="<?php echo $organization['id']; ?>"><?php echo $organization["id"] . " - " . $organization["name"]  ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="fk_events">Událost</label>
	<select name="fk_events">
		<?php foreach( $events as $event ) : ?>	
			<option value="<?php echo $event['id']; ?>"><?php echo $event["id"] . " - " . $event["name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="description">Popis</label>
	<textarea name="description"></textarea><br />

	<label for="date_of_start">Ve funkci od</label>
	<input type="date" name="date_of_start"/><br />

	<label for="date_of_end">Ve funkci do</label>
	<input type="date" name="date_of_end"/><br />

	<input type="submit" name="submit" value="Vytvoř V události" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
<h2>Události (tabulka Events)</h2>
<h3>Uprav událost</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('events/update/' .$id ) ?>

	<label for="name">Název</label>
	<input type="input" name="name" value="<?php echo $event['name']; ?>"/><br />

	<label for="fk_events_types">Typ</label>
	<select name="fk_events_types">
		<?php foreach( $events_types as $events_type ) : ?>	
			<option value="<?php echo $events_type['id']; ?>" <?php if( $events_type["id"] == $event["fk_events_types"] ) echo "selected";?>><?php echo $events_type["id"] . " - " . $events_type["name"] ; ?></option>
		<?php endforeach ?>
	</select><br />
	<label for="description">Popis</label>
	<input type="input" name="description" value="<?php echo $event['description']; ?>"/><br />

	<label for="date_of_start">Datum vzniku</label>
	<input type="date" name="date_of_start" value="<?php echo date( "Y-m-d", strtotime( $event['date_of_start'] ) ); ?>"/><br />

	<label for="date_of_end">Datum zániku</label>
	<input type="date" name="date_of_end" value="<?php echo date( "Y-m-d", strtotime( $event['date_of_end'] ) ); ?>"/><br />

	<input type="submit" name="submit" value="Uprav událost" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
<h2>V události (tabulka In_Events)</h2>
<h3>Uprav V události</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('in_events/update/' .$id ) ?>
	
	<label for="fk_persons">Osoba</label>
	<select name="fk_persons">
		<?php foreach( $persons as $person ) : ?>	
			<option value="<?php echo $person['id']; ?>" <?php if( $person["id"] == $in_event["fk_persons"] ) echo "selected";?> ><?php echo $person["id"] . " - " . $person["first_name"] . " " . $person["last_name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="fk_organizations">Organizace</label>
	<select name="fk_organizations">
		<?php foreach( $organizations as $organization ) : ?>	
			<option value="<?php echo $organization['id']; ?>" <?php if( $organization["id"] == $in_event["fk_organizations"] ) echo "selected";?>><?php echo $organization["id"] . " - " . $organization["name"]  ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="fk_events">Funkce</label>
	<select name="fk_events">
		<?php foreach( $events as $event ) : ?>	
			<option value="<?php echo $event['id']; ?>" <?php if( $event["id"] == $in_event["fk_events"] ) echo "selected";?>><?php echo $event["id"] . " - " . $event["name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="description">Popis</label>
	<input type="input" name="description" value="<?php echo $in_event['description']; ?>"/><br />

	<label for="date_of_start">Ve funkci od</label>
	<input type="date" name="date_of_start" value="<?php echo date( "Y-m-d", strtotime( $in_event['date_of_start'] ) ); ?>"/><br />

	<label for="date_of_end">Ve funkci do</label>
	<input type="date" name="date_of_end" value="<?php echo date( "Y-m-d", strtotime( $in_event['date_of_end'] ) ); ?>"/><br />
	
	<input type="submit" name="submit" value="Uprav událost" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
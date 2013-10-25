<h2>Typy událostí (tabulka Events_types)</h2>
<h3>Uprav typ události</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('events_types/update/' .$id ) ?>

	<label for="name">Název</label>
	<input type="input" name="name" value="<?php echo $events_type['name']; ?>"/><br />

	<label for="description">Popis</label>
	<textarea name="description"><?php echo $events_type['description']; ?></textarea>

	<input type="submit" name="submit" value="Uprav typ události" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
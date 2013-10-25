<h2>Typy funkcí (tabulka Positions_types)</h2>
<h3>Uprav typ funkce</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('positions_types/update/' .$id ) ?>

	<label for="name">Název</label>
	<input type="input" name="name" value="<?php echo $positions_type['name']; ?>"/><br />

	<label for="description">Popis</label>
	<textarea name="description"><?php echo $positions_type['description']; ?></textarea>

	<input type="submit" name="submit" value="Uprav typ funkce" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
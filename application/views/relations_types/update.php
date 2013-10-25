<h2>Typy vztahů (tabulka Relations_types)</h2>
<h3>Uprav typ funkce</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('relations_types/update/' .$id ) ?>

	<label for="name">Název</label>
	<input type="input" name="name" value="<?php echo $relations_type['name']; ?>"/><br />

	<label for="description">Popis</label>
	<textarea name="description"><?php echo $relations_type['description']; ?></textarea>

	<input type="submit" name="submit" value="Uprav typ vztahu" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
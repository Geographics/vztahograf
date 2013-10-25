<h2>Typy vztahů (tabulka Relations_types)</h2>
<h3>Vytvoř nový typ vztahu</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('relations_types/create') ?>

	<label for="name">Název</label>
	<input type="input" name="name" /><br />

	<label for="description">Popis</label>
	<textarea name="description"></textarea><br />

	<input type="submit" name="submit" value="Vytvoř nový typ vztahu" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
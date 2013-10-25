<h2>Typy organizací (tabulka Organizations_types)</h2>
<h3>Vytvoř nový typ organizace</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('organizations_types/create') ?>

	<label for="name">Název</label>
	<input type="input" name="name" /><br />

	<label for="description">Popis</label>
	<textarea name="description"></textarea><br />

	<input type="submit" name="submit" value="Vytvoř nový typ organizace" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
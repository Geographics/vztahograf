<h2>Typy funkcí (tabulka Positions_types)</h2>
<h3>Vytvoř nový typ funkce</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('positions_types/create') ?>

	<label for="name">Název</label>
	<input type="input" name="name" /><br />

	<label for="description">Popis</label>
	<textarea name="description"></textarea><br />

	<input type="submit" name="submit" value="Vytvoř nový typ funkce" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
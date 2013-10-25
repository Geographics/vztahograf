<h2>Typy organizací (tabulka Organizations_types)</h2>
<h3>Uprav typ organizace</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('organizations_types/update/' .$id ) ?>

	<label for="name">Název</label>
	<input type="input" name="name" value="<?php echo $organizations_type['name']; ?>"/><br />

	<label for="description">Popis</label>
	<textarea name="description"><?php echo $organizations_type['description']; ?></textarea>

	<input type="submit" name="submit" value="Uprav typ organizace" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
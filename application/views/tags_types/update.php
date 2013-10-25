<h2>Typy štítků (tabulka Tags_types)</h2>
<h3>Uprav typ štítku</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('tags_types/update/' .$id ) ?>

	<label for="name">Název</label>
	<input type="input" name="name" value="<?php echo $tags_type['name']; ?>"/><br />

	<label for="description">Popis</label>
	<textarea name="description"><?php echo $tags_type['description']; ?></textarea>

	<input type="submit" name="submit" value="Uprav typ štítku" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
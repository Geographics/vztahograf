<h2>Vztah (tabulka Relations)</h2>
<h3>Vytvoř vztah</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('relations/create') ?>

	<label for="name">Název</label>
	<input type="input" name="name" /><br />

	<label for="fk_relations_types">Typ</label>
	<select name="fk_relations_types">
		<?php foreach( $relations_types as $relation_type ) : ?>	
			<option value="<?php echo $relation_type['id']; ?>"><?php echo $relation_type["id"] . " - " . $relation_type["name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="description">Popis</label>
	<textarea name="description"></textarea><br />

	<label for="date_of_start">Existuje od</label>
	<input type="date" name="date_of_start"/><br />

	<label for="date_of_end">Existuje do</label>
	<input type="date" name="date_of_end"/><br />

	<label for="fk_first_entity">První aktér</label>
	<select name="fk_first_entity">
		<?php foreach( $persons as $person ) : ?>	
			<option value="pers_<?php echo $person['id']; ?>">Osoba: <?php echo $person["id"] . " - " . $person["first_name"] . " " . $person["last_name"]; ?></option>
		<?php endforeach ?>
		<?php foreach( $organizations as $organization ) : ?>	
			<option value="org_<?php echo $organization['id']; ?>">Organizace: <?php echo $organization["id"] . " - " . $organization["name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="fk_second_entity">Druhý aktér</label>
	<select name="fk_second_entity">
		<?php foreach( $persons as $person ) : ?>	
			<option value="pers_<?php echo $person['id']; ?>">Osoba: <?php echo $person["id"] . " - " . $person["first_name"] . " " . $person["last_name"]; ?></option>
		<?php endforeach ?>
		<?php foreach( $organizations as $organization ) : ?>	
			<option value="org_<?php echo $organization['id']; ?>">Organizace: <?php echo $organization["id"] . " - " . $organization["name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="direction">Směr</label>
	<select name="direction">
		<option value="0">Rovnocený vztah</option>
		<option value="1">První aktér poskytuje službu druhému</option>
		<option value="2">Druhý aktér poskytuje službu prvnímu</option>
	</select><br />

	<input type="submit" name="submit" value="Vytvoř vztah" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
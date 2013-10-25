<h2>Vztah (tabulka Relations)</h2>
<h3>Uprav vztah</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('relations/update/' .$id ) ?>

	<label for="name">Název</label>
	<input type="input" name="name" value="<?php echo $relation['name']; ?>"/><br />

	<label for="fk_relations_types">Typ</label>
	<select name="fk_relations_types">
		<?php foreach( $relations_types as $relation_type ) : ?>	
			<option value="<?php echo $relation_type['id']; ?>" <?php if( $relation_type["id"] == $relation["fk_relations_types"] ) echo "selected";?>><?php echo $relation_type["id"] . " - " . $relation_type["name"]; ?></option>
		<?php endforeach ?>
	</select><br />
	<label for="description">Popis</label>
	<textarea name="description"><?php echo $relation['description']; ?></textarea><br />

	<label for="date_of_start">Ve funkci od</label>
	<input type="date" name="date_of_start" value="<?php echo date( "Y-m-d", strtotime( $relation['date_of_start'] ) ); ?>"/><br />

	<label for="date_of_end">Ve funkci do</label>
	<input type="date" name="date_of_end" value="<?php echo date( "Y-m-d", strtotime( $relation['date_of_end'] ) ); ?>"/><br />

	<label for="fk_first_entity">První aktér</label>
	<select name="fk_first_entity">
		<?php foreach( $persons as $person ) : ?>	
			<option value="pers_<?php echo $person['id']; ?>" <?php if( "pers_".$person["id"] == $relation["fk_first_entity"] ) echo "selected";?> >Osoba: <?php echo $person["id"] . " - " . $person["first_name"] . " " . $person["last_name"]; ?></option>
		<?php endforeach ?>
		<?php foreach( $organizations as $organization ) : ?>	
			<option value="org_<?php echo $organization['id']; ?>" <?php if( "org_".$organization["id"] == $relation["fk_first_entity"] ) echo "selected";?> >Organizace: <?php echo $organization["id"] . " - " . $organization["name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="fk_second_entity">Druhý aktér</label>
	<select name="fk_second_entity">
		<?php foreach( $persons as $person ) : ?>	
			<option value="pers_<?php echo $person['id']; ?>" <?php if( "pers_".$person["id"] == $relation["fk_second_entity"] ) echo "selected";?> >Osoba: <?php echo $person["id"] . " - " . $person["first_name"] . " " . $person["last_name"]; ?></option>
		<?php endforeach ?>
		<?php foreach( $organizations as $organization ) : ?>	
			<option value="org_<?php echo $organization['id']; ?>" <?php if( "org_".$organization["id"] == $relation["fk_second_entity"] ) echo "selected";?> >Organizace: <?php echo $organization["id"] . " - " . $organization["name"]; ?></option>
		<?php endforeach ?>
	</select><br />

	<label for="direction">Směr</label>
	<select name="direction">
		<option value="0" <?php if( $relation["direction"] == "0" ) echo "selected";?> >Rovnocený vztah</option>
		<option value="1" <?php if( $relation["direction"] == "1" ) echo "selected";?> >První aktér poskytuje službu druhému</option>
		<option value="2" <?php if( $relation["direction"] == "2" ) echo "selected";?> >Druhý aktér poskytuje službu prvnímu</option>
	</select><br />

	<input type="submit" name="submit" value="Uprav vztah" />

</form>

<script>
	$( document ).ready( function() {
			initForm();
	});
</script>
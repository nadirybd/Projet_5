<div class="page form-page">
	<div class="form-container">
		<?php if(isset($edit_error)): ?>
			<div class="error"><?= $edit_error; ?></div>
		<?php endif; ?>
		<form class="form" id="edit-event-form" method="post">
		<p>
			<label for="edit_event_title">Titre de l'évémenent :</label><br />
			<input type="text" name="edit_event_title" id="edit_event_title" value="<?= $event->title; ?>" />
		</p>
		<p>
			<label for="edit_event_date">Date de l'événement :</label><br />
			<input type="date" name="edit_event_date" id="edit_event_date" value="<?= $event->event_date; ?>"/>
		</p>
		<p>
			<label for="edit_event_address">Adresse de l'événement:</label><br />
			<input type="text" name="edit_event_address" id="edit_event_address" value="<?= $event->address; ?>"/>
		</p>
		<div id="map-coords" style="max-width: 100%; height: 200px; margin-top: 10px;"></div>
		<p>
			Description de l'événement : <br/>
			<textarea name="edit_event_info"><?= $event->info; ?></textarea>
		</p>
		<p>
			<button type="submit" class="btn btn-default" name="sub-edit-event">Mettre à jour</button>
		</p>
		</form>
	</div>
</div>

<script src="public/js/event/coords.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZaTMsfXVij9IZa1Fq_UnCUWF10QugjMg&callback=initMap" async defer></script>
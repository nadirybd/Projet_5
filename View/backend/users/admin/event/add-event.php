<div class="page form-page">
	<div class="form-container">
		<?php if(isset($addEvent_error)): ?>
			<div class="error"><?= $addEvent_error; ?></div>
		<?php endif; ?>
		<form class="form" id="add-event-form" method="post">
		<p>
			<label for="event_title">Titre de l'évémenent :</label><br />
			<input type="text" name="event_title" id="event_title" />
		</p>
		<p>
			<label for="event_date">Date de l'événement :</label><br />
			<input type="date" name="event_date" id="event_date" />
		</p>
		<p>
			<label for="event_address">Adresse de l'événement:</label><br />
			<input type="text" name="event_address" id="event_address" />
		</p>
		<div id="map-coords" style="max-width: 100%; height: 200px; margin-top: 10px;"></div>
		<p>
			Description de l'événement : <br/>
			<textarea name="event_info"></textarea>
		</p>
		<p>
			<button type="submit" class="btn btn-default" name="sub-event">Ajouter</button>
		</p>
		</form>
	</div>
</div>

<script src="public/js/event/coords.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZaTMsfXVij9IZa1Fq_UnCUWF10QugjMg&callback=initMap" async defer></script>
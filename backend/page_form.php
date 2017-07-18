<?php
	$last_order = 0;
?>
<div class="form_designer">
	<div class="top">
		<h2><span class="save">Speichern</span> Formular Designer</h2>
	</div>
	<div class="bottom">
		<div id="datastream"></div>
		<div class="left">
			<h2>Elemente</h2>
			<div class="entry">
				<ul>
					<li class="input" onclick="addElement('input');">Eingabefeld</li>
					<li class="text" onclick="addElement('text');">Textfeld</li>
					<li class="list" onclick="addElement('list');">Listenfeld</li>
				</ul>
			</div>
			<div class="settings">
				<h2>Einstellungen</h2>
				<input type="hidden" id="settings_id" value="0" />
				<div class="entry">
					<strong>Name:</strong>
					<input type="text" id="settings_name" value="" />
				</div>
				
				<div class="entry">
					<strong>Inhalt:</strong>
					<input type="text" id="settings_value" value="" />
				</div>
				
				<div class="entry">
					<strong>Typ:</strong>
					<b id="settings_type"> Input</b> <i>(Nicht änderbar)</i>
				</div>
				
				<div class="entry">
					<strong>Erforderlich?</strong>
					<select id="settings_required">
						<option value="no">Nein</option>
						<option value="yes">Ja</option>
					</select>
					<div id="settings_required_data">
						<div class="entry">
							- kein NULL
							<select id="settings_required_null">
								<option value="no">Nein</option>
								<option value="yes">Ja</option>
							</select>
						</div>
						<div class="entry" id="settings_entry_min">
							- Mindestlänge
							<input type="text" style="width: 50px;" id="settings_required_min" value="1" />
						</div>
						<div class="entry" id="settings_entry_max">
							- Maximallänge
							<input type="text" style="width: 50px;" id="settings_required_max" value="255" />
						</div>
						<div class="entry" id="settings_entry_email">
							- E-Mail Check
							<select id="settings_required_email">
								<option value="no">Nein</option>
								<option value="yes">Ja</option>
							</select>
						</div>
					</div>
					<div class="entry" id="settings_entry_subject">
						<strong>Als Betreff verwenden:</strong>
						<select id="settings_subject">
							<option value="no">Nein</option>
							<option value="yes">Ja</option>
						</select> <span class="data"><img src="../wp-content/plugins/plugin-kontakt/images/icon_data.png" /></span>
					</div>
				</div>
			</div>
		</div>
		<div class="right">
			<div class="my_form">
				<form method="post" id="actionizer" action="options-general.php?page=plugin_kontakt&site=form_save">
				<?php
					$fields = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "kontakt_fields` ORDER BY `order` ASC");
					foreach($fields as $field) {
						print "<div class=\"field type_" . $field->type . "\" id=\"" . $field->id . "\">\n";
						print "<label>" . $field->name . ":" . ($field->required == 1 ? "<strong>*</strong>" : "") . "</label>\n";
						
						switch($field->type) {
							case "input":
								print "<div class=\"fake_input\">" . $field->value . "</div>\n";
							break;
							case "list":
								print "<div class=\"fake_list\">" . $field->value . "</div>\n";
							break;
							case "text":
								print "<div class=\"fake_text\">" . $field->value . "</div>\n";
							break;
						}
						
						print "<input type=\"hidden\" name=\"field_" . $field->id . "_type\" value=\"" . $field->type . "\" />";
						print "<input type=\"hidden\" name=\"field_" . $field->id . "_name\" value=\"" . $field->name . "\" />";
						print "<input type=\"hidden\" name=\"field_" . $field->id . "_required\" value=\"" . $field->required . "\" />";
						print "<input type=\"hidden\" name=\"field_" . $field->id . "_required_data\" value=\"" . $field->required_data . "\" />";
						print "<input type=\"hidden\" name=\"field_" . $field->id . "_value\" value=\"" . $field->value . "\" />";
						print "<input type=\"hidden\" name=\"field_" . $field->id . "_order\" value=\"" . $field->order . "\" />";
						print "<input type=\"hidden\" name=\"field_" . $field->id . "_subject_data\" value=\"" . $field->subject_data . "\" />";
						
						print "<div class=\"bar\">\n";
						print "<span class=\"up\" id=\"" . $field->id . "\"></span>";
						print "<span class=\"down\" id=\"" . $field->id . "\"></span>";
						print "<span class=\"delete\" id=\"" . $field->id . "\"></span>";
						print "<div class=\"clear\"></div>";
						print "</div>\n";
						print "</div>\n";
						$last_order = $field->order;
					}					
				?>
				<input type="hidden" name="order_data" id="order_data" value="" />
				<input type="hidden" name="delete_data" id="delete_data" value="" />
				<input type="hidden" name="last_order" id="last_order" value="<?php print $last_order; ?>" />
				</form>
			</div>
		</div>
	</div>
</div>
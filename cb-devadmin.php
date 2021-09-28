<?php
function cb_devadmin_menu() {
	add_menu_page('CBRA', 'CBRA', 'administrator', 'cbra-devadmin', 'cb_devadmin_dashboard', 'dashicons-admin-page', 99);
}
add_action('admin_menu', 'cb_devadmin_menu');

function cb_devadmin_dashboard() {
	?>
	<h1>CBRA Dev-Dashboard</h1>

	<h2>Verzeichnis erstellen</h2>
	<form method="post">
		<input type="text" name="cb-mkdir-name" placeholder="Verzeichnisname eintragen (inkl. Dateityp)" required>
		<input type="submit" value="Neues Verzeichnis erstellen">
	</form>

	<h2>Datei erstellen</h2>
	<form method="post">
		<input type="text" name="cb-nf-name" placeholder="Dateinamen eintragen (inkl. Dateityp)" required>
		<input type="submit" value="Neue Datei generieren">
	</form>

	<h2>Datei umbenennen</h2>
	<form method="post">
		<input type="text" name="cb-rn-oldname" placeholder="Name der Datei" required>
		<input type="text" name="cb-rn-newname" placeholder="Neuer Dateiname" required>
		<input type="submit" value="Datei umbenennen">
	</form>

	<h2>Datei löschen</h2>
	<form method="post">
		<input type="text" name="cb-rm-name" placeholder="Dateinamen" required>
		<input type="checkbox" name="cb-rm-check" id="cb-rm-check" required>
		<label for="cb-rm-check">Ich habe den Dateinamen kontrolliert und möchte diese Datei wirklich löschen.</label>
		<input type="submit" value="Datei löschen">
	</form>

	<?php
	// Verzeichnis erstellen
	if($_POST['cb-mkdir-name']) {
		$dirname = get_stylesheet_directory_uri() . '/' . $_POST['cb-mkdir-name'];
		$success = mkdir($dirname, 0777, true);
		if($success) {
			echo 'Das Verzeichnis "' . $dirname . '" wurde erfolgreich erstellt.';
		}
		else {
			echo 'Leider ist ein Fehler aufgetreten.';
		}
	}
	// Datei erstellen
	if($_POST['cb-nf-name']) {
		$newfile = get_stylesheet_directory_uri() . '/' . $_POST['cb-nf-name'];
		$success = touch($newfile);
		if($success) {
			echo 'Datei "' . $newfile . '" wurde erfolgreich generiert.';
		}
		else {
			echo 'Leider ist ein Fehler aufgetreten.';
		}
	}
	// Datei umbenennen
	if($_POST['cb-rn-oldname'] && $_POST['cb-rn-newname']) {
		$oldname = get_stylesheet_directory_uri() . '/' . $_POST['cb-rn-oldname'];
		$newname = get_stylesheet_directory_uri() . '/' . $_POST['cb-rn-newname'];
		$success = rename($oldname, $newname);
		if($success) {
			echo 'Die Datei "' . $oldname . '" wurde erfolgreich in "' . $newname . '" umbenannt.';
		}
		else {
			echo 'Leider ist ein Fehler aufgetreten.';
		}
	}
	// Datei löschen
	if($_POST['cb-rm-name']) {
		$file = get_stylesheet_directory_uri() . '/' . $_POST['cb-rm-name'];
		$success = unlink($file);
		if($success) {
			echo 'Die Datei "' . $file . '" wurde erfolgreich gelöscht.';
		}
		else {
			echo 'Leider ist ein Fehler aufgetreten.';
		}
	}
}
?>

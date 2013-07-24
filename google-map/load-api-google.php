<?php
/**
 * This file load the iframe that contain the definitios of api map of google.
 * @author Rodia  <rodia.piedra@gmail.com>
 */
header('Content-Type: text/javascript');
?>
document.write('<iframe ');
document.write('height="820" ');
document.write('width="623" ');
document.write('frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allowtransparency="true" ');
document.write('src="http://attorneyguss.com/google-map/<?php echo isset($_GET["clientid"]) ? "index.php?clientid=" . $_GET["clientid"] : ""?>">');
document.write('</iframe>');
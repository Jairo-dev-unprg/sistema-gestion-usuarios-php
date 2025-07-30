<?php
// Generar nuevo hash para admin123
$new_hash = password_hash('admin123', PASSWORD_DEFAULT);
echo "Nuevo hash para admin123: " . $new_hash;
echo "<br><br>";
echo "SQL para actualizar:";
echo "<br>";
echo "UPDATE administradores SET password = '" . $new_hash . "' WHERE usuario = 'admin';";
?>

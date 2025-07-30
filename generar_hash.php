<?php
// ============================================================================
// GENERAR HASH CORRECTO PARA LA CONTRASEÑA
// ============================================================================

echo "<h2>🔐 Generador de Hash para Contraseña</h2>";

$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
echo "<h3>Información del Hash:</h3>";
echo "<p><strong>Contraseña:</strong> $password</p>";
echo "<p><strong>Hash generado:</strong><br><code style='word-break: break-all;'>$hash</code></p>";
echo "</div>";

// Verificar que el hash funciona
if (password_verify($password, $hash)) {
    echo "<div style='background: #d4edda; padding: 15px; border-radius: 8px; color: #155724; margin: 20px 0;'>";
    echo "✅ <strong>Verificación exitosa:</strong> El hash funciona correctamente";
    echo "</div>";
} else {
    echo "<div style='background: #f8d7da; padding: 15px; border-radius: 8px; color: #721c24; margin: 20px 0;'>";
    echo "❌ <strong>Error:</strong> El hash no funciona";
    echo "</div>";
}

echo "<hr style='margin: 30px 0;'>";
echo "<h3>📋 SQL para actualizar la base de datos:</h3>";
echo "<div style='background: #e9ecef; padding: 20px; border-radius: 8px;'>";
echo "<code style='font-size: 14px;'>";
echo "UPDATE administradores SET password = '$hash' WHERE usuario = 'admin';";
echo "</code>";
echo "</div>";

echo "<hr style='margin: 30px 0;'>";
echo "<h3>🔍 Verificar en la base de datos:</h3>";
echo "<p>Ejecuta este query para ver el hash actual en la base de datos:</p>";
echo "<div style='background: #e9ecef; padding: 20px; border-radius: 8px;'>";
echo "<code style='font-size: 14px;'>";
echo "SELECT id, usuario, password FROM administradores WHERE usuario = 'admin';";
echo "</code>";
echo "</div>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background: #f8f9fa;
}
code {
    background: #f1f3f4;
    padding: 4px 8px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
}
</style>

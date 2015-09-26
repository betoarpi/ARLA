<?php

$Email = Trim(stripslashes($_POST['email']));

$EmailFrom = Trim(stripslashes($_POST['email']));
$EmailTo = "contacto@arladesignlab.com";
$Subject = "Mensaje de Contacto desde arladesignlab.com";
$Nombre = Trim(stripslashes($_POST['nombre']));
$Email = Trim(stripslashes($_POST['email']));  
$Tel = Trim(stripslashes($_POST['telefono']));
$Asunto = Trim(stripslashes($_POST['asunto']));
$Mensaje = Trim(stripslashes($_POST['mensaje']));
 
// validation
$validationOK=true;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.php\">";
  exit;
}

// prepare email body text
$Body = "";
$Body .= "Nombre: ";
$Body .= $Nombre;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $Email;
$Body .= "\n";
$Body .= "Teléfono: ";
$Body .= $Tel;
$Body .= "\n";
$Body .= "Asunto: ";
$Body .= $Asunto;
$Body .= "\n";
$Body .= "Mensaje: ";
$Body .= $Mensaje;
$Body .= "\n";

// send email 
$success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

// redirect to success page 
if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=gracias-por-contactarnos.php\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.php\">";
}
?>
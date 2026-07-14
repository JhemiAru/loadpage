<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
		<div style="
		max-width: 330px;
		margin: 50px auto 0;
		background: #F1F1F1;
		border-radius: 15px;
		-webkit-border-radius: 15px;
	">
	
		<div style="padding: 20px;">
			<div style="border-bottom: 1px solid #eff2f7; padding-bottom: 15px; margin-bottom: 15px;">
		    <h2 style="color: black;">Este es un mensaje de <strong> Facebol</strong></h2>
		    </div>
            <div style="border-bottom: 1px solid #eff2f7; padding-bottom: 15px; margin-bottom: 15px;">
            <p>Correo del Usuario: <strong> {{$email}}</strong></p>
            </div>
            <div style="border-bottom: 1px solid #eff2f7; padding-bottom: 15px; margin-bottom: 15px;">
            <p>Nombre del Usuario: <strong> {{$nombre}}</strong></p>
            </div>
            <div style="border-bottom: 1px solid #eff2f7; padding-bottom: 15px; margin-bottom: 15px;">
                <p>Para recuperar su contraseña solo haga click en el siguiente enlace:</p>
            </div>
		    <div style="border-bottom: 1px solid #eff2f7; padding-bottom: 15px; margin-bottom: 15px;">
                <a href="{{ url('reset/password/' . $codigo) }}">Restablecer Contraseña</a>
	    	</div>
	    </div>
	 </div>
</body>
</html>
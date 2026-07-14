<!DOCTYPE html>
<html lang="es">
<head>
</head>
<style>	
.btn {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.428571429;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
       -o-user-select: none;
          user-select: none;
}
.btn-success {
  color: #ffffff;
  background-color: #5cb85c;
  border-color: #4cae4c;
}

.btn-success:hover,
.btn-success:focus,
.btn-success:active,
.btn-success.active,
.open .dropdown-toggle.btn-success {
  color: #ffffff;
  background-color: #47a447;
  border-color: #398439;
}
</style>
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
            <p>Nombre del Usuario: <strong> {{ucwords($nombre." ".$apellido)}}</strong></p>
			</div>
			<div style="border-bottom: 1px solid #eff2f7; padding-bottom: 15px; margin-bottom: 15px;">
                <p>Su solicitud a sido verificada y acepta complete sus datos personales para terminar el registro.</p>
            </div>
            <div style="border-bottom: 1px solid #eff2f7; padding-bottom: 15px; margin-bottom: 15px;">
                <p>Para crear su cuenta solo haga click en el siguiente enlace:</p>
            </div>
		    <div style="border-bottom: 1px solid #eff2f7; padding-bottom: 15px; margin-bottom: 15px; text-align: center;">
                <a style="display: inline-block;
				padding: 6px 12px;
				margin-bottom: 0;
				font-size: 14px;
				font-weight: normal;
				line-height: 1.428571429;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				cursor: pointer;
				background-image: none;
				border: 1px solid transparent;
				border-radius: 4px;
				-webkit-user-select: none;
				   -moz-user-select: none;
					-ms-user-select: none;
					 -o-user-select: none;
						user-select: none;
						color: #ffffff;
  				background-color: #5cb85c;
  				border-color: #4cae4c;" href="{{ url('registro/' . $codigo) }}">Realizar Afiliación</a>
	    	</div>
	    </div>
	 </div>
</body>
</html>
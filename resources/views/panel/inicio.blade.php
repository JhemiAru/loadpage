<!DOCTYPE html>
<html lang="es">
    <div>HOLA</div>
    <a class="button {{ request()->routeIs('indexTaller') ? 'active' : '' }}" 
        href="{{ route('indexTaller') }}">
        Inicio
    </a>                    
</html>
@extends('panel.layout')
@section('titulo', 'Inicio')

@section('content')
<div>Bienvenido al sistema de FaceBol</div>       
<a href="{{ route('editarInstitucion') }}" class="btn btn-primary {{ request()->routeIs('editarInstitucion') ? 'active' : '' }}">
    <i class="fa-solid fa-laptop-code"></i> <span>Editar pagina web</span>
</a>  
        
@endsection
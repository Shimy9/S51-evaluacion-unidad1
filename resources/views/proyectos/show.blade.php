@extends('layouts.app')

@section('title', 'Detalle del Proyecto')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detalle del Proyecto</h4>
                    <span class="badge 
                        @if($proyecto->estado == 'Completado') bg-success
                        @elseif($proyecto->estado == 'En Progreso') bg-warning
                        @elseif($proyecto->estado == 'Planificado') bg-info
                        @else bg-secondary
                        @endif fs-6">
                        {{ $proyecto->estado }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">ID del Proyecto:</label>
                                <p class="form-control-plaintext">{{ $proyecto->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre:</label>
                                <p class="form-control-plaintext">{{ $proyecto->nombre }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Fecha de Inicio:</label>
                                <p class="form-control-plaintext">{{ $proyecto->getFechaFormateada() }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Responsable:</label>
                                <p class="form-control-plaintext">{{ $proyecto->responsable }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Estado:</label>
                                <p class="form-control-plaintext">
                                    <span class="badge 
                                        @if($proyecto->estado == 'Completado') bg-success
                                        @elseif($proyecto->estado == 'En Progreso') bg-warning
                                        @elseif($proyecto->estado == 'Planificado') bg-info
                                        @else bg-secondary
                                        @endif">
                                        {{ $proyecto->estado }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Monto:</label>
                                <p class="form-control-plaintext text-success fs-5 fw-bold">{{ $proyecto->getMontoFormateado() }}</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver a la Lista
                        </a>
                        
                        <div class="btn-group" role="group">
                            <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form method="POST" action="{{ route('proyectos.destroy', $proyecto->id) }}" 
                                  style="display: inline;" 
                                  onsubmit="return confirm('¿Está seguro de eliminar este proyecto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.form-control-plaintext {
    padding-left: 0;
    margin-bottom: 0;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

.btn-group .btn:last-child {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
}
</style>
@endsection

@extends('layouts.app')

@section('title', 'Editar Proyecto')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Editar Proyecto - {{ $proyecto->nombre }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('proyectos.update', $proyecto->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Proyecto <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre', $proyecto->nombre) }}" 
                                   required 
                                   placeholder="Ingrese el nombre del proyecto">
                        </div>

                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio <span class="text-danger">*</span></label>
                            <input type="date" 
                                   class="form-control" 
                                   id="fecha_inicio" 
                                   name="fecha_inicio" 
                                   value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <option value="Planificado" {{ old('estado', $proyecto->estado) == 'Planificado' ? 'selected' : '' }}>Planificado</option>
                                <option value="En Progreso" {{ old('estado', $proyecto->estado) == 'En Progreso' ? 'selected' : '' }}>En Progreso</option>
                                <option value="Completado" {{ old('estado', $proyecto->estado) == 'Completado' ? 'selected' : '' }}>Completado</option>
                                <option value="Cancelado" {{ old('estado', $proyecto->estado) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="responsable" class="form-label">Responsable <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   id="responsable" 
                                   name="responsable" 
                                   value="{{ old('responsable', $proyecto->responsable) }}" 
                                   required 
                                   placeholder="Ingrese el nombre del responsable">
                        </div>

                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" 
                                       class="form-control" 
                                       id="monto" 
                                       name="monto" 
                                       value="{{ old('monto', $proyecto->monto) }}" 
                                       min="0" 
                                       required 
                                       placeholder="0">
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Información:</strong> Está editando el proyecto con ID: {{ $proyecto->id }}
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="btn-group" role="group">
                                <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-list"></i> Volver a Lista
                                </a>
                                <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-eye"></i> Ver Detalle
                                </a>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Actualizar Proyecto
                                </button>
                            </div>
                        </div>
                    </form>
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

.form-label {
    font-weight: 500;
}

.text-danger {
    color: #dc3545 !important;
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

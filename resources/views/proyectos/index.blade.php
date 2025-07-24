@extends('layouts.app')

@section('title', 'Lista de Proyectos')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Gestión de Proyectos</h2>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between mb-3">
                <h3>Lista de Proyectos</h3>
                <a href="{{ route('proyectos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Proyecto
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    @if(count($proyectos) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Fecha Inicio</th>
                                        <th>Estado</th>
                                        <th>Responsable</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proyectos as $proyecto)
                                        <tr>
                                            <td>{{ $proyecto->id }}</td>
                                            <td>{{ $proyecto->nombre }}</td>
                                            <td>{{ $proyecto->getFechaFormateada() }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($proyecto->estado == 'Completado') bg-success
                                                    @elseif($proyecto->estado == 'En Progreso') bg-warning
                                                    @elseif($proyecto->estado == 'Planificado') bg-info
                                                    @else bg-secondary
                                                    @endif">
                                                    {{ $proyecto->estado }}
                                                </span>
                                            </td>
                                            <td>{{ $proyecto->responsable }}</td>
                                            <td>{{ $proyecto->getMontoFormateado() }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('proyectos.show', $proyecto->id) }}" 
                                                       class="btn btn-sm btn-outline-info" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('proyectos.edit', $proyecto->id) }}" 
                                                       class="btn btn-sm btn-outline-warning" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('proyectos.destroy', $proyecto->id) }}" 
                                                          style="display: inline;" 
                                                          onsubmit="return confirm('¿Está seguro de eliminar este proyecto?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <h5 class="text-muted">No hay proyectos registrados</h5>
                            <p class="text-muted">Comience creando su primer proyecto</p>
                            <a href="{{ route('proyectos.create') }}" class="btn btn-primary">Crear Proyecto</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

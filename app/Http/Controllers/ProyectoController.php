<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::obtenerTodos();
        return response()->json($proyectos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Use POST /api/proyectos para crear un proyecto']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $proyecto = new Proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->estado = $request->estado;
        $proyecto->responsable = $request->responsable;
        $proyecto->monto = $request->monto;
        
        $proyectoCreado = Proyecto::crear($proyecto);
        
        return response()->json($proyectoCreado, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::obtenerPorId($id);
        
        if (!$proyecto) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }
        
        return response()->json($proyecto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(['message' => 'Use PUT /api/proyectos/{id} para actualizar un proyecto']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proyecto = Proyecto::obtenerPorId($id);
        
        if (!$proyecto) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }
        
        $proyecto->nombre = $request->nombre;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->estado = $request->estado;
        $proyecto->responsable = $request->responsable;
        $proyecto->monto = $request->monto;
        
        $proyectoActualizado = Proyecto::actualizar($id, $proyecto);
        
        return response()->json($proyectoActualizado);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proyecto = Proyecto::obtenerPorId($id);
        
        if (!$proyecto) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }
        
        Proyecto::eliminar($id);
        
        return response()->json(['message' => 'Proyecto eliminado exitosamente']);
    }

    // ==========================================
    // MÉTODOS WEB (para las vistas Blade)
    // ==========================================

    /**
     * Display a listing of the resource (WEB)
     */
    public function indexWeb()
    {
        $proyectos = Proyecto::obtenerTodos();
        return view('proyectos.index', compact('proyectos'));
    }
 
    /**
     * Show the form for creating a new resource (WEB)
     */
    public function createWeb()
    {
        return view('proyectos.create');
    }

    /**
     * Store a newly created resource in storage (WEB)
     */
    public function storeWeb(Request $request)
    {
        $proyecto = new Proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->estado = $request->estado;
        $proyecto->responsable = $request->responsable;
        $proyecto->monto = $request->monto;
        
        Proyecto::crear($proyecto);
        
        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente');
    }

    /**
     * Display the specified resource (WEB)
     */
    public function showWeb(string $id)
    {
        $proyecto = Proyecto::obtenerPorId($id);
        
        if (!$proyecto) {
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado');
        }
        
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource (WEB)
     */
    public function editWeb(string $id)
    {
        $proyecto = Proyecto::obtenerPorId($id);
        
        if (!$proyecto) {
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado');
        }
        
        return view('proyectos.edit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage (WEB)
     */
    public function updateWeb(Request $request, string $id)
    {
        $proyecto = Proyecto::obtenerPorId($id);
        
        if (!$proyecto) {
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado');
        }
        
        $proyecto->nombre = $request->nombre;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->estado = $request->estado;
        $proyecto->responsable = $request->responsable;
        $proyecto->monto = $request->monto;
        
        Proyecto::actualizar($id, $proyecto);
        
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage (WEB)
     */
    public function destroyWeb(string $id)
    {
        $proyecto = Proyecto::obtenerPorId($id);
        
        if (!$proyecto) {
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado');
        }
        
        Proyecto::eliminar($id);
        
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente');
    }

    
}

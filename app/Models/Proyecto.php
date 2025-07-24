<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    // Atributos fillables para asignación masiva
    protected $fillable = [
        'id',
        'nombre',
        'fecha_inicio',
        'estado',
        'responsable',
        'monto'
    ];

    public $id;
    public $nombre;
    public $fecha_inicio;
    public $estado;
    public $responsable;
    public $monto;

    public function __construct($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    // Método privado para inicializar los datos en sesión si no existen
    private static function inicializarSesion()
    {
        if (!session()->has('proyectos')) {
            session(['proyectos' => [
                [
                    'id' => 1,
                    'nombre' => 'Sistema de Gestión de Inventario',
                    'fecha_inicio' => '2025-01-15',
                    'estado' => 'En Progreso',
                    'responsable' => 'Juan Pérez',
                    'monto' => 50000.00
                ],
                [
                    'id' => 2,
                    'nombre' => 'Aplicación Móvil E-commerce',
                    'fecha_inicio' => '2025-02-01',
                    'estado' => 'Completado',
                    'responsable' => 'María González',
                    'monto' => 75000.00
                ],
                [
                    'id' => 3,
                    'nombre' => 'Portal de Recursos Humanos',
                    'fecha_inicio' => '2025-03-10',
                    'estado' => 'Planificado',
                    'responsable' => 'Carlos Rodríguez',
                    'monto' => 40000.00
                ],
                [
                    'id' => 4,
                    'nombre' => 'Sistema de Facturación',
                    'fecha_inicio' => '2025-01-20',
                    'estado' => 'En Progreso',
                    'responsable' => 'Ana López',
                    'monto' => 60000.00
                ],
                [
                    'id' => 5,
                    'nombre' => 'Plataforma de E-learning',
                    'fecha_inicio' => '2025-04-05',
                    'estado' => 'Planificado',
                    'responsable' => 'Luis Martínez',
                    'monto' => 85000.00
                ]
            ]]);
        }
    }

    // Método para obtener todos los proyectos desde la sesión
    public static function obtenerTodos()
    {
        self::inicializarSesion();
        $proyectosData = session('proyectos', []);
        
        $proyectos = [];
        foreach ($proyectosData as $proyectoData) {
            $proyectos[] = new self($proyectoData);
        }
        
        return $proyectos;
    }

    // Método para obtener un proyecto por ID desde la sesión
    public static function obtenerPorId($id)
    {
        self::inicializarSesion();
        $proyectosData = session('proyectos', []);
        
        foreach ($proyectosData as $proyectoData) {
            if ($proyectoData['id'] == $id) {
                return new self($proyectoData);
            }
        }
        
        return null;
    }

    // Método para crear un nuevo proyecto en la sesión
    public static function crear($proyecto)
    {
        self::inicializarSesion();
        $proyectosData = session('proyectos', []);
        
        // Generar nuevo ID (obtener el ID más alto y sumar 1)
        $nuevoId = 1;
        if (!empty($proyectosData)) {
            $ids = array_column($proyectosData, 'id');
            $nuevoId = max($ids) + 1;
        }
        
        $proyecto->id = $nuevoId;
        
        // Agregar el nuevo proyecto
        $proyectosData[] = [
            'id' => $proyecto->id,
            'nombre' => $proyecto->nombre,
            'fecha_inicio' => $proyecto->fecha_inicio,
            'estado' => $proyecto->estado,
            'responsable' => $proyecto->responsable,
            'monto' => (float)$proyecto->monto
        ];
        
        // Guardar en la sesión
        session(['proyectos' => $proyectosData]);
        
        return $proyecto;
    }

    // Método para actualizar un proyecto en la sesión
    public static function actualizar($id, $proyectoActualizado)
    {
        self::inicializarSesion();
        $proyectosData = session('proyectos', []);
        
        foreach ($proyectosData as $key => $proyecto) {
            if ($proyecto['id'] == $id) {
                $proyectosData[$key] = [
                    'id' => (int)$id,
                    'nombre' => $proyectoActualizado->nombre,
                    'fecha_inicio' => $proyectoActualizado->fecha_inicio,
                    'estado' => $proyectoActualizado->estado,
                    'responsable' => $proyectoActualizado->responsable,
                    'monto' => (float)$proyectoActualizado->monto
                ];
                
                // Guardar en la sesión
                session(['proyectos' => $proyectosData]);
                
                return new self($proyectosData[$key]);
            }
        }
        
        return null;
    }

    // Método para eliminar un proyecto de la sesión
    public static function eliminar($id)
    {
        self::inicializarSesion();
        $proyectosData = session('proyectos', []);
        
        foreach ($proyectosData as $key => $proyecto) {
            if ($proyecto['id'] == $id) {
                // Eliminar el proyecto del array
                unset($proyectosData[$key]);
                // Reindexar el array
                $proyectosData = array_values($proyectosData);
                
                // Guardar en la sesión
                session(['proyectos' => $proyectosData]);
                
                return true;
            }
        }
        
        return false;
    }

    // Método para formatear el monto
    public function getMontoFormateado()
    {
        return '$' . number_format($this->monto);
    }

    // Método para formatear la fecha
    public function getFechaFormateada()
    {
        return date('d/m/Y', strtotime($this->fecha_inicio));
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Carbon\Carbon;

class LibroController extends Controller{

    public function index(){

        $datosLibro = Libro::all();

        return response()->json($datosLibro);

    }

    public function guardar(Request $request){

        $datosLibro = new Libro;

        if($request->hasfile('imagen')){
            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();

            $nuevoName = Carbon::now()->timestamp."_".$nombreArchivoOriginal;
            $carpetaDestino = './upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoName);

            
            $datosLibro->nombre=$request->nombre;
            $datosLibro->apellidos=$request->apellidos;
            $datosLibro->edad=$request->edad;
            $datosLibro->salario=$request->salario;
            $datosLibro->imagen=ltrim($carpetaDestino,'.').$nuevoName;

            $datosLibro ->save();

        }

        return response()->json($nuevoName);

    }

    public function ver($id){
        $datosLibro = new Libro;
        $datosEncontrados = $datosLibro->find($id);

        return response()->json($datosEncontrados);
    }

    public function eliminar($id) {

        $datosUsuario = Libro::find($id);

        if($datosUsuario){

            $rutaArch = base_path('public').$datosUsuario->imagen;
            if(file_exists($rutaArch)){
                unlink($rutaArch);
            }
            $datosUsuario->delete();
        }

        return response()->json("Registro Borrado");
    }

    public function actualizar(Request $request, $id){
        $datosUsuario = Libro::find($id);


        if($request->hasfile('imagen')){


            if($datosUsuario){

                $rutaArch = base_path('public').$datosUsuario->imagen;
                if(file_exists($rutaArch)){
                    unlink($rutaArch);
                }
                $datosUsuario->delete();
            }    


            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();

            $nuevoName = Carbon::now()->timestamp."_".$nombreArchivoOriginal;
            $carpetaDestino = './upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoName);

            $datosUsuario->imagen=ltrim($carpetaDestino,'.').$nuevoName;

            $datosUsuario ->save();

        }

        if($request->input('nombre')){
            $datosUsuario->nombre = $request->input('nombre');
        }
    
        if($request->input('apellidos')){
            $datosUsuario->apellidos = $request->input('apellidos');
        }
    
        if($request->input('edad')){
            $datosUsuario->edad = $request->input('edad');
        }

        if($request->input('salario')){
            $datosUsuario->salario = $request->input('salario');
        }

        $datosUsuario->save();

        return response()->json("Datos Actualizados");

    }

}
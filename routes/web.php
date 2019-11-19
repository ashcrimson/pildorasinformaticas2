<?php
use App\Articulo;
use App\Cliente;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'MiControlador@index');
Route::get('/crear', 'MiControlador@create');
Route::get('/articulos', 'MiControlador@store');
Route::get('/mostrar', 'MiControlador@show');
Route::get('/contacto', 'MiControlador@contactar');
Route::get('/galeria', 'MiControlador@galeria');
/*
Route::get('/insertar', function() {

    DB::insert("INSERT INTO articulos (NOMBRE_ARTICULO, PRECIO, PAIS_ORIGEN, SECCION, OBSERVACIONES)
    VALUES (?,?,?,?,?)", ["JARRON", 15.2, "JAPÓN", "CERÁMICA", "GANGA"]);
});

Route::get('/leer', function() {

    $resultados = DB::select("SELECT * FROM articulos WHERE ID=?", [1]);

    foreach($resultados as $articulo) {
        
        return $articulo->Nombre_Articulo;

    }
});

Route::get('/actualiza', function() {

    DB::update("UPDATE articulos SET SECCION='DECORACIÓN' 
    WHERE ID=?", [1]);
});


Route::get('/borrar', function() {

    DB::update("DELETE from articulos WHERE ID=?
    ", [1]);
});*/

Route::get("/leer", function() {

   /* $articulos = Articulo::all();

    foreach($articulos as $articulo) {

        echo "Nombre: " . $articulo->Nombre_Articulo . " Precio: " . $articulo->Precio . "<br>";
    }*/

    //$articulos=Articulo::find(3);

    $articulos = Articulo::withTrashed()
                ->where('id', 4)
                ->restore();

    return $articulos;
});

Route::get("/actualizar", function() {

    Articulo::where("seccion","Menaje")->where("pais_origen", "España")
    ->update(["precio"=>90, "Nombre_Articulo"=>"Pico"]);
});

Route::get("/borrar", function() {

    Articulo::where("seccion","Ferretería")->delete();

   
});

Route::get("/insercionvarios", function() {

    Articulo::create([
        "Nombre_Articulo"=>"Impresora",
        "Precio"=>50,
        "pais_origen"=>"Colombia",
        "observaciones"=>"Nada que decir",
        "seccion"=>"Informática"
    ]);

});

Route::get("/softdelete", function() {

    Articulo::find(4)->delete();

});

Route::get("/harddelete", function() {

    $articulos = Articulo::withTrashed()
                ->where('id', 4)
                ->forceDelete();

});

Route::get("/cliente/{id}/articulo", function($id){

    return Cliente::find($id)->articulo;
});

Route::get("/articulo/{id}/cliente", function($id){

    return Articulo::find($id)->cliente->Nombre;
});

Route::get("/articulos", function() {
    $articulos = Cliente::find(3)->articulos->where('pais_origen', 'Chile');

    foreach ($articulos as $articulo) {
        echo $articulo->Nombre_Articulo . "<br>";
    }
});

Route::get("/cliente/{id}/perfil", function($id){

    $cliente=Cliente::find($id);

    foreach($cliente->perfils as $perfil){

        return $perfil->nombre;
    }
});

Route::get('/calificaciones', function(){

    $articulo=Articulo::find(3);

    foreach($articulo->calificaciones as $calificacion)
    {
        return $calificacion->calificacion;
    }
});
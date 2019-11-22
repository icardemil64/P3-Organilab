<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Administra la ruta al home
Route::get('/home', 'HomeController@index')->name('home');

//Administra las rutas para el encargado de laboratorio

//Administra las rutas de gestión de dispositivos
Route::get('/panel_departamento', 'HomeController@irPanelDepartamento')->name('inicio_departamento');
Route::get('/panel_laboratorio', 'HomeController@irPanelLaboratorio')->name('inicio_laboratorio');

Route::group(['prefix' => 'panel_departamento/dispositivos'], function () {    
    Route::get('/', 'DispositivoController@index')->name('inicio_dispositivos');
    Route::get('/crear', 'DispositivoController@crear')->name('crear_dispositivos');
    Route::post('/', 'DispositivoController@guardarDispositivo')->name('guardar_dispositivos');
    Route::get('/lista/{slug}', 'DispositivoController@listaDispositivos')->name('lista_dispositivos');
    Route::get('/detalle/{slug}/{id}', 'DispositivoController@detalleDispositivo')->name('detalle_dispositivo');
    Route::delete('eliminar/{slug}/{id}/', 'DispositivoController@eliminarDispositivo')->name('eliminar_dispositivo');
    Route::get('editar/{slug}', 'DispositivoController@editarDispositivo')->name('editar_dispositivos');
    Route::put('editar/{slug}', 'DispositivoController@guardarDispositivoActualizado')->name('actualizar_dispositivos');
    Route::get('/buscar','DispositivoController@buscarDispositivo')->name('buscar_dispositivo');
});

//Administra las rutas de gestión de laboratorios
Route::group(['prefix' => 'panel_departamento/laboratorios'], function () {
    Route::get('/', 'LaboratorioController@index')->name('inicio_laboratorios');
    Route::get('/crear', 'LaboratorioController@crear')->name('crear_laboratorios');
    Route::post('/', 'LaboratorioController@guardarLaboratorio')->name('guardar_laboratorios');
    Route::get('/panel/{slug}', 'LaboratorioController@detalleLaboratorio')->name('panel_laboratorio');
    Route::get('/detalle/{slug}', 'LaboratorioController@historialPrestamosLaboratorio')->name('detalle_laboratorio');
    Route::get('editar/{slug}', 'LaboratorioController@editarLaboratorio')->name('editar_laboratorios');
    Route::put('editar/{slug}', 'LaboratorioController@guardarLaboratorioActualizado')->name('actualizar_laboratorio');
    Route::delete('eliminar/{slug}', 'LaboratorioController@eliminarLaboratorio')->name('eliminar_laboratorio');
    Route::get('dispositivos_asignados/{slug}','LaboratorioController@indexDispositivosAsignados')->name('indice_dispositivos_asignados');
    Route::get('asignar_dispositivo/{slug}','LaboratorioController@asignarDispositivos')->name('asignar_dispositivos_laboratorio');
    Route::get('asignar_dispositivo_detalle/{slug_lab}/{slug_dis}','LaboratorioController@asignarDispositivosDetalle')->name('asignar_dispositivos_laboratorio_detalle');
    Route::get('asignar_dispositivo_detalle/{slug_lab}/{slug_dis}/{id_dis}/add','LaboratorioController@asignarDispositivoALaboratorioAdd')->name('asignar_dispositivo_a_laboratorio_add');
    Route::get('asignar_dispositivo_detalle/{slug_lab}/{slug_dis}/{id_dis}/delete','LaboratorioController@asignarDispositivoALaboratorioDelete')->name('asignar_dispositivo_a_laboratorio_delete');
    
});

//Administra las rutas de gestión de encargados
Route::group(['prefix' => 'panel_departamento/encargados'], function () {
    Route::get('/','EncargadoController@index')->name('inicio_encargados');
    Route::get('/crear', 'EncargadoController@crear')->name('crear_encargado');
    Route::post('/','EncargadoController@guardarEncargado')->name('guardar_encargado');
    Route::get('editar/{id}','EncargadoController@editarEncargado')->name('editar_encargado');
    Route::put('editar/{id}', 'EncargadoController@guardarEncargadoActualizado')->name('actualizar_encargado');
    Route::delete('eliminar/{id}','EncargadoController@eliminarEncargado')->name('eliminar_encargado');
});

//Administra las rutas de gestión de observaciones
//Encargado de laboratorio
Route::group(['prefix' => 'panel_laboratorio/observaciones'], function () {
    Route::get('/lista','ObservacionController@listarDispositivos')->name('listado_dispositivos_observaciones');
    Route::get('/lista/{slug}','ObservacionController@detalleListadoDispositivos')->name('detalle_listado_dispositivos_observaciones');
    Route::get('/lista/{slug}/{id}', 'ObservacionController@detalleDispositivo')->name('detalle_dispositivo_observaciones');
    Route::get('/detalle/{id}','ObservacionController@detalleObservacion')->name('detalle_observacion');
    Route::get('/crear/{slug}/{id}', 'ObservacionController@crear')->name('crear_observacion');
    Route::post('/','ObservacionController@guardarObservacion')->name('guardar_observacion');
});
//Encargado de departamento
Route::group(['prefix' => 'panel_departamento/observaciones'], function () {
    Route::get('/','ObservacionController@index')->name('inicio_observaciones');
    Route::put('/editar/{id}','ObservacionController@actualizarObservacion')->name('actualizar_observacion');    
});

//Administra las rutas de gestión de préstamos
Route::group(['prefix' => 'panel_laboratorio/prestamos'], function () {
    Route::get('/','PrestamoController@index')->name('inicio_prestamos');
    Route::get('/laboratorios','PrestamoController@indexLaboratorio')->name('inicio_prestamos_laboratorios');    
    Route::get('/dispositivos','PrestamoController@indexDispositivo')->name('inicio_prestamos_dispositivos');
    Route::get('/lista/{slug}', 'PrestamoController@listaDispositivos')->name('lista_dispositivos_prestamo');
    Route::get('/detalle_dispositivo/{slug}/{id}', 'PrestamoController@detalleDispositivo')->name('detalle_dispositivo_prestamo');
    Route::get('/crear_prestamo_dispositivo/{slug}/{id}', 'PrestamoController@crearPrestamoDispositivo')->name('crear_prestamo_dispositivo');
    Route::post('guardar_dispositivo/','PrestamoController@guardarPrestamoDispositivo')->name('guardar_prestamo_dispositivo');
    Route::get('/actualizar_prestamo/{id}', 'PrestamoController@actualizarPrestamoDispositivo')->name('actualizar_prestamo_dispositivo');
    Route::get('/buscar','PrestamoController@buscarDispositivo')->name('buscar_dispositivo_prestamo');
    Route::get('/detalle_laboratorio/{slug}/{id}', 'PrestamoController@detalleLaboratorio')->name('detalle_laboratorio_prestamo');
    Route::get('/crear_prestamo_laboratorio/{slug}/{id}', 'PrestamoController@crearPrestamoLaboratorio')->name('crear_prestamo_laboratorio');
    Route::post('guardar_laboratorio/','PrestamoController@guardarPrestamoLaboratorio')->name('guardar_prestamo_laboratorio');
    Route::get('/activos','PrestamoController@prestamosActivos')->name('inicio_prestamos_activos');    
    Route::get('/activos/laboratorio','PrestamoController@listaPrestamosLaboratorios')->name('prestamos_activos_laboratorios');
    Route::get('/activos/dispositivos','PrestamoController@listaPrestamosDispositivos')->name('prestamos_activos_dispositivos');
    Route::get('/actualizar_laboratorio/{id}', 'PrestamoController@actualizarPrestamoLaboratorio')->name('actualizar_prestamo_laboratorio');

});

Route::group(['prefix' => 'panel_laboratorio/calendario'], function () {
    Route::get('/','CalendarioController@index')->name('inicio_calendario');    
});

Route::group(['prefix' => 'panel_laboratorio/reservas'], function () {
    Route::get('/','ReservaController@index')->name('inicio_reserva');
    Route::get('/laboratorios','ReservaController@indexLaboratorio')->name('inicio_reservas_laboratorios');
    Route::get('/dispositivos','ReservaController@indexDispositivos')->name('inicio_reservas_dispositivos');
    Route::get('/dispositivos/lista/{slug}', 'ReservaController@listaDispositivos')->name('lista_dispositivos_reserva');
    Route::get('/laboratorios/lista/{slug}', 'ReservaController@listaDispositivos')->name('lista_laboratorios_reserva');
    Route::get('/dispositivo/detalle/{slug}/{id}', 'ReservaController@detalleDispositivo')->name('detalle_dispositivo_reserva');
    Route::get('/laboratorio/detalle/{slug}/{id}', 'ReservaController@detalleLaboratorio')->name('detalle_laboratorio_reserva');
    Route::get('/dispositivo/crear/{slug}/{id}', 'ReservaController@crearReservaDispositivo')->name('crear_reserva_dispositivo');
    Route::get('/laboratorio/crear/{slug}/{id}', 'ReservaController@crearReservaLaboratorio')->name('crear_reserva_laboratorio');
    Route::post('/dispositivo/crear/','ReservaController@guardarReservaDispositivo')->name('guardar_reserva_dispositivo');
    Route::post('/laboratorios/crear','ReservaController@guardarReservaLaboratorio')->name('guardar_reserva_laboratorio');
});
<?php
 
Route::get('/', 'HomeController@index', function () {
    return view('home');
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes(); 

Route::group(['prefix' => '/', 'middleware' => ['role:Administrador' ]],function () {
    //Rutas módulo vehiculos----------------------------------------------------------------------------------------------
    Route::Resource('vehiculos', 'VehiculosController');
    Route::POST('guardarVehiculo', 'VehiculosController@store')->name('vehiculo.store'); 
    Route::DELETE('eliminarVehiculo/{placa}', 'VehiculosController@destroy')->name('vehiculo.destroy');
    Route::POST('editarVehiculo/{placa}', 'VehiculosController@update')->name('vehiculo.update');  
    Route::POST('desactivarVehiculo/{placa}', 'VehiculosController@desactivar')->name('vehiculo.desactivar');
    Route::POST('activarVehiculo/{placa}', 'VehiculosController@activar')->name('vehiculo.activar');
    Route::GET('vistaDesactivadosV', 'VehiculosController@vistaDesactivados')->name('vehiculo.vistaDesactivados');

    //Rutas módulo mantenimiento vehicular
    Route::Resource('mantenimientoVehicular', 'MantenimientoVehicularController');
    Route::GET('vistaInicio/{placa}', 'MantenimientoVehicularController@vistaInicio')->name('vistaInicio'); 
    Route::GET('index_desactivados/{placa}', 'MantenimientoVehicularController@index_desactivados')->name('index_desactivados');
    Route::GET('crearMantenimiento/{placa}', 'MantenimientoVehicularController@crear')->name('crearMantenimiento');
    Route::delete('eliminarMV/{idMV}', 'MantenimientoVehicularController@destroy')->name('eliminarMV');
    Route::POST('guardarMV', 'MantenimientoVehicularController@store')->name('guardarMV');
    Route::POST('editarMV', 'MantenimientoVehicularController@update')->name('editarMV');

    //Rutas módulo departamentos
    Route::resource('departamentos','DepartamentosController');
    Route::delete('eliminarDeparta/{id}', 'DepartamentosController@destroy')->name('departas.destroy');
    Route::POST('guardarDeparta', 'DepartamentosController@store')->name('departas.store'); 
    Route::POST('editarDeparta/{id}', 'DepartamentosController@update')->name('departas.update');

    //Rutas módulo usuarios
    Route::Get('procedencia/{id}', 'Auth\RegisterController@buscarProcedencia');
    Route::Resource('User', 'UserController'); 
    Route::delete('eliminarUser/{id}', 'UserController@destroy')->name('users.destroy'); 
    Route::POST('guardar', 'UserController@store')->name('users.store');
    Route::POST('editarUser/{id}', 'UserController@update')->name('users.update');
    Route::POST('cambioEstado/{id}', 'UserController@cambioEstado')->name('users.cambioEstado');

    //Rutas módulo gasolineras
    Route::Resource('gasolineras', 'GasolinerasController');
    Route::POST('guardarGasolinera', 'GasolinerasController@store')->name('gasolinera.store'); 
    Route::delete('eliminarGasolinera/{cedulaJuridica}', 'GasolinerasController@destroy')->name('gasolinera.destroy');
    Route::POST('editarGasolinera/{CedulaJuridica}', 'GasolinerasController@update')->name('gasolinera.update');  
    Route::POST('desactivarGasolinera/{cedulaJuridica}', 'GasolinerasController@desactivar')->name('gasolinera.desactivar');
    Route::POST('activarGasolinera/{cedulaJuridica}', 'GasolinerasController@activar')->name('gasolinera.activar');
    Route::GET('vistaDesactivados', 'GasolinerasController@vistaDesactivados')->name('gasolinera.vistaDesactivados');

    //Rutas módulo talleres
    Route::Resource('talleres', 'TalleresController');
    Route::DELETE('eliminarTalleres/{CedulaJuridica}', 'TalleresController@destroy')->name('talleres.destroy');
    Route::POST('guardarTaller', 'TalleresController@store')->name('taller.store'); 
    Route::POST('editarTaller/{CedulaJuridica}', 'TalleresController@update')->name('taller.update');  
    Route::POST('desactivarTaller/{CedulaJuridica}', 'TalleresController@desactivar')->name('taller.desactivar');
    Route::POST('activarTaller/{CedulaJuridica}', 'TalleresController@activar')->name('taller.activar');
    Route::GET('vistaDesactivadosT', 'TalleresController@vistaDesactivados')->name('taller.vistaDesactivados');

    //presupuestos---------------------------------------------------------------------------------------------------------------
    //Rutas módulo Presupuesto general
    Route::Resource('presupuestoGeneral', 'PresupuestoGeneralController');
    Route::GET('inicio', 'PresupuestoGeneralController@inicio')->name('presupuestos.inicio');
    Route::POST('guardarPG', 'PresupuestoGeneralController@store')->name('presupuestoPG.store');
    Route::POST('editarPG/{idPG}', 'PresupuestoGeneralController@update')->name('presupuestoPG.update');  
    Route::delete('eliminarPG/{idPG}', 'PresupuestoGeneralController@destroy')->name('presupuestoPG.destroy');

    //Rutas módulo Presupuesto mecanica de carros
    Route::Resource('presupuestoMecaCarro','PresupuestoMecaCarroController');
    Route::POST('guardarMecanicaCarro', 'PresupuestoMecaCarroController@store')->name('presuMecaCarro.store');  
    Route::delete('eliminarPMC/{idPMC}', 'PresupuestoMecaCarroController@destroy')->name('presuMecaCarro.destroy');
    Route::POST('editarPMC/{idPMC}', 'PresupuestoMecaCarroController@update')->name('presuMecaCarro.update'); 

    //Rutas módulo Presupuesto mecanica de motos
    Route::Resource('presupuestoMecaMoto', 'PresupuestoMecaMotoController');
    Route::POST('guardarPMM', 'PresupuestoMecaMotoController@store')->name('presuMecaMotos.store');
    Route::delete('eliminarPMM/{idPMM}', 'PresupuestoMecaMotoController@destroy')->name('presuMecaMotos.destroy');
    Route::POST('editarPMM/{idPMM}', 'PresupuestoMecaMotoController@update')->name('presuMecaMotos.update');  
    Route::POST('editarPMM/{idPMM}', 'PresupuestoMecaMotoController@update')->name('presuMecaMotos.update'); 

    //Rutas módulo Presupuesto repuestos de carros
    Route::Resource('PresupuestoRC','PresupuestoRCController'); 
    Route::POST('guardarRepuestoCarro', 'PresupuestoRCController@store')->name('presupuestoRC.store');  
    Route::POST('editarPRC/{idPRC}', 'PresupuestoRCController@update')->name('presupuestoRC.update');  
    Route::delete('eliminarPRC/{idPRC}', 'PresupuestoRCController@destroy')->name('presupuestoRC.destroy');

    //Rutas módulo Presupuesto repuestos de motos
    Route::Resource('presupuestoRepuestoMoto', 'PresupuestoRepuestoMotoController');
    Route::delete('eliminarPRM/{idPRM}', 'PresupuestoRepuestoMotoController@destroy')->name('presuRepuMotos.destroy');
    Route::POST('guardarPRM', 'PresupuestoRepuestoMotoController@store')->name('presuRepuMotos.store');
    Route::POST('editarPRM/{idPRM}', 'PresupuestoRepuestoMotoController@update')->name('presuRepuMotos.update');  

    //Rutas módulo Presupuesto aires acondicionados
    Route::Resource('presupuestoAiresAcond', 'PresupuestoAireAcondController');
    Route::POST('guardarPresupuestoAA', 'PresupuestoAireAcondController@store')->name('presupuestoAA.store');
    Route::POST('editarPAA/{idPAA}', 'PresupuestoAireAcondController@update')->name('presupuestoAA.update');  
    Route::delete('eliminarPAA/{idPAA}', 'PresupuestoAireAcondController@destroy')->name('presupuestoAA.destroy');

    //Rutas módulo Presupuesto lavado de vehiculos
    Route::Resource('presupuestoLavaVehi', 'PresupuestoLavaVehiController');
    Route::POST('guardarPresupuestoLV', 'PresupuestoLavaVehiController@store')->name('presupuestoLV.store');
    Route::POST('editarPLV/{idPLV}', 'PresupuestoLavaVehiController@update')->name('presupuestoLV.update');  
    Route::delete('eliminarPLV/{idPLV}', 'PresupuestoLavaVehiController@destroy')->name('presupuestoLV.destroy');

    //Rutas módulos presupuestos combustible
    //originales
    Route::Resource('presupuestoCombustible','PresupuestoCombustibleController');
    Route::delete('eliminarPC/{idPC}', 'PresupuestoCombustibleController@destroy')->name('presuCombustible.destroy');
    Route::POST('guardarPC', 'PresupuestoCombustibleController@store')->name('presuCombustible.store');
    Route::POST('editarPC/{idPC}', 'PresupuestoCombustibleController@update')->name('presuCombustible.update'); 
    //Administracion
    Route::Resource('AdministracionCombustible','AdministracionCombusController');
    Route::delete('eliminarAC/{idAC}', 'AdministracionCombusController@destroy')->name('adminiCombustible.destroy');
    Route::POST('guardarAC', 'AdministracionCombusController@store')->name('adminiCombustible.store');
    Route::POST('editarAC/{idAC}', 'AdministracionCombusController@update')->name('adminiCombustible.update'); 
    //desarrollo urbano
    Route::Resource('DesarrUrbanoCombustible','DesarrUrbanoCombusController');
    Route::delete('eliminarDUC/{idDUC}', 'DesarrUrbanoCombusController@destroy')->name('DesarrUrbanoCombustible.destroy');
    Route::POST('guardarDUC', 'DesarrUrbanoCombusController@store')->name('DesarrUrbanoCombustible.store');
    Route::POST('editarDUC/{idDUC}', 'DesarrUrbanoCombusController@update')->name('DesarrUrbanoCombustible.update'); 
    //dirección técnica
    Route::Resource('DireccionTecnicaCombustible','DireccionTecnicaCombusController');
    Route::delete('eliminarDTC/{idDTC}', 'DireccionTecnicaCombusController@destroy')->name('DireccionTecnicaCombustible.destroy');
    Route::POST('guardarDTC', 'DireccionTecnicaCombusController@store')->name('DireccionTecnicaCombustible.store');
    Route::POST('editarDTC/{idDTC}', 'DireccionTecnicaCombusController@update')->name('DireccionTecnicaCombustible.update'); 

    //presupuestos historicos--------------------------------------------------------------------------------------------------
    //Rutas módulo Presupuesto historico mecanica de carros
    Route::Resource('presupuestoHistoricoMC', 'PresupuestoHistoricoMCController');
    Route::GET('crearHistoricoMC/{idPMC}', 'PresupuestoHistoricoMCController@crear')->name('historicoMC.crear');
    Route::GET('historicoMC/{idPMC}', 'PresupuestoHistoricoMCController@historicoMC')->name('historicoMC.ver');
    Route::POST('guardarPHMC', 'PresupuestoHistoricoMCController@store')->name('historicoMC.store'); 
    Route::delete('eliminarHistoricoMC', 'PresupuestoHistoricoMCController@destroy')->name('historicoMC.destroy');

    //Rutas módulo Presupuesto historico mecanica de motos
    Route::Resource('presupuestoHistoricoMM', 'PresupuestoHistoricoMMController');
    Route::GET('historicoMM/{idPMM}', 'PresupuestoHistoricoMMController@historicoMM')->name('historicoMM.ver'); 
    Route::GET('crearHistoricoMM/{idPMM}', 'PresupuestoHistoricoMMController@crear')->name('historicoMM.crear');
    Route::POST('guardarPHMM', 'PresupuestoHistoricoMMController@store')->name('historicoMM.store');
    Route::delete('eliminarHistoricoMM', 'PresupuestoHistoricoMMController@destroy')->name('historicoMM.destroy');

    //Rutas módulo Presupuesto historico repuestos de carros
    Route::Resource('presupuestoHistoricoRC', 'PresupuestoHistoricoRCController');
    Route::GET('historicoRC/{idPRC}', 'PresupuestoHistoricoRCController@historicoRC')->name('historicoRC.ver');
    Route::GET('crear/{idPRC}', 'PresupuestoHistoricoRCController@crear')->name('historicoRC.crear');
    Route::POST('guardarPHRC', 'PresupuestoHistoricoRCController@store')->name('historicoRC.store');
    Route::delete('eliminarHRC', 'PresupuestoHistoricoRCController@destroy')->name('historicoRC.destroy');

    //Rutas módulo Presupuesto historico repuestos de motos
    Route::Resource('presupuestoHistoricoRepMotos', 'PresupuestoHistoricoRepMotosController');
    Route::GET('historicoRM/{idPRM}', 'PresupuestoHistoricoRepMotosController@historicoRM')->name('historicoRM.ver'); 
    Route::GET('crearHistoricoRM/{idPRM}', 'PresupuestoHistoricoRepMotosController@crear')->name('historicoRM.crear');
    Route::POST('guardarPHRM', 'PresupuestoHistoricoRepMotosController@store')->name('historicoRM.store');
    Route::delete('eliminarHistoricoRM', 'PresupuestoHistoricoRepMotosController@destroy')->name('historicoRM.destroy');
    
    //Rutas módulo Presupuesto historico aires acondicionados
    Route::Resource('presupuestoHistoricoAA', 'PresupuestoHistoricoAAController');
    Route::GET('historicoAA/{idPAA}', 'PresupuestoHistoricoAAController@historicoAA')->name('historicoAA.ver');
    Route::POST('guardarPHAA', 'PresupuestoHistoricoAAController@store')->name('historicoAA.store'); 
    Route::GET('crearHAA/{idPAA}', 'PresupuestoHistoricoAAController@crear')->name('historicoAA.crear');
    Route::delete('eliminarHAA', 'PresupuestoHistoricoAAController@destroy')->name('historicoAA.destroy');
     
    //Rutas módulo Presupuesto historico combustile
    Route::Resource('presupuestoHistoricoC', 'PresupuestoHistoricoCController');
    Route::GET('historicoC/{idPC}', 'PresupuestoHistoricoCController@historicoC')->name('historicoC.ver'); 
    Route::GET('crearHistoricoC/{idPC}', 'PresupuestoHistoricoCController@crear')->name('historicoC.crear');
    Route::POST('guardarPHC', 'PresupuestoHistoricoCController@store')->name('historicoC.store');
    Route::delete('eliminarHistoricoC', 'PresupuestoHistoricoCController@destroy')->name('historicoC.destroy');

    //Administracion 
    Route::Resource('HistoricoAdminiCombus', 'HistoricoAdminiCombusController');
    Route::GET('historicoAC/{idPC}', 'HistoricoAdminiCombusController@historicoAC')->name('historicoAC.ver'); 
    Route::GET('crearhistoricoAC/{idPC}', 'HistoricoAdminiCombusController@crear')->name('historicoAC.crear');
    Route::POST('guardarHAC', 'HistoricoAdminiCombusController@store')->name('historicoAC.store');
    Route::delete('eliminarhistoricoAC', 'HistoricoAdminiCombusController@destroy')->name('historicoAC.destroy');
    //desarrollo urbano
    Route::Resource('HistoricoDesarrUrbano', 'HistoricoDesarrUrbanoCombusController');
    Route::GET('historicoDUC/{idDUC}', 'HistoricoDesarrUrbanoCombusController@historicoDUC')->name('historicoDUC.ver'); 
    Route::GET('crearHistoricoDUC/{idPC}', 'HistoricoDesarrUrbanoCombusController@crear')->name('historicoDUC.crear');
    Route::POST('guardarHDUC', 'HistoricoDesarrUrbanoCombusController@store')->name('historicoDUC.store');
    Route::delete('eliminarHistoricoDUC', 'HistoricoDesarrUrbanoCombusController@destroy')->name('historicoDUC.destroy');
    //dirección técnica
    Route::Resource('HistoricoDireccionTecnica', 'HistoricoDireccionTecnicaCombusController');
    Route::GET('historicoDTC/{idPC}', 'HistoricoDireccionTecnicaCombusController@historicoDTC')->name('historicoDTC.ver'); 
    Route::GET('crearHistoricoDTC/{idPC}', 'HistoricoDireccionTecnicaCombusController@crear')->name('historicoDTC.crear');
    Route::POST('guardarHDTC', 'HistoricoDireccionTecnicaCombusController@store')->name('historicoDTC.store');
    Route::delete('eliminarHistoricoDTC', 'HistoricoDireccionTecnicaCombusController@destroy')->name('historicoDTC.destroy');

    //Rutas módulo Presupuesto historico lavado vehiculo
    Route::Resource('presupuestoHistoricoLV', 'PresupuestoHistoricoLVController');
    Route::GET('historicoLV/{idPLV}', 'PresupuestoHistoricoLVController@historicoLV')->name('historicoLV.ver');
    Route::POST('guardarPHLV', 'PresupuestoHistoricoLVController@store')->name('historicoLV.store'); 
    Route::GET('crearHLV/{idPLV}', 'PresupuestoHistoricoLVController@crear')->name('historicoLV.crear');
    Route::delete('eliminarHLV', 'PresupuestoHistoricoLVController@destroy')->name('historicoLV.destroy');

    //Rutas módulo Entrada y Salida Vehiculos
    Route::Resource('salidaVehicular','SalidaVehicularController');
    Route::GET('salidaVehicular/{salidaVehicular}/{placa}/edit', 'SalidaVehicularController@edit')->name('salidaVehicular.edit'); 
    Route::GET('salidaVehicular/{salidaVehicular}/{placa}', 'SalidaVehicularController@show')->name('salidaVehicular.show');  
    Route::GET('vistaInicial/{placa}', 'SalidaVehicularController@vistaInicial')->name('vistaInicial'); 
    Route::GET('salidaVehicularCreate/{placa}', 'SalidaVehicularController@create')->name('salidaVehicular.create'); 
    Route::POST('guardarSalidaVehicular', 'SalidaVehicularController@store')->name('salidaVehicular.store'); 
    Route::POST('editarSalidaVehicular/{id}', 'SalidaVehicularController@update')->name('salidaVehicular.update');
    Route::DELETE('eliminarSV/{id}', 'SalidaVehicularController@destroy')->name('salidaVehicular.destroy'); 

    Route::GET('showDesactivado/{salidaVehicular}/{placa}', 'SalidaVehicularController@showDesactivado')->name('showDesactivado');  
    Route::GET('indexDesactivadoSE/{placa}', 'SalidaVehicularController@indexDesactivado')->name('indexDesactivadoSE'); 
     
});
Route::group(['prefix' => '/', 'middleware' => ['role:Administrador|Coordinador|Alcalde' ]],function () { 
    Route::Resource('solicitud', 'SolicitudController');  
    Route::POST('guardarSolicitud', 'SolicitudController@store')->name('solicitud.store'); 
    Route::GET('aceptadoRechazado', 'SolicitudController@aceptadoRechazado')->name('solicitud.aceptadoRechazado');
    Route::POST('aceptarSolicitud', 'SolicitudController@aceptar')->name('solicitud.aceptar');
    Route::POST('rechazarSolicitud/{idSolicitud}', 'SolicitudController@rechazar')->name('solicitud.rechazar');
    Route::POST('cancelarSolicitud', 'SolicitudController@cancelar')->name('solicitud.cancelarSolicitud');
    Route::GET('formAceptadasRechazadas/{idSolicitud}', 'SolicitudController@formAceptadasRechazadas')->name('solicitud.formAceptadasRechazadas');
    Route::GET('printPDF/{idSolicitud}', 'SolicitudController@printPDF')->name('solicitud.printpdf'); 
    Route::GET('misSolicitudes', 'SolicitudController@myIndex')->name('solicitud.myIndex');
    Route::GET('myShow/{idSolicitud}', 'SolicitudController@myShow')->name('solicitud.myShow');

    Route::POST('editarSolicitud/{id}', 'SolicitudController@update')->name('users.update');
 
    Route::get('buscarVehiculos/{cantidad}', 'SolicitudController@buscarVehiculos')->name('solicitud.buscarVehiculos');
    Route::get('buscarConductoresDisponibles/{placa}', 'SolicitudController@buscarConductoresDisponibles')->name('solicitud.buscarConductoresDisponibles'); 

    Route::GET('perfil/{id}', 'UserController@show')->name('users.show');
    Route::Get('buscarProcedencia/{id}', 'UserController@buscarProcedencia');
});

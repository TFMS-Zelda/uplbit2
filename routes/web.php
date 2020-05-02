<?php

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

	// Ruta information-&-technologies.dashboard
	Route::get('information-&-technologies', 'DashboardController@index')->name('information-&-technologies.dashboard')
	->middleware('can:permission:information-&-technologies.dashboard');;

	// Ruta manager.index desde aqui empieza el panel de administracion de UplBit
	Route::get('managers', 'ManagerController@index')->name('managers.index')
		->middleware('can:permission:managers.index');

	// roles & permisos
	Route::post('managers.roles/store', 'RoleController@store')->name('managers.roles.store')
		->middleware('can:permission:managers.roles.create');
	Route::get('managers.roles', 'RoleController@index')->name('managers.roles.index')
		->middleware('can:permission:managers.roles.index');
	Route::get('managers.roles/create', 'RoleController@create')->name('managers.roles.create')
		->middleware('can:permission:managers.roles.create');
	Route::put('managers.roles/{role}', 'RoleController@update')->name('managers.roles.update')
		->middleware('can:permission:managers.roles.edit');
	Route::get('managers.roles/{role}', 'RoleController@show')->name('managers.roles.show')
		->middleware('can:permission:managers.roles.show');
	Route::delete('managers.roles/{role}', 'RoleController@destroy')->name('managers.roles.destroy')
		->middleware('can:permission:managers.roles.destroy');
	Route::get('managers.roles/{role}/edit', 'RoleController@edit')->name('managers.roles.edit')
		->middleware('can:permission:managers.roles.edit');

	// companies
	Route::post('companies/store', 'CompanyController@store')->name('companies.store')
		->middleware('can:permission:companies.create');
	Route::get('companies', 'CompanyController@index')->name('companies.index')
		->middleware('can:permission:companies.index');
	Route::get('companies/create', 'CompanyController@create')->name('companies.create')
		->middleware('can:permission:companies.create');
	Route::put('companies/{company}', 'CompanyController@update')->name('companies.update')
		->middleware('can:permission:companies.edit');
	Route::get('companies/{company}', 'CompanyController@show')->name('companies.show')
		->middleware('can:permission:companies.show');
	Route::delete('companies/{company}', 'CompanyController@destroy')->name('companies.destroy')
		->middleware('can:permission:companies.destroy');
	Route::get('companies/{company}/edit', 'CompanyController@edit')->name('companies.edit')
		->middleware('can:permission:companies.edit');

	// users
	Route::get('managers.users', 'UserController@index')->name('managers.users.index')
		->middleware('can:permission:manager.users.index');
	Route::get('managers.users/{user}', 'UserController@show')->name('managers.users.show')
		->middleware('can:permission:managers.users.show');
	Route::get('managers.users/{user}/edit', 'UserController@edit')->name('managers.users.edit')
		->middleware('can:permission:managers.users.edit');
	Route::put('managers.users/{user}', 'UserController@update')->name('managers.users.update')
		->middleware('can:permission:managers.users.edit');
	Route::delete('managers.users/{user}', 'UserController@destroy')->name('managers.users.destroy')
		->middleware('can:permission:managers.users.destroy');

	// providers
	Route::post('providers/store', 'ProviderController@store')->name('providers.store')
		->middleware('can:permission:providers.create');
	Route::get('providers', 'ProviderController@index')->name('providers.index')
		->middleware('can:permission:providers.index');
	Route::get('providers/create', 'ProviderController@create')->name('providers.create')
		->middleware('can:permission:providers.create');
	Route::put('providers/{provider}', 'ProviderController@update')->name('providers.update')
		->middleware('can:permission:providers.edit');
	Route::get('providers/{provider}', 'ProviderController@show')->name('providers.show')
		->middleware('can:permission:providers.show');
	Route::delete('providers/{provider}', 'ProviderController@destroy')->name('providers.destroy')
		->middleware('can:permission:providers.destroy');
	Route::get('providers/{provider}/edit', 'ProviderController@edit')->name('providers.edit')
		->middleware('can:permission:providers.edit');

	// articles
	Route::post('articles/store', 'ArticleController@store')->name('articles.store')
		->middleware('can:permission:articles.create');
	Route::get('articles', 'ArticleController@index')->name('articles.index')
		->middleware('can:permission:articles.index');
	Route::get('articles/create', 'ArticleController@create')->name('articles.create')
		->middleware('can:permission:articles.create');
	Route::put('articles/{article}', 'ArticleController@update')->name('articles.update')
		->middleware('can:permission:articles.edit');
	Route::get('articles/{article}', 'ArticleController@show')->name('articles.show')
		->middleware('can:permission:articles.show');
	Route::delete('articles/{article}', 'ArticleController@destroy')->name('articles.destroy')
		->middleware('can:permission:articles.destroy');
	Route::get('articles/{article}/edit', 'ArticleController@edit')->name('articles.edit')
		->middleware('can:permission:articles.edit');

	// computers
	Route::post('computers/store', 'ComputerController@store')->name('computers.store')
		->middleware('can:permission:computers.create');
	Route::get('computers', 'ComputerController@index')->name('computers.index')
		->middleware('can:permission:computers.index');
	Route::get('computers/create', 'ComputerController@create')->name('computers.create')
		->middleware('can:permission:computers.create');
	Route::put('computers/{computer}', 'ComputerController@update')->name('computers.update')
		->middleware('can:permission:computers.edit');
	Route::get('computers/{computer}', 'ComputerController@show')->name('computers.show')
		->middleware('can:permission:computers.show');
	Route::delete('computers/{computer}', 'ComputerController@destroy')->name('computers.destroy')
		->middleware('can:permission:computers.destroy');
		Route::get('computers/{computer}/edit', 'ComputerController@edit')->name('computers.edit')
		->middleware('can:permission:computers.edit');
	// remove computers
	Route::get('computers.remove-&-disabled-computers', 'ComputerController@removeDisabledComputers')->name('computers.remove-&-disabled-computers')
		->middleware('can:permission:computers.remove-&-disabled-computers');

	// tablets
	Route::post('tablets/store', 'TabletController@store')->name('tablets.store')
		->middleware('can:permission:tablets.create');
	Route::get('tablets', 'TabletController@index')->name('tablets.index')
		->middleware('can:permission:tablets.index');
	Route::get('tablets/create', 'TabletController@create')->name('tablets.create')
		->middleware('can:permission:tablets.create');
	Route::put('tablets/{tablet}', 'TabletController@update')->name('tablets.update')
		->middleware('can:permission:tablets.edit');
	Route::get('tablets/{tablet}', 'TabletController@show')->name('tablets.show')
		->middleware('can:permission:tablets.show');
	Route::delete('tablets/{tablet}', 'TabletController@destroy')->name('tablets.destroy')
		->middleware('can:permission:tablets.destroy');
	Route::get('tablets/{tablet}/edit', 'TabletController@edit')->name('tablets.edit')
	->middleware('can:permission:tablets.edit');
	// remove tablets
	Route::get('tablets.remove-&-disabled-tablets', 'TabletController@removeDisabledTablets')->name('tablets.remove-&-disabled-tablets')
		->middleware('can:permission:tablets.remove-&-disabled-tablets');

	// employees
	Route::post('managers.employees/store', 'EmployeeController@store')->name('managers.employees.store')
		->middleware('can:permission:managers.employees.create');
	Route::get('managers.employees', 'EmployeeController@index')->name('managers.employees.index')
		->middleware('can:permission:managers.employees.index');
	Route::get('managers.employees/create', 'EmployeeController@create')->name('managers.employees.create')
		->middleware('can:permission:managers.employees.create');
	Route::put('managers.employees/{employee}', 'EmployeeController@update')->name('managers.employees.update')
		->middleware('can:permission:managers.employees.edit');
	Route::get('managers.employees/{employee}', 'EmployeeController@show')->name('managers.employees.show')
		->middleware('can:permission:managers.employees.show');
	Route::delete('managers.employees/{employee}', 'EmployeeController@destroy')->name('managers.employees.destroy')
		->middleware('can:permission:managers.employees.destroy');
	Route::get('managers.employees/{employee}/edit', 'EmployeeController@edit')->name('managers.employees.edit')
		->middleware('can:permission:managers.employees.edit');
	// maintenances history computers
	Route::get('managers.employees.remove-&-disabled-employees', 'EmployeeController@removeDisabledEmployees')->name('managers.employees.remove-&-disabled-employees')
		->middleware('can:permission:managers.employees.remove-&-disabled-employees');

	// monitors
	Route::post('peripherals.monitors/store', 'MonitorController@store')->name('peripherals.monitors.store')
		->middleware('can:permission:peripherals.monitors.create');
	Route::get('peripherals.monitors', 'MonitorController@index')->name('peripherals.monitors.index')
		->middleware('can:permission:peripherals.monitors.index');
	Route::get('peripherals.monitors/create', 'MonitorController@create')->name('peripherals.monitors.create')
		->middleware('can:permission:peripherals.monitors.create');
	Route::put('peripherals.monitors/{monitor}', 'MonitorController@update')->name('peripherals.monitors.update')
		->middleware('can:permission:peripherals.monitors.edit');
	Route::get('peripherals.monitors/{monitor}', 'MonitorController@show')->name('peripherals.monitors.show')
		->middleware('can:permission:peripherals.monitors.show');
	Route::delete('peripherals.monitors/{monitor}', 'MonitorController@destroy')->name('peripherals.monitors.destroy')
		->middleware('can:permission:peripherals.monitors.destroy');
	Route::get('peripherals.monitors/{monitor}/edit', 'MonitorController@edit')->name('peripherals.monitors.edit')
		->middleware('can:permission:peripherals.monitors.edit');
	// remove monitors
	Route::get('peripherals.monitors.remove-&-disabled-monitors', 'MonitorController@removeDisabledMonitors')->name('peripherals.monitors.remove-&-disabled-monitors')
		->middleware('can:permission:peripherals.monitors.remove-&-disabled-monitors');

	// printers
	Route::post('peripherals.printers/store', 'PrinterController@store')->name('peripherals.printers.store')
		->middleware('can:permission:peripherals.printers.create');
	Route::get('peripherals.printers', 'PrinterController@index')->name('peripherals.printers.index')
		->middleware('can:permission:peripherals.printers.index');
	Route::get('peripherals.printers/create', 'PrinterController@create')->name('peripherals.printers.create')
		->middleware('can:permission:peripherals.printers.create');
	Route::put('peripherals.printers/{printer}', 'PrinterController@update')->name('peripherals.printers.update')
		->middleware('can:permission:peripherals.printers.edit');
	Route::get('peripherals.printers/{printer}', 'PrinterController@show')->name('peripherals.printers.show')
		->middleware('can:permission:peripherals.printers.show');
	Route::delete('peripherals.printers/{printer}', 'PrinterController@destroy')->name('peripherals.printers.destroy')
		->middleware('can:permission:peripherals.printers.destroy');
	Route::get('peripherals.printers/{printer}/edit', 'PrinterController@edit')->name('peripherals.printers.edit')
	->middleware('can:permission:peripherals.printers.edit');
	// remove printers
	Route::get('peripherals.printers.remove-&-disabled-printers', 'PrinterController@removeDisabledPrinters')->name('peripherals.printers.remove-&-disabled-printers')
		->middleware('can:permission:peripherals.printers.remove-&-disabled-printers');
		
	// others peripherals
	Route::post('peripherals.other-peripherals/store', 'OtherPeripheralController@store')->name('peripherals.other-peripherals.store')
		->middleware('can:permission:peripherals.other-peripherals.create');
	Route::get('peripherals.other-peripherals', 'OtherPeripheralController@index')->name('peripherals.other-peripherals.index')
		->middleware('can:permission:peripherals.other-peripherals.index');
	Route::get('peripherals.other-peripherals/create', 'OtherPeripheralController@create')->name('peripherals.other-peripherals.create')
		->middleware('can:permission:peripherals.other-peripherals.create');
	Route::put('peripherals.other-peripherals/{otherPeripheral}', 'OtherPeripheralController@update')->name('peripherals.other-peripherals.update')
		->middleware('can:permission:peripherals.other-peripherals.edit');
	Route::get('peripherals.other-peripherals/{otherPeripheral}', 'OtherPeripheralController@show')->name('peripherals.other-peripherals.show')
		->middleware('can:permission:peripherals.other-peripherals.show');
	Route::delete('peripherals.other-peripherals/{otherPeripheral}', 'OtherPeripheralController@destroy')->name('peripherals.other-peripherals.destroy')
		->middleware('can:permission:peripherals.other-peripherals.destroy');
	Route::get('peripherals.other-peripherals/{otherPeripheral}/edit', 'OtherPeripheralController@edit')->name('peripherals.other-peripherals.edit')
		->middleware('can:permission:peripherals.other-peripherals.edit');
	// remove other-peripherals
	Route::get('peripherals.other-peripherals.remove-&-disabled-other-peripherals', 'OtherPeripheralController@removeDisabledOtherPeripheral')->name('peripherals.other-peripherals.remove-&-disabled-other-peripherals')
		->middleware('can:permission:peripherals.other-peripherals.remove-&-disabled-other-peripherals');

	// maintenances
	Route::get('maintenances', 'MaintenanceController@index')->name('maintenances.index')
		->middleware('can:permission:maintenances.index');

	// maintenances computers
	Route::post('maintenances.maintenance-of-computers/store', 'MaintenanceComputerController@store')->name('maintenances.maintenance-of-computers.store')
		->middleware('can:permission:maintenances.maintenance-of-computers.create');
	Route::get('maintenances.maintenance-of-computers', 'MaintenanceComputerController@index')->name('maintenances.maintenance-of-computers.index')
		->middleware('can:permission:maintenances.maintenance-of-computers.index');
	Route::get('maintenances.maintenance-of-computers/{computer}/create', 'MaintenanceComputerController@create')->name('maintenances.maintenance-of-computers.create')
		->middleware('can:permission:maintenances.maintenance-of-computers.create');
	Route::put('maintenances.maintenance-of-computers/{historyMaintenance}', 'MaintenanceComputerController@update')->name('maintenances.maintenance-of-computers.update')
		->middleware('can:permission:maintenances.maintenance-of-computers.edit');
	Route::get('maintenances.maintenance-of-computers/{historyMaintenance}', 'MaintenanceComputerController@show')->name('maintenances.maintenance-of-computers.show')
		->middleware('can:permission:maintenances.maintenance-of-computers.show');
	Route::delete('maintenances.maintenance-of-computers/{historyMaintenance}', 'MaintenanceComputerController@destroy')->name('maintenances.maintenance-of-computers.destroy')
		->middleware('can:permission:maintenances.maintenance-of-computers.destroy');
	Route::get('maintenances.maintenance-of-computers/{historyMaintenance}/edit', 'MaintenanceComputerController@edit')->name('maintenances.maintenance-of-computers.edit')
		->middleware('can:permission:maintenances.maintenance-of-computers.edit');
	// maintenances history computers
	Route::get('maintenances.maintenance-of-computers.history', 'MaintenanceComputerController@historyMaintenances')->name('maintenances.maintenance-of-computers.history')
		->middleware('can:permission:maintenances.maintenance-of-computers.history');

	// maintenances printers
	Route::post('maintenances.maintenance-of-printers/store', 'MaintenancePrinterController@store')->name('maintenances.maintenance-of-printers.store')
		->middleware('can:permission:maintenances.maintenance-of-printers.create');
	Route::get('maintenances.maintenance-of-printers', 'MaintenancePrinterController@index')->name('maintenances.maintenance-of-printers.index')
		->middleware('can:permission:maintenances.maintenance-of-printers.index');
	Route::get('maintenances.maintenance-of-printers/{printer}/create', 'MaintenancePrinterController@create')->name('maintenances.maintenance-of-printers.create')
		->middleware('can:permission:maintenances.maintenance-of-printers.create');
	Route::put('maintenances.maintenance-of-printers/{historyMaintenance}', 'MaintenancePrinterController@update')->name('maintenances.maintenance-of-printers.update')
		->middleware('can:permission:maintenances.maintenance-of-printers.edit');
	Route::get('maintenances.maintenance-of-printers/{historyMaintenance}', 'MaintenancePrinterController@show')->name('maintenances.maintenance-of-printers.show')
		->middleware('can:permission:maintenances.maintenance-of-printers.show');
	Route::delete('maintenances.maintenance-of-printers/{historyMaintenance}', 'MaintenancePrinterController@destroy')->name('maintenances.maintenance-of-printers.destroy')
		->middleware('can:permission:maintenances.maintenance-of-printers.destroy');
	Route::get('maintenances.maintenance-of-printers/{historyMaintenance}/edit', 'MaintenancePrinterController@edit')->name('maintenances.maintenance-of-printers.edit')
		->middleware('can:permission:maintenances.maintenance-of-printers.edit');
	// maintenances history printers
	Route::get('maintenances.maintenance-of-printers.history', 'MaintenancePrinterController@historyMaintenances')->name('maintenances.maintenance-of-printers.history')
		->middleware('can:permission:maintenances.maintenance-of-printers.history');

		// maintenances other-peripherals
	Route::post('maintenances.maintenance-of-other-peripherals/store', 'MaintenanceOtherPeripheralController@store')->name('maintenances.maintenance-of-other-peripherals.store')
		->middleware('can:permission:maintenances.maintenance-of-other-peripherals.create');
	Route::get('maintenances.maintenance-of-other-peripherals', 'MaintenanceOtherPeripheralController@index')->name('maintenances.maintenance-of-other-peripherals.index')
		->middleware('can:permission:maintenances.maintenance-of-other-peripherals.index');
	Route::get('maintenances.maintenance-of-other-peripherals/{otherPeripheral}/create', 'MaintenanceOtherPeripheralController@create')->name('maintenances.maintenance-of-other-peripherals.create')
		->middleware('can:permission:maintenances.maintenance-of-other-peripherals.create');
	Route::put('maintenances.maintenance-of-other-peripherals/{historyMaintenance}', 'MaintenanceOtherPeripheralController@update')->name('maintenances.maintenance-of-other-peripherals.update')
		->middleware('can:permission:maintenances.maintenance-of-other-peripherals.edit');
	Route::get('maintenances.maintenance-of-other-peripherals/{historyMaintenance}', 'MaintenanceOtherPeripheralController@show')->name('maintenances.maintenance-of-other-peripherals.show')
		->middleware('can:permission:maintenances.maintenance-of-other-peripherals.show');
	Route::delete('maintenances.maintenance-of-other-peripherals/{historyMaintenance}', 'MaintenanceOtherPeripheralController@destroy')->name('maintenances.maintenance-of-other-peripherals.destroy')
		->middleware('can:permission:maintenances.maintenance-of-other-peripherals.destroy');
	Route::get('maintenances.maintenance-of-other-peripherals/{historyMaintenance}/edit', 'MaintenanceOtherPeripheralController@edit')->name('maintenances.maintenance-of-other-peripherals.edit')
		->middleware('can:permission:maintenances.maintenance-of-other-peripherals.edit');
	// maintenances history printers
	Route::get('maintenances.maintenance-of-other-peripherals.history', 'MaintenanceOtherPeripheralController@historyMaintenances')->name('maintenances.maintenance-of-other-peripherals.history')
		->middleware('can:permission:maintenances.maintenance-of-other-peripherals.history');

	// Ruta reports maintenances computers
	Route::get('reports.maintenance-of-computers/{historyMaintenance}/report', 'ReportController@downloadReportMaintenanceComputer')->name('reports.maintenance-of-computers.download')
		->middleware('can:permission:reports.maintenance-of-computers.download');

	// Ruta reports maintenances computers
	Route::get('reports.maintenance-of-printers/{historyMaintenance}/report', 'ReportController@downloadReportMaintenancePrinter')->name('reports.maintenance-of-printers.download')
		->middleware('can:permission:reports.maintenance-of-printers.download');
		
		



	Route::get('relationship-&-configurations', 'RelationshipConfigurationController@index')->name('relationship-&-configurations.index')
		->middleware('can:permission:relationship-&-configurations.index');


	});

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

use Jenssegers\Agent\Agent;

$agent = new Agent();

$browser = $agent->browser();
$version = $agent->version($browser);
$check = $browser.$version;

if($check == "IE8.0"){
	Route::get('/', function () {  
	    return view('errors/browsernotsupport');
	});
}else{
	Route::get('/', function () {  
	    return redirect('/login');
	});

	Route::post('loginadmin', 'Auth\SuperadminLoginController@login')->name('admingrup.login.submit');
	Route::get('/loginadmin', 'Auth\SuperadminLoginController@showLoginForm')->name('admingrup.login');


	// Route::get('/admin', 'AdminController@viewadmin');
	Route::get('/formajax/{id}', 'AjaxController@jabatanform');
	Route::get('/grup','GrupController@getkontakgrup');
	Route::get('/kontakAdmin/{id}','GrupController@getSA');
	Route::get('/kantorAddUserbiasa/{id}','KantorController@modalAddUser');



	// Route::get('/chart','MateriController@index'); 

	Auth::routes();

	//Route::get('/home', 'HomeController@index')->name('home');


	Route::group(['middleware' => ['auth','admin','revalidate']],function(){
	  Route::get('/pilihjabatan', function () {
	    return view('admin.pilihjabatan');
	  });
	Route::get('/pilihjabatan','AdminController@pilihjabatan');
	Route::get('/materisoal/{id}','MateriController@getmateriadmin');
	Route::get('/formmateri/{id}','MateriController@tambahmateri');
	Route::post('/tambahmateri','MateriController@postmateri');
	Route::put('/editmateri','MateriController@editmateri');
	Route::get('/tipetes/{id}','TestController@tipetes');
	Route::get('/formmodul/{id}','ModulController@tambahmodul');
	Route::post('/tambahmodul','ModulController@postmodul');
	Route::put('/editmodul','ModulController@editmodul');
	Route::get('/formtest/{id}','TestController@tambahtest');
	Route::post('/tambahtest','TestController@posttest');
	Route::put('/edittest','TestController@edittest');
	Route::delete('/hapustest/{id}','TestController@hapustest');
	Route::get('/formsoal/{id}','SoalController@tambahsoal');
	Route::post('/tambahsoal','SoalController@postsoal');
	Route::get('/editmodal/{id}', 'SoalController@editmodal');
	Route::put('/editsoal','SoalController@editsoal');
	Route::delete('/soal/{id}','SoalController@hapussoal');
	Route::get('/finishcreate/{id}','MateriController@finish');
	Route::get('/bonussoal','MateriController@getbonus');
	});

	Route::group(['middleware' => ['auth','revalidate']],function(){
	  Route::get('/home', function () {
	    if(Auth::user()->Status != 1){
	      return view('user.home');  
	    }else{
	      return view('admin.homeadmin');
	    }
		});
	  Route::get('/countdownmodul/{id}', 'ModulController@countdownmodul');
	  Route::get('/countdowntest/{id}', 'TestController@countdowntest');
	  Route::post('/submit', 'GradingController@submitjawaban');
	  Route::get('/materi/{status}', 'MateriController@getmateri');
	  Route::post('/enroll','EnrollController@enroll');
	  Route::get('/deskripsimateri/{id}','MateriController@singlemateri');
	  Route::get('/klikmodul/{id}','ModulController@kliktombolmodul');
	  Route::get('/bacamateri/{id}','ModulController@bacamodul');
	  Route::get('/deskripsitest/{id}','TestController@singletest');
	  Route::get('/kliksoal/{id}','TestController@kliktomboltest');
	  Route::get('/soal/{id}', 'TestController@ngerjaintest');
	  Route::get('/finish/{id}', 'PesertaController@finish');
	  Route::get('/hasiltest/{id}', 'AttemptController@hasil');
	  Route::get('/nilai','PesertaController@daftarnilai');
	  Route::get('/daftarnilai/{id}','AttemptController@daftarnilaitest');
	  Route::get('/review/{id}', 'AttemptController@review');
	  Route::get('/statistik','TestController@liststatistik');
	  Route::get('/charts/{id}','TestController@chart');
	  Route::get('/detailstatistik/{id}','PesertaController@statistik');
	  Route::get('/profil', 'UserController@profil');
	  Route::post('/compareusername','UserController@compareusername');
	  Route::put('/editusername','UserController@editusername');
	  Route::post('/comparepass', 'UserController@comparepass');
	  Route::put('/editpassword','UserController@editpassword');
	  Route::get('/bonussoal', 'MateriController@getbonus');
	  Route::get('/deskripsitesbonus/{id}','TestController@singletestbonus');
	});

	//ROUTE OPERATOR

	Route::group(['middleware' => ['ultraadmin','revalidate']],function(){
		Route::get('/getGroupUa/','GrupController@modalgrup');
		Route::get('/getEditGroupUa/{id}','GrupController@modaleditgrup');
		Route::get('/getAllGroup/','GrupController@getGroup');
		Route::get('/getTipe/','TipeKantorController@getTipe');
		Route::get('/getKantor/','KantorController@modalAddOperator');
		Route::get('/getEditKantor/{id}','KantorController@modalEditOperator');
		Route::get('/modaltambah/{id}','KantorController@modaltambah');
		Route::get('/modaledit/{id}','KantorController@modaledit');

		Route::prefix('operator')->group(function(){
			//menu admin group
			Route::get('/', 'SuperadminController@indexOperator')->name('operator.dashboard');
			Route::post('/admingroup','SuperadminController@findAction')->name('operator.editSuperadmin');
			Route::get('/admingroup', 'SuperadminController@viewSuperadmin')->name('operator.daftarSuperadmin');
			Route::post('/admingroup/add','SuperadminController@addSuperadmin')->name('operator.addAdmin.submit');
			Route::get('/admingroup/search','SuperadminController@searchSuperadmin')->name('operator.searchAdmin');
			//menu group
			Route::post('/group','GrupController@findAction')->name('operator.editGroup');
			Route::get('/group','GrupController@viewGroup')->name('operator.daftarGroup');
			Route::post('/group/add','GrupController@addGroup')->name('operator.addGroup.submit');
			Route::get('/group/search','GrupController@searchGroup')->name('operator.searchGroup');
			//menu kantor
			Route::post('/kantor','KantorController@addKantor')->name('operator.addKantor');
			Route::get('/kantor', 'KantorController@viewKantor')->name('operator.daftarKantor');
			Route::put('/kantor','KantorController@editKantor')->name('operator.editKantor');
			Route::delete('/kantor/{id}','KantorController@deleteKantor')->name('operator.deleteKantor');
			Route::get('/kantor/search','KantorController@searchKantor')->name('operator.searchKantor');
			Route::get('/modaltambah/{id}','KantorController@modaltambah');
			//menu tipe kantor
			Route::post('/tipekantor','TipeKantorController@addTipekantor')->name('operator.addTipe');
			Route::put('/tipekantor','TipeKantorController@editTipekantor')->name('operator.editTipe');
			Route::delete('/tipekantor/{id}','TipeKantorController@deleteTipekantor')->name('operator.deleteTipe');

			//menu my profile
			Route::put('/profile','SuperadminController@editProfile')->name('operator.editProfile');
			Route::get('/profile','SuperadminController@viewProfile')->name('operator.myProfile');

		});
	});

	//ROUTE ADMINGRUP

	Route::group(['middleware' =>['auth:superadmin','superadmin','revalidate']],function(){
		Route::get('/getAllTipe/','TipeKantorController@getTipe');
		Route::get('/editAdmin/{id}','JabatanController@modalEditAdmin');
		Route::get('/addAdmin/{id}','JabatanController@modalAddAdmin');
		Route::get('/filterTipe/','TipeKantorController@filterTipe');
		Route::get('/filterKantor/{id}','KantorController@filterkantor');
		Route::get('/addUser/','JabatanController@modalAddUser');
		Route::get('/kantorAddUser/{id}','KantorController@modalAddUser');
		Route::get('/getMateri/{j}/{id}', 'MateriController@filterRekap')->name('admingrup.rekap');
		Route::get('/getGroup/','GrupController@modalgrup');
		Route::get('/getEditGroup/{id}','GrupController@modaleditgrup');

		Route::prefix('admin')->group(function() {
			//dashboard dan statistik
			Route::get('/', 'SuperadminController@index')->name('admingrup.dashboard');
			Route::get('/chart/{id}','TestController@chart');
			//menu jabatan
			Route::post('/jabatan','JabatanController@addJabatan')->name('admingrup.addJabatan');
			Route::get('/jabatan', 'JabatanController@viewJabatan')->name('admingrup.daftarJabatan');
			Route::put('/jabatan','JabatanController@editJabatan')->name('admingrup.editJabatan');
			Route::delete('/jabatan/{id}','JabatanController@deleteJabatan')->name('admingrup.deleteJabatan');
			Route::get('/jabatan/search','JabatanController@searchJabatan')->name('admingrup.searchJabatan');
			//menu kelola user
			Route::get('/users', 'UserController@viewUsers')->name('admingrup.daftarUser');
			Route::put('/users','UserController@editUser')->name('admingrup.editUser');
			Route::delete('/users/{id}','UserController@deleteUser')->name('admingrup.deleteUser');
			Route::get('/users/data', 'UserController@added_user')->name('admingrup.dataUser');
			Route::get('/users/search','UserController@searchUsers')->name('admingrup.searchUser');
			Route::get('/users/data/search','UserController@searchAdded_user')->name('admingrup.dataUser.search');
			
			//menu admin
			Route::post('/admins','AdminController@findAction')->name('admingrup.editAdmin');
			Route::get('/admins', 'AdminController@viewAdmin')->name('admingrup.daftarAdmin');
			Route::get('/admins/search','AdminController@searchAdmin')->name('admingrup.searchAdmin');
			Route::post('/admins/add','AdminController@assignAdmin')->name('admingrup.addAdmin.submit');
			Route::get('/admins/add','UserController@viewUsers_sa')->name('admingrup.addAdmin');
			Route::get('/admins/add/search','UserController@searchUsers_sa')->name('admingrup.addAdmin.search');
			//menu buat soal
			Route::get('/pilihjabatan','AdminController@pilihjabatan');
			Route::get('/materisoal/{id}','MateriController@getmateriadmin');
			Route::get('/formmateri/{id}','MateriController@tambahmateri');
			Route::get('/tipetes/{id}','TestController@tipetes');
			Route::get('/formmodul/{id}','ModulController@tambahmodul');
			Route::get('/formtest/{id}','TestController@tambahtest');
			Route::get('/formsoal/{id}','SoalController@tambahsoal');

			//menu rekap
			Route::get('/rekap', 'SuperadminController@viewRekap')->name('admingrup.rekap');
			Route::get('/rekap/tabel/{id}', 'SuperadminController@getdataRekap')->name('admingrup.tabelrekap');
	  		Route::get('/download/pdf','SuperadminController@pdfview')->name('admingrup.downloadpdf');
			//menu level
			Route::post('/tambahlevel', 'LevelController@tambahlevel');
			Route::put('/editlevel', 'LevelController@editlevel');
			Route::put('/resetlevel', 'LevelController@resetlevel');
			Route::get('/level', 'LevelController@level')->name('admingrup.daftarLevel');
			Route::get('/getlevel/{id}', 'LevelController@singlelevel');
			Route::delete('/hapuslevel/{id}','LevelController@hapuslevel');

			//menu soal bonus
			Route::get('/soalbonus','MateriController@getbonus');
			Route::get('/formmateribonus/{id}','MateriController@tambahmateribonus');
			Route::post('/tambahmateri','MateriController@postmateri');
			Route::put('/editmateri','MateriController@editmateri');
			Route::get('/tipetesbonus/{id}','TestController@tipetesbonus');
			Route::get('/formmodulbonus/{id}','ModulController@tambahmodulbonus');
			Route::post('/tambahmodul','ModulController@postmodul');
			Route::put('/editmodul','ModulController@editmodul');
			Route::get('/formtestbonus/{id}','TestController@tambahtestbonus');
			Route::post('/tambahtest','TestController@posttest');
			Route::put('/edittest','TestController@edittest');
			Route::delete('/hapustest/{id}','TestController@hapustest');
			Route::get('/formsoalbonus/{id}','SoalController@tambahsoalbonus');
			Route::post('/tambahsoal','SoalController@postsoal');
			Route::get('/editmodal/{id}', 'SoalController@editmodal');
			Route::put('/editsoal','SoalController@editsoal');
			Route::delete('/soal/{id}','SoalController@hapussoal');
			Route::get('/finishcreate/{id}','MateriController@finish');
		});
	});
}
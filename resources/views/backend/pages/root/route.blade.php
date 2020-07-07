@php
	$created = ucwords(preg_replace("/[\-_]/", " ",  $created));
	$created_ = strtolower(preg_replace("/[\s+]/", "_", $created));
	$created = preg_replace("/[\s+]/", "", $created);
@endphp

@php
$route_data = "".$tab."/**\t\n
".$tab."* ". ucwords($created) ."\t\n
".$tab."**/\t\n";
@endphp

@if($type_ == 'oneClickAll')
@php
$route_data .="".$tab."Route::group(['prefix' => '". $created_ ."'], function(){\t\n
".$tab.$tab."Route::get('/', 'Backend\\". ucfirst($created) ."Controller@index')->name('admin.". $created_ .".index');\t\n
".$tab.$tab."Route::get('/add', 'Backend\\". ucfirst($created) ."Controller@add')->name('admin.". $created_ .".add');\t\n
".$tab.$tab."Route::post('/add', 'Backend\\". ucfirst($created) ."Controller@store')->name('admin.". $created_ .".store');\t\n
".$tab.$tab."Route::get('/edit/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@edit')->name('admin.". $created_ .".edit');\t\n
".$tab.$tab."Route::post('/edit/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@update')->name('admin.". $created_ .".update');\t\n
".$tab.$tab."Route::get('/delete/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@delete')->name('admin.". $created_ .".delete');\t\n
".$tab."});\t\n
\t\n";
@endphp

@elseif($type_ == 'oneClickAllWithView')
@php
$route_data .="
".$tab."Route::group(['prefix' => '". $created_ ."'], function(){\t\n
".$tab.$tab."Route::get('/', 'Backend\\". ucfirst($created) ."Controller@index')->name('admin.". $created_ .".index');\t\n
".$tab.$tab."Route::get('/add', 'Backend\\". ucfirst($created) ."Controller@add')->name('admin.". $created_ .".add');\t\n
".$tab.$tab."Route::post('/add', 'Backend\\". ucfirst($created) ."Controller@store')->name('admin.". $created_ .".store');\t\n
".$tab.$tab."Route::get('/view/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@view')->name('admin.". $created_ .".view');\t\n
".$tab.$tab."Route::get('/edit/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@edit')->name('admin.". $created_ .".edit');\t\n
".$tab.$tab."Route::post('/edit/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@update')->name('admin.". $created_ .".update');\t\n
".$tab.$tab."Route::get('/delete/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@delete')->name('admin.". $created_ .".delete');\t\n
".$tab."});\t\n
\t\n";
@endphp

@elseif($type_ == 'modal')
@php
$route_data .="
".$tab."Route::group(['prefix' => '". $created_ ."'], function(){\t\n
".$tab.$tab."Route::get('/', 'Backend\\". ucfirst($created) ."Controller@index')->name('admin.". $created_ .".index');\t\n
".$tab.$tab."Route::post('/add', 'Backend\\". ucfirst($created) ."Controller@store')->name('admin.". $created_ .".store');\t\n
".$tab.$tab."Route::post('/edit/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@update')->name('admin.". $created_ .".update');\t\n
".$tab.$tab."Route::get('/delete/{encrypted_id}', 'Backend\\". ucfirst($created) ."Controller@delete')->name('admin.". $created_ .".delete');\t\n
".$tab."});\t\n
\t\n";
@endphp

@else
@php
$route_data .="
".$tab."Route::group(['prefix' => '". $created_ ."'], function(){\t\n
".$tab.$tab."Route::get('/', 'Backend\\". ucfirst($created) ."Controller@". $type_ ."')->name('admin.". $created_ .".". $type_ ."');\t\n
".$tab."});\t\n
\t\n";
@endphp
@endif

@php
	App\Helpers\FileHelper::insert('routes', 'web', $route_data);
@endphp
{!! $tab !!}/**<br>
{!! $tab !!}* <strong>{{ ucwords($created) }}</strong><br>
{!! $tab !!}**/<br>
@if($type_ == 'oneClickAll')
{!! $tab !!}Route::group(['prefix' => '{{ $created_ }}'], function(){<br>
{!! $tab.$tab !!}Route::get('/', 'Backend\{{ ucfirst($created) }}Controller&commat;index')->name('admin.{{ $created_ }}.index');<br>
{!! $tab.$tab !!}Route::get('/add', 'Backend\{{ ucfirst($created) }}Controller&commat;add')->name('admin.{{ $created_ }}.add');<br>
{!! $tab.$tab !!}Route::post('/add', 'Backend\{{ ucfirst($created) }}Controller&commat;store')->name('admin.{{ $created_ }}.store');<br>
{!! $tab.$tab !!}Route::get('/edit/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;edit')->name('admin.{{ $created_ }}.edit');<br>
{!! $tab.$tab !!}Route::post('/edit/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;update')->name('admin.{{ $created_ }}.update');<br>
{!! $tab.$tab !!}Route::get('/delete/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;delete')->name('admin.{{ $created_ }}.delete');<br>
{!! $tab !!}});<br><br>

@elseif($type_ == 'oneClickAllWithView')
{!! $tab !!}Route::group(['prefix' => '{{ $created_ }}'], function(){<br>
{!! $tab.$tab !!}Route::get('/', 'Backend\{{ ucfirst($created) }}Controller&commat;index')->name('admin.{{ $created_ }}.index');<br>
{!! $tab.$tab !!}Route::get('/add', 'Backend\{{ ucfirst($created) }}Controller&commat;add')->name('admin.{{ $created_ }}.add');<br>
{!! $tab.$tab !!}Route::post('/add', 'Backend\{{ ucfirst($created) }}Controller&commat;store')->name('admin.{{ $created_ }}.store');<br>
{!! $tab.$tab !!}Route::get('/view/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;view')->name('admin.{{ $created_ }}.view');<br>
{!! $tab.$tab !!}Route::get('/edit/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;edit')->name('admin.{{ $created_ }}.edit');<br>
{!! $tab.$tab !!}Route::post('/edit/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;update')->name('admin.{{ $created_ }}.update');<br>
{!! $tab.$tab !!}Route::get('/delete/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;delete')->name('admin.{{ $created_ }}.delete');<br>
{!! $tab !!}});<br><br>

@elseif($type_ == 'modal')
{!! $tab !!}Route::group(['prefix' => '{{ $created_ }}'], function(){<br>
{!! $tab.$tab !!}Route::get('/', 'Backend\{{ ucfirst($created) }}Controller&commat;index')->name('admin.{{ $created_ }}.index');<br>
{!! $tab.$tab !!}Route::post('/add', 'Backend\{{ ucfirst($created) }}Controller&commat;store')->name('admin.{{ $created_ }}.store');<br>
{!! $tab.$tab !!}Route::post('/edit/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;update')->name('admin.{{ $created_ }}.update');<br>
{!! $tab.$tab !!}Route::get('/delete/{encrypted_id}', 'Backend\{{ ucfirst($created) }}Controller&commat;delete')->name('admin.{{ $created_ }}.delete');<br>
{!! $tab !!}});<br><br>

@else
{!! $tab !!}Route::group(['prefix' => '{{ $created_ }}'], function(){<br>
{!! $tab.$tab !!}Route::get('/<strong>{{ $created_ }}</strong>{{ $type_ == 'index' ? '' : '/'.$type_ }}', 'Backend\{{ ucfirst($created) }}Controller&commat;{{ $type_ }}')->name('admin.{{ $created_ }}.{{ $type_ }}');<br>
{!! $tab !!}});<br><br>

@endif
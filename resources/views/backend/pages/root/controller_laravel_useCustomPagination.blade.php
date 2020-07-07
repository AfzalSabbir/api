
@php
    //$created = ucwords(preg_replace("/[\-_]/", " ",  $created));
    $created_ = strtolower(preg_replace("/[\s+]/", "_", $created));
    // $created = preg_replace("/[\s+]/", "", $created);
	$CreateD = preg_replace("/[\s+]/", "", ucwords(preg_replace("/[\-_]/", " ",  $created)));
@endphp

@php
$data = "<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ImageUploadHelper;
use App\Helpers\QueryHelper;
use App\Helpers\StringHelper;
use App\Helpers\NumberHelper;
use App\Models\\".$CreateD.";

class ".$CreateD."Controller extends Controller
{
".$tab."/**
".$tab." * Site Access
".$tab."**/
".$tab."public function __construct()
".$tab."{
".$tab."".$tab."\$this->middleware('admin');
".$tab."".$tab."\$this->initalItems = 20; //pagination per page items
".$tab."}

";
@endphp
@if($type_ == 'oneClickAll')
@php
$data .= "".$tab."public function index()
".$tab."{
".$tab.$tab."if (request()->filled('items')) {
".$tab.$tab.$tab."\$items = request()->items;
".$tab.$tab."}else{
".$tab.$tab.$tab."\$items = \$this->initalItems;
".$tab.$tab."}
".$tab.$tab."/*\$rows = ".$CreateD."::orderBy('status', 'desc')
".$tab.$tab.$tab.$tab."->orderBy('id', 'desc')
".$tab.$tab.$tab.$tab."->paginate(\$items);*/
".$tab.$tab."//\$total = \$rows->total();
".$tab."".$tab."return view('backend.pages.".$created.".index'/*, compact('rows', 'total', 'items')*/);
".$tab."}

".$tab."public function add()
".$tab."{
".$tab."".$tab."return view('backend.pages.".$created.".add');
".$tab."}

".$tab."public function store(Request \$request)
".$tab."{
".$tab.$tab."\$this->validate(\$request, [
".$tab."".$tab."".$tab."'' => '',
".$tab."".$tab."]);
".$tab.$tab."\$data = \$request->except(['_token']);
".$tab."".$tab."QueryHelper::simpleInsert('".$CreateD."', \$data);
".$tab."".$tab."session()->flash('add_message', 'Added');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}

".$tab."public function edit(\$id)
".$tab."{
".$tab.$tab."\$id = decrypt(\$id);
".$tab.$tab."//\$row = ".$CreateD."::where('id', \$id)->first();
".$tab."".$tab."return view('backend.pages.".$created.".edit'/*, compact('row')*/);
".$tab."}

".$tab."public function update(Request \$request, \$id)
".$tab."{
".$tab.$tab."\$id = decrypt(\$id);
".$tab.$tab."\$".$created." = ".$CreateD."::where('id', \$id)->first();
".$tab.$tab."\$this->validate(\$request, [
".$tab."".$tab."".$tab."'' => '',
".$tab."".$tab."]);
".$tab.$tab."\$data = \$request->except(['_token']);
".$tab.$tab."\$".$created."->update(\$data);
".$tab."".$tab."session()->flash('update_message', 'Added');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}

".$tab."public function delete(\$id)
".$tab."{
".$tab.$tab."\$".$created." = ".$CreateD."::where('id', decrypt(\$id))->delete();
".$tab."".$tab."session()->flash('inactive_message', 'Inactived');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}
}";
@endphp
@elseif($type_ == 'oneClickAllWithView')
@php
$data .= "".$tab."public function index()
".$tab."{
".$tab.$tab."if (request()->filled('items')) {
".$tab.$tab.$tab."\$items = request()->items;
".$tab.$tab."}else{
".$tab.$tab.$tab."\$items = \$this->initalItems;
".$tab.$tab."}
".$tab.$tab."/*\$rows = ".$CreateD."::orderBy('status', 'desc')
".$tab.$tab.$tab.$tab."->orderBy('id', 'desc')
".$tab.$tab.$tab.$tab."->paginate(\$items);*/
".$tab.$tab."//\$total = \$rows->total();
".$tab."".$tab."return view('backend.pages.".$created.".index'/*, compact('rows', 'total', 'items')*/);
".$tab."}

".$tab."public function add()
".$tab."{
".$tab."".$tab."return view('backend.pages.".$created.".add');
".$tab."}

".$tab."public function store(Request \$request)
".$tab."{
".$tab.$tab."\$this->validate(\$request, [
".$tab."".$tab."".$tab."'' => '',
".$tab."".$tab."]);
".$tab.$tab."\$data = \$request->except(['_token']);
".$tab."".$tab."QueryHelper::simpleInsert('".$CreateD."', \$data);
".$tab."".$tab."session()->flash('add_message', 'Added');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}

".$tab."public function view(\$id)
".$tab."{
".$tab.$tab."\$id = decrypt(\$id);
".$tab.$tab."//\$row = ".$CreateD."::where('id', \$id)->first();
".$tab."".$tab."return view('backend.pages.".($created).".view'/*, compact('row')*/);
".$tab."}

".$tab."public function edit(\$id)
".$tab."{
".$tab.$tab."\$id = decrypt(\$id);
".$tab.$tab."//\$row = ".$CreateD."::where('id', \$id)->first();
".$tab."".$tab."return view('backend.pages.".$created.".edit'/*, compact('row')*/);
".$tab."}

".$tab."public function update(Request \$request, \$id)
".$tab."{
".$tab.$tab."\$id = decrypt(\$id);
".$tab.$tab."\$".$created." = ".$CreateD."::where('id', \$id)->first();
".$tab.$tab."\$this->validate(\$request, [
".$tab."".$tab."".$tab."'' => '',
".$tab."".$tab."]);
".$tab.$tab."\$data = \$request->except(['_token']);
".$tab.$tab."\$".$created."->update(\$data);
".$tab."".$tab."session()->flash('update_message', 'Added');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}

".$tab."public function delete(\$id)
".$tab."{
".$tab.$tab."\$".$created." = ".$CreateD."::where('id', decrypt(\$id))->delete();
".$tab."".$tab."session()->flash('inactive_message', 'Inactived');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}
}";
@endphp
@elseif($type_ == 'modal')
@php
$data .= "".$tab."public function index()
".$tab."{
".$tab.$tab."if (request()->filled('items')) {
".$tab.$tab.$tab."\$items = request()->items;
".$tab.$tab."}else{
".$tab.$tab.$tab."\$items = \$this->initalItems;
".$tab.$tab."}
".$tab.$tab."/*\$rows = ".$CreateD."::orderBy('status', 'desc')
".$tab.$tab.$tab.$tab."->orderBy('id', 'desc')
".$tab.$tab.$tab.$tab."->paginate(\$items);*/
".$tab.$tab."//\$total = \$rows->total();
".$tab."".$tab."return view('backend.pages.".$created.".index'/*, compact('rows', 'total', 'items')*/);
".$tab."}

".$tab."public function store(Request \$request)
".$tab."{
".$tab.$tab."\$this->validate(\$request, [
".$tab."".$tab."".$tab."'' => '',
".$tab."".$tab."]);
".$tab.$tab."\$data = \$request->except(['_token']);
".$tab."".$tab."QueryHelper::simpleInsert('".$CreateD."', \$data);
".$tab."".$tab."session()->flash('add_message', 'Added');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}

".$tab."public function update(Request \$request, \$id)
".$tab."{
".$tab.$tab."\$id = decrypt(\$id);
".$tab.$tab."\$".$created." = ".$CreateD."::where('id', \$id)->first();
".$tab.$tab."\$this->validate(\$request, [
".$tab."".$tab."".$tab."'' => '',
".$tab."".$tab."]);
".$tab.$tab."\$data = \$request->except(['_token']);
".$tab.$tab."\$".$created."->update(\$data);
".$tab."".$tab."session()->flash('update_message', 'Added');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}

".$tab."public function delete(\$id)
".$tab."{
".$tab.$tab."\$".$created." = ".$CreateD."::where('id', decrypt(\$id))->delete();
".$tab."".$tab."session()->flash('inactive_message', 'Inactived');
".$tab."".$tab."return redirect()->route('admin.".$created.".index');
".$tab."}
}";
@endphp
@else
@php
$data .= "
}";
@endphp
@endif

@php
	$CreateDController = $CreateD.'Controller';
	$base = 'app/Http/Controllers/Backend';
	App\Helpers\FileHelper::read_and_write($base, $CreateDController, $data);
@endphp

&lt;?php<br><br>
<br>
namespace App\Http\Controllers\Backend;<br>
<br>
use Illuminate\Support\Facades\Blade;<br>
use Illuminate\Http\Request;<br>
use App\Http\Controllers\Controller;<br>
use App\Helpers\ImageUploadHelper;<br>
use App\Helpers\QueryHelper;<br>
use App\Helpers\StringHelper;<br>
use App\Helpers\NumberHelper;<br>
use App\Models\{{ $CreateD }};<br>
<br>
class {{ $CreateD }}Controller extends Controller<br>
{<br><br>
{!! $tab !!}/**<br>
{!! $tab !!} * Site Access<br>
{!! $tab !!}**/<br>
{!! $tab !!}public function __construct()<br>
{!! $tab !!}{<br>
{!! $tab !!}{!! $tab !!}&dollar;this->middleware('admin');<br>
{!! $tab !!}{!! $tab !!}&dollar;this->initalItems = 20; //pagination per page items<br>
{!! $tab !!}}<br>

@if($type_ == 'oneClickAll')<br>
{!! $tab !!}public function index()<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}if (request()->filled('items')) {<br>
{!! $tab.$tab.$tab !!}&dollar;items = request()->items;<br>
{!! $tab.$tab !!}}else{<br>
{!! $tab.$tab.$tab !!}&dollar;items = &dollar;this->initalItems;<br>
{!! $tab.$tab !!}}<br>
{!! $tab.$tab !!}/*&dollar;rows = {{ $CreateD }}::orderBy('status', 'desc')<br>
{!! $tab.$tab.$tab.$tab !!}->orderBy('id', 'desc')<br>
{!! $tab.$tab.$tab.$tab !!}->paginate(&doller;items);*/<br>
{!! $tab.$tab !!}//$total = $rows->total();<br>
{!! $tab !!}{!! $tab !!}return view('backend.pages.{{ $created }}.index'/*, compact('rows', 'total', 'items')*/);<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function add()<br>
{!! $tab !!}{<br>
{!! $tab !!}{!! $tab !!}return view('backend.pages.{{ $created }}.add');<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function store(Request &dollar;request)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;this->validate(&dollar;request, [<br>
{!! $tab !!}{!! $tab !!}{!! $tab !!}'' => '',<br>
{!! $tab !!}{!! $tab !!}]);<br>
{!! $tab.$tab !!}&dollar;data = &dollar;request->except(['_token']);<br>
{!! $tab !!}{!! $tab !!}QueryHelper::simpleInsert('{{ $CreateD }}', &dollar;data);<br>
{!! $tab !!}{!! $tab !!}session()->flash('add_message', 'Added');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function edit(&dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;id = decrypt(&dollar;id);<br>
{!! $tab.$tab !!}//&dollar;row = {{ $CreateD }}::where('id', &dollar;id)->first();<br>
{!! $tab !!}{!! $tab !!}return view('backend.pages.{{ $created }}.edit'/*, compact('row')*/);<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function update(Request &dollar;request, &dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;id = decrypt(&dollar;id);<br>
{!! $tab.$tab !!}&dollar;{{ $created }} = {{ $CreateD }}::where('id', &dollar;id)->first();<br>
{!! $tab.$tab !!}&dollar;this->validate(&dollar;request, [<br>
{!! $tab !!}{!! $tab !!}{!! $tab !!}'' => '',<br>
{!! $tab !!}{!! $tab !!}]);<br>
{!! $tab.$tab !!}&dollar;data = &dollar;request->except(['_token']);<br>
{!! $tab.$tab !!}&dollar;{{ $created }}->update(&dollar;data);<br>
{!! $tab !!}{!! $tab !!}session()->flash('update_message', 'Added');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function delete(&dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;{{ $created }} = {{ $CreateD }}::where('id', decrypt(&dollar;id))->delete();<br>
{!! $tab !!}{!! $tab !!}session()->flash('inactive_message', 'Inactived');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br>
}<br>
@elseif($type_ == 'oneClickAllWithView')<br>
{!! $tab !!}public function index()<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}if (request()->filled('items')) {<br>
{!! $tab.$tab.$tab !!}&dollar;items = request()->items;<br>
{!! $tab.$tab !!}}else{<br>
{!! $tab.$tab.$tab !!}&dollar;items = &dollar;this->initalItems;<br>
{!! $tab.$tab !!}}<br>
{!! $tab.$tab !!}/*&dollar;rows = {{ $CreateD }}::orderBy('status', 'desc')<br>
{!! $tab.$tab.$tab.$tab !!}->orderBy('id', 'desc')<br>
{!! $tab.$tab.$tab.$tab !!}->paginate(&doller;items);*/<br>
{!! $tab.$tab !!}//$total = $rows->total();<br>
{!! $tab !!}{!! $tab !!}return view('backend.pages.{{ $created }}.index'/*, compact('rows', 'total', 'items')*/);<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function add()<br>
{!! $tab !!}{<br>
{!! $tab !!}{!! $tab !!}return view('backend.pages.{{ $created }}.add');<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function store(Request &dollar;request)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;this->validate(&dollar;request, [<br>
{!! $tab !!}{!! $tab !!}{!! $tab !!}'' => '',<br>
{!! $tab !!}{!! $tab !!}]);<br>
{!! $tab.$tab !!}&dollar;data = &dollar;request->except(['_token']);<br>
{!! $tab !!}{!! $tab !!}QueryHelper::simpleInsert('{{ $CreateD }}', &dollar;data);<br>
{!! $tab !!}{!! $tab !!}session()->flash('add_message', 'Added');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function view(&dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;id = decrypt(&dollar;id);<br>
{!! $tab.$tab !!}//&dollar;row = {{ $CreateD }}::where('id', &dollar;id)->first();<br>
{!! $tab !!}{!! $tab !!}return view('backend.pages.{{ ($created) }}.view'/*, compact('row')*/);<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function edit(&dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;id = decrypt(&dollar;id);<br>
{!! $tab.$tab !!}//&dollar;row = {{ $CreateD }}::where('id', &dollar;id)->first();<br>
{!! $tab !!}{!! $tab !!}return view('backend.pages.{{ $created }}.edit'/*, compact('row')*/);<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function update(Request &dollar;request, &dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;id = decrypt(&dollar;id);<br>
{!! $tab.$tab !!}&dollar;{{ $created }} = {{ $CreateD }}::where('id', &dollar;id)->first();<br>
{!! $tab.$tab !!}&dollar;this->validate(&dollar;request, [<br>
{!! $tab !!}{!! $tab !!}{!! $tab !!}'' => '',<br>
{!! $tab !!}{!! $tab !!}]);<br>
{!! $tab.$tab !!}&dollar;data = &dollar;request->except(['_token']);<br>
{!! $tab.$tab !!}&dollar;{{ $created }}->update(&dollar;data);<br>
{!! $tab !!}{!! $tab !!}session()->flash('update_message', 'Added');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function delete(&dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;{{ $created }} = {{ $CreateD }}::where('id', decrypt(&dollar;id))->delete();<br>
{!! $tab !!}{!! $tab !!}session()->flash('inactive_message', 'Inactived');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br>
}<br>
@elseif($type_ == 'modal')
{!! $tab !!}public function index()<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}if (request()->filled('items')) {<br>
{!! $tab.$tab.$tab !!}&dollar;items = request()->items;<br>
{!! $tab.$tab !!}}else{<br>
{!! $tab.$tab.$tab !!}&dollar;items = &dollar;this->initalItems;<br>
{!! $tab.$tab !!}}<br>
{!! $tab.$tab !!}/*&dollar;rows = {{ $CreateD }}::orderBy('status', 'desc')<br>
{!! $tab.$tab.$tab.$tab !!}->orderBy('id', 'desc')<br>
{!! $tab.$tab.$tab.$tab !!}->paginate($items);*/<br>
{!! $tab.$tab !!}//$total = $rows->total();<br>
{!! $tab !!}{!! $tab !!}return view('backend.pages.{{ $created }}.index'/*, compact('rows', 'total', 'items')*/);<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function store(Request &dollar;request)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;this->validate(&dollar;request, [<br>
{!! $tab !!}{!! $tab !!}{!! $tab !!}'' => '',<br>
{!! $tab !!}{!! $tab !!}]);<br>
{!! $tab.$tab !!}&dollar;data = &dollar;request->except(['_token']);<br>
{!! $tab !!}{!! $tab !!}QueryHelper::simpleInsert('{{ $CreateD }}', &dollar;data);<br>
{!! $tab !!}{!! $tab !!}session()->flash('add_message', 'Added');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function update(Request &dollar;request, &dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;id = decrypt(&dollar;id);<br>
{!! $tab.$tab !!}&dollar;{{ $created }} = {{ $CreateD }}::where('id', &dollar;id)->first();<br>
{!! $tab.$tab !!}&dollar;this->validate(&dollar;request, [<br>
{!! $tab !!}{!! $tab !!}{!! $tab !!}'' => '',<br>
{!! $tab !!}{!! $tab !!}]);<br>
{!! $tab.$tab !!}&dollar;data = &dollar;request->except(['_token']);<br>
{!! $tab.$tab !!}&dollar;{{ $created }}->update(&dollar;data);<br>
{!! $tab !!}{!! $tab !!}session()->flash('update_message', 'Added');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br><br>

{!! $tab !!}public function delete(&dollar;id)<br>
{!! $tab !!}{<br>
{!! $tab.$tab !!}&dollar;{{ $created }} = {{ $CreateD }}::where('id', decrypt(&dollar;id))->delete();<br>
{!! $tab !!}{!! $tab !!}session()->flash('inactive_message', 'Inactived');<br>
{!! $tab !!}{!! $tab !!}return redirect()->route('admin.{{ $created }}.index');<br>
{!! $tab !!}}<br>
}<br>
@else
}<br>
<script type="text/javascript">
    $('.text_2-container').hide();
</script>
@endif
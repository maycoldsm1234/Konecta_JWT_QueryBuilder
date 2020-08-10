<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    protected function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'vendedor']);
		
		$clients = $this->listado();
		$title = 'Clientes';
        return view('clientes', compact('clients', 'title'));
    }
	
	public function register(Request $request)
    {
        $queryState = DB::insert('insert into clients (id, doc, name, dir, tel, email) values (?, ?, ?, ?, ?, ?)', [1, $request->input('doc'), $request->input('name'), $request->input('dir'), $request->input('tel'), $request->input('email')]);
		
		if($queryState) {
			return array('success' => true);
		} else {
			return array('success' => false);
		}
    }
	
	public function edit(Request $request)
    {
		$affected = DB::table('clients')
              ->where('id', $request->input('id_cliente'))
              ->update([
				  'doc' => $request->input('doc'),
				  'name' => $request->input('name'),
				  'dir' => $request->input('dir'),
				  'tel' => $request->input('tel'),
				  'email' => $request->input('email')
			  ]);
 
		if($affected){
			return array('success' => true);
        }else{
			return array('success' => false);
		}
    }
	
	public function delete(Request $request)
    {
        $affected = DB::table('clients')->where('id', '=', $request->input('id_cliente'))->delete();
		
		if($affected){
			return array('success' => true);
		}else{
			return array('success' => false);
		}
    }
	
	public function listado(){
		$clients = DB::table('clients')
			->get();
		
		return $clients;
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(User $usuarios)
    {
        $this->users = $usuarios;
    }

    public function index(Request $request)
    {
        $pesquisar = $request->pesquisar;
        $findUsuario = $this->user->getUsuario(search: $pesquisar ?? '');
        return view('', compact('programas'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = User::find($id);
        $buscaRegistro->delete();

        return response()->json(['success' => true]);
    }

    public function cadastrarUsuario(Request $request)
    {
        $data = $request->data;

        User::create($data);
        return redirect()->route('usuario.index');
    }

    public static function atualizarUsuario(Request $request, $id_usuario)
    {
        if ($request->method() == "PUT") {
            $data = $request->all();
            $usuario = User::find($id_usuario);
            $usuario->update($data);

            Toastr::success('Usuário atualizado com sucesso', 'Sucesso');
            return redirect()->route('usuario.index');
        
        }

        $usuario = User::find($id_usuario);
        
        return view('pages.usuario.atualiza', compact('usuario'));
    }
}

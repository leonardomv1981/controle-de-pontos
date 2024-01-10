<?php

namespace App\Http\Controllers;

use App\Models\Produtomilhas;
use Illuminate\Http\Request;

class ProdutosmilhasController extends Controller
{

    public function __construct(Produtomilhas $produtoMilhas)
    {
        $this->produtoMilhas = $produtoMilhas;
    }

    public function index (Request $request) {
        $findProduto = $this->produtoMilhas->getProdutosPesquisarIndex(search: $request->pesquisar ?? '');
        return view('pages.produto-milhas.paginacao', compact('findProduto'));
    }

    public function delete (Request $request)
    {
        
    }

    // public function listarPorPrograma ($data) {
    //     dd($data);
    //     $findProduto = Produtomilhas::where('nome_programa', '=', 'AA')->get();
    //     dd($findProduto);
    // }
}

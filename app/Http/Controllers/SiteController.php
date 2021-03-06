<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;
use App\Evento;
use App\Inscrito;
use App\Artigo;

class SiteController extends Controller
{
    /**
     * Mostra a pagina inicial.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $noticia = Noticia::all();
        $eventos = Evento::all();
        $e_insc = Evento::where('inscrever',1)->get();
        $artigos = Artigo::all();
        $i = 0;
        $ie = Evento::count();
        
        return view('welcome', compact('noticia','eventos','artigos','e_insc', 'i', 'ie'));
    }

    /**
     * Mostra a noticia.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function inscrever(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'cpf' => 'required|numeric|max:11',
            'tel' => 'required|numeric|max:11',
            'email' => 'required|email',
            'evento' => 'required',
        ]);
        $evento = Inscrito::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'tel' => $request->tel,
            'email' => $request->email,
            'eventos_id' => $request->evento,
        ]);
        return redirect()->route('barra');
    }

    /**
     * Mostra a pagina de noticias e listar todas com paginação.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function noticia()
    {
        $noticia = Noticia::all();
        return view('noticias', compact('noticia'));
    }

    /**
     * Mostra a pagina de noticias e listar todas com paginação.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function evento()
    {
        $evento = Evento::all();
        return view('eventos', compact('evento'));
    }

    /**
     * Mostra a noticia.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function noticiaMostrar($id)
    {
        $noticia = Noticia::find($id);
        if (!$noticia) {
            abort(404);
        }
        return view('noticia', compact('noticia'));
    }

    /**
     * Mostra o evento.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function eventoMostrar($id)
    {
        $evento = Evento::find($id);
        return view('evento', compact('evento'));
    }

    /**
     * Mostra o evento.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function artigoMostrar($id)
    {
        $artigo = Artigo::find($id);
        return view('artigo', compact('artigo'));
    }
}
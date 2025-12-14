<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of all articles.
     */
    public function index(Request $request)
    {
        $query = Article::with('user');

        // Si hay búsqueda, filtrar
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $articles = $query->orderBy('date', 'desc')->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Display only the authenticated user's articles.
     */
    public function mine(Request $request)
    {
        $query = Article::where('user_id', Auth::id());

        // Si hay búsqueda, filtrar
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $articles = $query->orderBy('date', 'desc')->get();

        return view('articles.mine', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'date' => 'required|date',
        ]);

        // Asignar el user_id del usuario autenticado o 1 por defecto
        $validated['user_id'] = Auth::id() ?? 1;

        Article::create($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artículo creado correctamente.');
    }

    /**
     * Display the specified article.
     */
    public function show($id)
    {
        $article = Article::with('user')->findOrFail($id);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        // Verificar que el usuario autenticado es el propietario
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.index')
                ->with('error', 'No tienes permiso para editar este artículo.');
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        // Verificar que el usuario autenticado es el propietario
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.index')
                ->with('error', 'No tienes permiso para editar este artículo.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'date' => 'required|date',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artículo actualizado correctamente.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Verificar que el usuario autenticado es el propietario
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.index')
                ->with('error', 'No tienes permiso para eliminar este artículo.');
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artículo eliminado correctamente.');
    }

    /**
     * Método de prueba para consultas Eloquent
     */
    public function test()
    {
        // Prueba de consultas Eloquent básicas
        $results = [];

        // all() - Obtener todos los artículos
        $results['all'] = Article::all();

        // find() - Buscar por ID
        $results['find'] = Article::find(1);

        // where() - Buscar con condiciones
        $results['where'] = Article::where('user_id', 1)->get();

        // first() - Obtener el primero
        $results['first'] = Article::first();

        // count() - Contar registros
        $results['count'] = Article::count();

        return response()->json($results);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use Illuminate\Http\Request;

class OcorrenciaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $ocorrencias = $user->role === 'admin' 
            ? Ocorrencia::with(['reserva', 'user'])->get()
            : Ocorrencia::with(['reserva', 'user'])->where('user_id', $user->id)->get();

        return view('ocorrencia.index', compact('ocorrencias'));
    }

    public function edit($id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('ocorrencias.index')->with('error', 'Você não tem permissão para editar esta ocorrência.');
        }
        
        return view('ocorrencia.edit', compact('ocorrencia'));
    }

    public function update(Request $request, $id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('ocorrencias.index')->with('error', 'Você não tem permissão para atualizar esta ocorrência.');
        }

        $request->validate([
            'status' => 'required|in:pendente,resolvida',
        ]);

        $ocorrencia->update($request->only('status'));

        return redirect()->route('ocorrencias.index')->with('success', 'Ocorrência atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('ocorrencias.index')->with('error', 'Você não tem permissão para deletar esta ocorrência.');
        }

        $ocorrencia->delete();

        return redirect()->route('ocorrencias.index')->with('success', 'Ocorrência removida com sucesso!');
    }
}
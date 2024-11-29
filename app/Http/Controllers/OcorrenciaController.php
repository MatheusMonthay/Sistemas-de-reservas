<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use App\Models\Reserva;
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

    public function create($reservaId)
    {
        $reserva = Reserva::findOrFail($reservaId);
        return view('ocorrencia.create', compact('reserva'));
    }

    public function store(Request $request, $reservaId)
    {
        $request->validate([
            'descricao' => 'required|string|max:1000',
        ]);

        Ocorrencia::create([
            'reserva_id' => $reservaId,
            'user_id' => auth()->id(),
            'descricao' => $request->descricao,
            'status' => 'pendente',
        ]);

        return redirect()->route('ocorrencias.index')->with('success', 'Ocorrência reportada com sucesso!');
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
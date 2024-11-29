<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Ambiente;
use App\Models\Equipamento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    // Exibir todas as reservas
    public function index(Request $request)
{
    $query = Reserva::query();

    if (!$request->hasAny(['inicio_periodo', 'fim_periodo', 'ambiente_id', 'professor', 'minhas_reservas'])) {
        // Filtra apenas reservas a partir de hoje
        $query->where('inicio', '>=', now()->startOfDay());
    }

    // Filtros aplicados pelo usuário
    if ($request->filled('inicio_periodo')) {
        $query->whereDate('inicio', '>=', $request->input('inicio_periodo'));
    }
    if ($request->filled('fim_periodo')) {
        $query->whereDate('fim', '<=', $request->input('fim_periodo'));
    }
    if ($request->filled('ambiente_id')) {
        $query->where('ambiente_id', $request->input('ambiente_id'));
    }
    if ($request->filled('professor')) {
        $query->where('user_id', $request->input('professor'));
    }
    if ($request->filled('minhas_reservas')) {
        $query->where('user_id', auth()->id());
    }

    $reservas = $query->with('ambiente', 'user', 'equipamentos')->get();
    $ambientes = Ambiente::all();
    $usuarios = User::all();

    return view('reserva.index', compact('reservas', 'ambientes', 'usuarios'));
}   
    

    // Exibir o formulário de criação de reserva
    public function create()
    {
        $ambientes = Ambiente::all();
        $equipamentos = Equipamento::all();
        return view('reserva.create', compact('ambientes', 'equipamentos'));
    }

    // Salvar uma nova reserva
    public function store(Request $request)
    {
        $request->validate([
            'ambiente_id' => 'required|exists:ambientes,id',
            'equipamentos' => 'array', // Equipamentos são opcionais
            'equipamentos.*' => 'exists:equipamentos,id',
            'inicio' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $startOfDay = now()->startOfDay();
                    if (strtotime($value) < $startOfDay->timestamp) {
                        $fail('A data de início não pode ser anterior ao início do dia atual.');
                    }
                },
            ],
            'fim' => 'required|date|after:inicio',
            'ocorrencia' => 'nullable|string|max:1000', // Validação da observação
        ]);
        

        // Validação de conflito de reserva
        $conflito = Reserva::where('ambiente_id', $request->ambiente_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('inicio', [$request->inicio, $request->fim])
                      ->orWhereBetween('fim', [$request->inicio, $request->fim])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('inicio', '<=', $request->inicio)
                            ->where('fim', '>=', $request->fim);
                      });
            })->exists();

        if ($conflito) {
            return back()->withErrors(['erro' => 'Já existe uma reserva neste horário.']);
        }

        // Criar a reserva
        $reserva = Reserva::create([
            'user_id' => Auth::id(),
            'ambiente_id' => $request->ambiente_id,
            'inicio' => $request->inicio,
            'fim' => $request->fim,
            'ocorrencia' => $request->ocorrencia, // Salvar a observação
        ]);

        // Associar equipamentos
        if ($request->has('equipamentos')) {
            $reserva->equipamentos()->sync($request->equipamentos);
        }

        return redirect()->route('reservas.index')->with('sucesso', 'Reserva criada com sucesso!');
    }

    // Exibir os detalhes de uma reserva
    public function show($id)
    {
        $reserva = Reserva::with(['user', 'ambiente', 'equipamentos'])->findOrFail($id);
        return view('reserva.show', compact('reserva'));
    }

    // Exibir o formulário para editar uma reserva
    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        $ambientes = Ambiente::all();
        $equipamentos = Equipamento::all();
        return view('reserva.edit', compact('reserva', 'ambientes', 'equipamentos'));
    }

    // Atualizar uma reserva
    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);

        $request->validate([
            'ambiente_id' => 'required|exists:ambientes,id',
            'equipamentos' => 'array', // Equipamentos são opcionais
            'equipamentos.*' => 'exists:equipamentos,id',
            'inicio' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $startOfDay = now()->startOfDay();
                    if (strtotime($value) < $startOfDay->timestamp) {
                        $fail('A data de início não pode ser anterior ao início do dia atual.');
                    }
                },
            ],
            'fim' => 'required|date|after:inicio',
            'ocorrencia' => 'nullable|string|max:1000', // Validação da observação
        ]);

        // Validação de conflito de reserva
        $conflito = Reserva::where('ambiente_id', $request->ambiente_id)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('inicio', [$request->inicio, $request->fim])
                      ->orWhereBetween('fim', [$request->inicio, $request->fim])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('inicio', '<=', $request->inicio)
                            ->where('fim', '>=', $request->fim);
                      });
            })->exists();

        if ($conflito) {
            return back()->withErrors(['erro' => 'Já existe uma reserva neste horário.']);
        }

        // Atualizar a reserva
        $reserva->update([
            'ambiente_id' => $request->ambiente_id,
            'inicio' => $request->inicio,
            'fim' => $request->fim,
            'ocorrencia' => $request->ocorrencia, // Atualizar a observação
        ]);

        // Atualizar equipamentos
        if ($request->has('equipamentos')) {
            $reserva->equipamentos()->sync($request->equipamentos);
        }

        return redirect()->route('reservas.index')->with('sucesso', 'Reserva atualizada com sucesso!');
    }

    // Remover uma reserva
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('reservas.index')->with('sucesso', 'Reserva removida com sucesso!');
    }
}
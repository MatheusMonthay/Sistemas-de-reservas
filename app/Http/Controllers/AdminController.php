<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ambiente;
use App\Models\Equipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $professores = User::where('role', 'professor')->get();
        $ambientes = Ambiente::all();
        $equipamentos = Equipamento::all();
        
        return view('admin.index', compact('professores', 'ambientes', 'equipamentos'));
    }

    // Listar professores
    public function indexProfessores()
    {
        $professores = User::where('role', 'professor')->get();
        return view('admin.professores', compact('professores'));
    }

    // Cadastrar professor
    public function createProfessor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|unique:users,cpf',
            'password' => 'required|min:8', // Senha obrigatória com mínimo de 8 caracteres
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password), // Usando Hash
            'role' => 'professor',
        ]);

        return redirect()->back()->with('success', 'Professor cadastrado com sucesso!');
    }

    // Editar Professor
    public function editProfessor($id)
    {
        $professor = User::findOrFail($id);
        return view('admin.edit-professor', compact('professor'));
    }

    public function updateProfessor(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'cpf' => 'required|unique:users,cpf,' . $id,
        ]);

        $professor = User::findOrFail($id);
        $professor->update($request->only(['name', 'email', 'cpf']));

        return redirect()->route('admin.index')->with('success', 'Professor atualizado com sucesso!');
    }

    // Excluir Professor
    public function deleteProfessor($id)
    {
        $professor = User::findOrFail($id);
        $professor->delete();

        return redirect()->route('admin.index')->with('success', 'Professor excluído com sucesso!');
    }

    // Listar ambientes
    public function indexAmbientes()
    {
        $ambientes = Ambiente::all();
        return view('admin.ambientes', compact('ambientes'));
    }

    // Cadastrar ambiente
    public function createAmbiente(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
        ]);

        Ambiente::create($request->only(['nome', 'descricao']));

        return redirect()->back()->with('success', 'Ambiente cadastrado com sucesso!');
    }

    // Editar Ambiente
    public function editAmbiente($id)
    {
        $ambiente = Ambiente::findOrFail($id);
        return view('admin.edit-ambiente', compact('ambiente'));
    }

    public function updateAmbiente(Request $request, $id)
    {
        $request->validate(['nome' => 'required']);
        $ambiente = Ambiente::findOrFail($id);
        $ambiente->update($request->only(['nome', 'descricao']));

        return redirect()->route('admin.index')->with('success', 'Ambiente atualizado com sucesso!');
    }
    // Excluir Ambiente
    public function deleteAmbiente($id)
    {
        $ambiente = Ambiente::findOrFail($id);
        $ambiente->delete();

        return redirect()->route('admin.index')->with('success', 'Ambiente excluído com sucesso!');
    }

    // Listar equipamentos
    public function indexEquipamentos()
    {
        $equipamentos = Equipamento::all();
        return view('admin.equipamentos', compact('equipamentos'));
    }

    // Cadastrar equipamento
    public function createEquipamento(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
            'quantidade' => 'required|integer|min:1', // Quantidade mínima de 1
        ]);

        Equipamento::create($request->only(['nome', 'descricao', 'quantidade']));

        return redirect()->back()->with('success', 'Equipamento cadastrado com sucesso!');
    }
    // Editar Equipamento
    public function editEquipamento($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('admin.edit-equipamento', compact('equipamento'));
    }

    public function updateEquipamento(Request $request, $id)
    {
        $request->validate(['nome' => 'required', 'quantidade' => 'required|integer|min:1']);
        $equipamento = Equipamento::findOrFail($id);
        $equipamento->update($request->only(['nome', 'descricao', 'quantidade']));

        return redirect()->route('admin.index')->with('success', 'Equipamento atualizado com sucesso!');
    }
    // Excluir Equipamento
    public function deleteEquipamento($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        $equipamento->delete();

        return redirect()->route('admin.index')->with('success', 'Equipamento excluído com sucesso!');
    }
}
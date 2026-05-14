<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Exibe o relatório na tela com filtros aplicados.
     */
    public function report(Request $request)
    {
        $products = DB::table('products')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->select(
                'products.*',
                'types.name as type_name'
            )
            ->when($request->name, fn ($query, $name) => $query->where('products.name', 'like', "%{$name}%"))
            ->when($request->type_id, fn ($query, $typeId) => $query->where('products.type_id', $typeId))
            ->when($request->min_quantity, fn ($query, $quantity) => $query->where('products.quantity', '>=', $quantity))
            ->when($request->max_quantity, fn ($query, $quantity) => $query->where('products.quantity', '<=', $quantity))
            ->orderBy('products.name')
            ->get();

        return view('products.report', [
            'products' => $products,
            'types' => Type::orderBy('name')->get()
        ]);
    }

    /**
     * Gera o PDF do relatório seguindo o padrão do professor.
     */
    public function reportPdf(Request $request)
    {
        $products = DB::table('products')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->select(
                'products.id',
                'products.name',
                'products.description',
                'products.quantity',
                'products.price',
                'products.image',
                'products.type_id',
                'types.name as type_name',
                'products.created_at',
                'products.updated_at'
            )
            ->when($request->name, fn ($query, $name) => $query->where('products.name', 'like', "%{$name}%"))
            ->when($request->type_id, fn ($query, $typeId) => $query->where('products.type_id', $typeId))
            ->when($request->min_quantity, fn ($query, $quantity) => $query->where('products.quantity', '>=', $quantity))
            ->when($request->max_quantity, fn ($query, $quantity) => $query->where('products.quantity', '<=', $quantity))
            ->orderBy('products.name')
            ->get();

        return Pdf::loadView('products.report-pdf', compact('products'))
            ->download('relatorio-produtos.pdf');
    }

    public function index()
    {
        return view('products.index', [
            'products' => Product::with('type')->get()
        ]);
    }

    public function create()
    {
        return view('products.create', ['types' => Type::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'quantity' => 'required|gt:0',
            'price' => 'required|gt:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('products', 'public') 
            : null;

        try {
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'image' => $imagePath,
                'type_id' => $request->type_id
            ]);
            return redirect('/products')->with('success', 'DVD cadastrado com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao salvar produto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao salvar no banco.')->withInput();
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product, 
            'types' => Type::all()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'quantity' => 'required|gt:0',
            'price' => 'required|gt:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product = Product::findOrFail($request->id);
        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $imagePath,
            'type_id' => $request->type_id
        ]);

        return redirect('/products')->with('success', 'Dados do DVD atualizados!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/products')->with('success', 'DVD removido do catálogo!');
    }
}
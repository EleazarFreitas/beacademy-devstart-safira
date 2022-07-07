<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductFormRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
 {

  public function __construct(Product $product)
  {
    $this->model = $product;
  }

  public function add()
  {
    return view('product.add-product');
  }
  

  public function index()
  {
    $products = Product::all();

    return view('product.index', compact('products'));
  }

  public function idGet($id)
  {
    if (!$products = Product::find($id))
     {
      return redirect()->route('produtos.index');

     }

    $title = 'Produto ' . $products->name;

    return view('product.show', compact('products', 'title'));
  }

  public function store(CreateProductFormRequest $request)
  {
  
    $data = $request->all();

    $data['password'] = bcrypt($request->password);

    if ($request->photo)
     {
      $data['photo'] = $request->photo->store('profile','public');
    }
    
    $this->model->create($data);
    return redirect()->route('produtos.index');
  }

  public function edit($id)
  {
    if(!$products = Product::find($id)) 
    {
      return redirect()->route('users.index');
    }

    $title = 'Editar produto ' . $products->name;
    return view('product.edit', compact('products', 'title'));
  }

  public function update(CreateProductFormRequest $request, $id)
  {

    if (!$product = Product::find($id)) 
    {
      return redirect()->route('produtos.index');
    };


    $data = $request->all();

    if ($request->password) 
    {
      $data['password'] = bcrypt($request->password);
    };


    if ($request->photo) 
      {
          if ($product->photo && Storage::exists($product->photo)) 
          {
              Storage::delete($product->photo);
          }

      $data['photo'] = $request->photo->store('profile','public');
  }

    $product->update($data);

    return redirect()->route('produtos.index');
  }

  public function destroy($id)
  {
    if (!$products = $this->model->find($id))
      return redirect()->route('produtos.index');

      $products->delete();

    return redirect()->route('produtos.index');
  }

  public function list()
  {

    return view('product.list', compact('products'));
  }
}
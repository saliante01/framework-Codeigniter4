tiendacontroller.php
<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class TiendaController extends BaseController
{
    public function index()
    {
        $modelo = new ProductoModel();
        $data['productos'] = $modelo->findAll();
        $data['carrito'] = session()->get('carrito') ?? [];

        return view('tienda', $data);
    }

    public function agregarACarritoAjax()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('/tienda');
        }

        $id = $this->request->getPost('id');
        $modelo = new ProductoModel();
        $producto = $modelo->find($id);

        if (!$producto) {
            return $this->response->setJSON(['error' => 'Producto no encontrado']);
        }

        $carrito = session()->get('carrito') ?? [];
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }

        session()->set('carrito', $carrito);
        return $this->response->setJSON(['success' => 'Producto añadido al carrito', 'carrito' => $carrito]);
    }
}
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: ProductController
 * 
 * Automatically generated via CLI.
 */
class ProductController extends Controller {
    public function __construct()
    {
        parent::__construct();

         if (!isset($_SESSION['user_id'])) {
            redirect('/login');
            return;
        }

         $this->call->model('ProductModel');
         
    }
     // READ
    public function index()
    {
        
        $products = $this->ProductModel->all();

        $data['products'] = $products;

        $this->call->view('products/index', $data);
    }

    // CREATE
    public function store()
    {
        
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];

        $this->ProductModel->insert($data);

        $_SESSION['success_message'] = 'Successfully added product: ' . $data['product_name'];
        redirect('products');
    }

    // UPDATE
    public function update($id)
    {
      
        $product_name = $this->io->post('product_name');
        $data = [
            'product_name' => $product_name,
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];

        $this->ProductModel->update($id, $data);

        $_SESSION['success_message'] = 'Successfully updated product: ' . $product_name;
        redirect('products');
    }

    // DELETE
    public function delete($id)
    {
        $this->ProductModel->delete($id);

        $_SESSION['success_message'] = 'Successfully deleted product from inventory.';
        redirect('products');
    }
}
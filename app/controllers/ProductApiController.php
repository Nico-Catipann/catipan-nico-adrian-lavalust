<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('api');
        $this->call->model('ProductModel');
    }


    // =========================================
    // GET ALL PRODUCTS
    // GET /api/products
    // =========================================

    public function index()
    {
        $this->api->require_method('GET');

        $this->api->require_jwt();

        $products = $this->ProductModel->all();

        $this->api->respond([
            'products' => $products
        ]);
    }


    // =========================================
    // ADD PRODUCT
    // POST /api/products
    // =========================================

    public function store()
    {
        $this->api->require_method('POST');

        $this->api->require_jwt();

        $input = $this->api->body();

        $productName = $input['product_name'] ?? '';
        $description = $input['description'] ?? '';
        $price = $input['price'] ?? null;
        $quantity = $input['quantity'] ?? null;


        // -------------------------------------
        // VALIDATION
        // -------------------------------------

        if ($productName === '') {
            $this->api->respond_error(
                'Product name is required.',
                422
            );
        }

        if (!is_numeric($price) || $price < 0) {
            $this->api->respond_error(
                'Price must be a valid non-negative number.',
                422
            );
        }

        if (
            !is_numeric($quantity) ||
            (int)$quantity < 0
        ) {
            $this->api->respond_error(
                'Quantity must be a valid non-negative number.',
                422
            );
        }


        // -------------------------------------
        // IMAGE UPLOAD
        // -------------------------------------

        $imagePath = null;

        if (
            isset($_FILES['product_image']) &&
            $_FILES['product_image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            $imagePath = $this->saveProductImage(
                $_FILES['product_image']
            );
        }


        // -------------------------------------
        // SAVE PRODUCT
        // -------------------------------------

        $data = [
            'product_name' => $productName,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => (int)$quantity,
            'product_image'=> $imagePath
        ];

        $id = $this->ProductModel->insert($data);


        $this->api->respond([
            'message' => 'Product added successfully.',
            'product' => $this->ProductModel->find($id)
        ], 201);
    }


    // =========================================
    // UPDATE PRODUCT INFORMATION
    // PUT /api/products/{id}
    // =========================================

    public function update($id)
    {
        $this->api->require_method('PUT');

        $this->api->require_jwt();

        $product = $this->ProductModel->find($id);


        if (!$product) {
            $this->api->respond_error(
                'Product not found.',
                404
            );
        }


        $input = $this->api->body();


        $productName =
            $input['product_name']
            ?? $product['product_name'];

        $description =
            $input['description']
            ?? $product['description'];

        $price =
            $input['price']
            ?? $product['price'];

        $quantity =
            $input['quantity']
            ?? $product['quantity'];


        // -------------------------------------
        // VALIDATION
        // -------------------------------------

        if ($productName === '') {
            $this->api->respond_error(
                'Product name is required.',
                422
            );
        }

        if (!is_numeric($price) || $price < 0) {
            $this->api->respond_error(
                'Price must be a valid non-negative number.',
                422
            );
        }

        if (
            !is_numeric($quantity) ||
            (int)$quantity < 0
        ) {
            $this->api->respond_error(
                'Quantity must be a valid non-negative number.',
                422
            );
        }


        $data = [
            'product_name' => $productName,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => (int)$quantity
        ];


        $this->ProductModel->update(
            $id,
            $data
        );


        $this->api->respond([
            'message' => 'Product updated successfully.',
            'product' => $this->ProductModel->find($id)
        ]);
    }


    // =========================================
    // UPLOAD / REPLACE PRODUCT IMAGE
    // POST /api/products/{id}/image
    // =========================================

    public function uploadImage($id)
    {
        $this->api->require_method('POST');

        $this->api->require_jwt();


        $product = $this->ProductModel->find($id);


        if (!$product) {
            $this->api->respond_error(
                'Product not found.',
                404
            );
        }


        if (
            !isset($_FILES['product_image']) ||
            $_FILES['product_image']['error'] === UPLOAD_ERR_NO_FILE
        ) {
            $this->api->respond_error(
                'Please select an image.',
                422
            );
        }


        // Save the new image
        $newImagePath = $this->saveProductImage(
            $_FILES['product_image']
        );


        // Keep old image path before updating
        $oldImagePath =
            $product['product_image'] ?? null;


        $updated = $this->ProductModel->update(
            $id,
            [
                'product_image' => $newImagePath
            ]
        );


        if (!$updated) {

            // Remove newly uploaded image
            $this->deleteProductImage(
                $newImagePath
            );

            $this->api->respond_error(
                'Unable to update product image.',
                500
            );
        }


        // Delete old image only after
        // database update succeeds
        if ($oldImagePath) {
            $this->deleteProductImage(
                $oldImagePath
            );
        }


        $this->api->respond([
            'message' =>
                'Product image updated successfully.',

            'product' =>
                $this->ProductModel->find($id)
        ]);
    }


    // =========================================
    // DELETE PRODUCT
    // DELETE /api/products/{id}
    // =========================================

    public function delete($id)
    {
        $this->api->require_method('DELETE');

        $this->api->require_jwt();


        $product =
            $this->ProductModel->find($id);


        if (!$product) {
            $this->api->respond_error(
                'Product not found.',
                404
            );
        }


        $imagePath =
            $product['product_image'] ?? null;


        $deleted =
            $this->ProductModel->delete($id);


        if (!$deleted) {
            $this->api->respond_error(
                'Unable to delete product.',
                500
            );
        }


        // Delete image from server
        if ($imagePath) {
            $this->deleteProductImage(
                $imagePath
            );
        }


        $this->api->respond([
            'message' =>
                'Product deleted successfully.'
        ]);
    }


    // =========================================
    // SAVE PRODUCT IMAGE
    // =========================================

    private function saveProductImage($file)
    {
        // -------------------------------------
        // CHECK UPLOAD ERROR
        // -------------------------------------

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->api->respond_error(
                'Image upload failed.',
                422
            );
        }


        // -------------------------------------
        // MAX SIZE: 5 MB
        // -------------------------------------

        $maxSize = 5 * 1024 * 1024;

        if ($file['size'] > $maxSize) {
            $this->api->respond_error(
                'Image must not exceed 5 MB.',
                422
            );
        }


        // -------------------------------------
        // VALIDATE MIME TYPE
        // -------------------------------------

        $finfo = new finfo(
            FILEINFO_MIME_TYPE
        );

        $mimeType = $finfo->file(
            $file['tmp_name']
        );


        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];


        if (!isset($allowedTypes[$mimeType])) {
            $this->api->respond_error(
                'Only JPG, PNG, and WebP images are allowed.',
                422
            );
        }


        $extension =
            $allowedTypes[$mimeType];


        // -------------------------------------
        // CREATE UPLOAD DIRECTORY
        // -------------------------------------

        $uploadDirectory =
            ROOT_DIR .
            'public' .
            DIRECTORY_SEPARATOR .
            'uploads' .
            DIRECTORY_SEPARATOR .
            'products' .
            DIRECTORY_SEPARATOR;


        if (!is_dir($uploadDirectory)) {

            mkdir(
                $uploadDirectory,
                0775,
                true
            );
        }


        // -------------------------------------
        // UNIQUE FILE NAME
        // -------------------------------------

        $filename =
            'product_' .
            time() .
            '_' .
            bin2hex(random_bytes(4)) .
            '.' .
            $extension;


        $destination =
            $uploadDirectory .
            $filename;


        // -------------------------------------
        // MOVE FILE
        // -------------------------------------

        if (
            !move_uploaded_file(
                $file['tmp_name'],
                $destination
            )
        ) {
            $this->api->respond_error(
                'Unable to save product image.',
                500
            );
        }


        // Store relative path in database
        return
            'uploads/products/' .
            $filename;
    }


    // =========================================
    // DELETE PRODUCT IMAGE
    // =========================================

    private function deleteProductImage(
        $imagePath
    ) {

        if (!$imagePath) {
            return;
        }


        $fullPath =
            ROOT_DIR .
            'public' .
            DIRECTORY_SEPARATOR .
            str_replace(
                '/',
                DIRECTORY_SEPARATOR,
                $imagePath
            );


        if (
            file_exists($fullPath) &&
            is_file($fullPath)
        ) {
            unlink($fullPath);
        }
    }
}
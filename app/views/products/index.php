<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #090d16;
            background-image: 
                radial-gradient(at 10% 20%, rgba(37, 99, 235, 0.12) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(147, 51, 234, 0.12) 0px, transparent 50%);
            color: #f8fafc;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 20px;
        }

        .header-title h1 {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.025em;
        }

        .header-title p {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            opacity: 0.95;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
            transform: translateY(-1px);
        }

        .btn-warning {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            background: rgba(245, 158, 11, 0.25);
        }

        .btn-danger {
            background: rgba(220, 38, 38, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(220, 38, 38, 0.3);
        }

        .btn-danger:hover {
            background: rgba(220, 38, 38, 0.25);
        }

        .btn-secondary {
            background: rgba(100, 116, 139, 0.2);
            color: #cbd5e1;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .btn-secondary:hover {
            background: rgba(100, 116, 139, 0.3);
            color: #ffffff;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: left;
        }

        th, td {
            padding: 14px 16px;
            font-size: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        th {
            background: rgba(30, 41, 59, 0.6);
            color: #cbd5e1;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tr:hover td {
            background: rgba(30, 41, 59, 0.3);
        }

        td {
            color: #e2e8f0;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #64748b;
            font-style: italic;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        /* MODAL STYLING */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content {
            background: #0f172a;
            width: 100%;
            max-width: 440px;
            padding: 30px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        .modal-content.text-left {
            text-align: left;
        }

        .success-icon {
            width: 50px;
            height: 50px;
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 16px auto;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .modal-content h2 {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 12px;
        }

        .modal-content p {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .modal-content p strong {
            color: #ffffff;
        }

        .close {
            position: absolute;
            right: 24px;
            top: 24px;
            font-size: 22px;
            color: #64748b;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close:hover {
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: #cbd5e1;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #ffffff;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #64748b;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            background: rgba(30, 41, 59, 0.9);
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }

        .modal-buttons.centered {
            justify-content: center;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="dashboard-header">
        <div class="header-title">
            <h1>Product Management</h1>
            <p>Manage your inventory catalog and records</p>
        </div>
        <div class="header-actions">
            <button type="button" class="btn btn-primary" onclick="openAddModal()">
                + Add Product
            </button>
            <a href="<?= site_url('logout') ?>" class="btn btn-danger">
                Logout
            </a>
        </div>
    </div>

    <!-- PRODUCT TABLE -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id']) ?></td>
                        <td><strong><?= htmlspecialchars($product['product_name']) ?></strong></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td>₱<?= number_format($product['price'], 2) ?></td>
                        <td><?= htmlspecialchars($product['quantity']) ?></td>
                        <td><?= htmlspecialchars($product['created_at']) ?></td>
                        <td>
                            <div class="actions">
                                <!-- EDIT -->
                                <button type="button" class="btn btn-warning" onclick='openEditModal(<?= json_encode($product) ?>)'>
                                    Edit
                                </button>
                                <!-- DELETE -->
                                <button type="button" class="btn btn-danger" onclick="openDeleteModal(<?= $product['id'] ?>, '<?= htmlspecialchars($product['product_name'], ENT_QUOTES) ?>')">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="empty-state">
                        No products found in the inventory database.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>


<!-- ================================================= -->
<!-- SUCCESS POPUP MODAL (Auto-triggers on actions) -->
<!-- ================================================= -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeSuccessModal()">&times;</span>
        <div class="success-icon">✓</div>
        <h2>Success!</h2>
        <p id="successMessage">
            <?php if (isset($_SESSION['success_message'])): ?>
                <?= htmlspecialchars($_SESSION['success_message']) ?>
            <?php endif; ?>
        </p>
        <div class="modal-buttons centered">
            <button type="button" class="btn btn-primary" onclick="closeSuccessModal()" style="width: 100%;">Okay</button>
        </div>
    </div>
</div>
<?php if (isset($_SESSION['success_message'])) { unset($_SESSION['success_message']); } ?>


<!-- ================================================= -->
<!-- ADD PRODUCT MODAL -->
<!-- ================================================= -->
<div id="addModal" class="modal">
    <div class="modal-content text-left">
        <span class="close" onclick="closeAddModal()">&times;</span>
        <h2>Add New Product</h2>
        <form action="<?= site_url('products/store') ?>" method="POST">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name" placeholder="Enter product name" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Enter product details..." required></textarea>
            </div>
            <div class="form-group">
                <label>Price (₱)</label>
                <input type="number" name="price" step="0.01" min="0" placeholder="0.00" required>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" min="0" placeholder="0" required>
            </div>
            <div class="modal-buttons">
                <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
        </form>
    </div>
</div>


<!-- ================================================= -->
<!-- EDIT PRODUCT MODAL -->
<!-- ================================================= -->
<div id="editModal" class="modal">
    <div class="modal-content text-left">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Product</h2>
        <form id="editForm" method="POST">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" id="edit_product_name" name="product_name" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="edit_description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label>Price (₱)</label>
                <input type="number" id="edit_price" name="price" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" id="edit_quantity" name="quantity" min="0" required>
            </div>
            <div class="modal-buttons">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn btn-warning">Update Product</button>
            </div>
        </form>
    </div>
</div>


<!-- ================================================= -->
<!-- DELETE MODAL -->
<!-- ================================================= -->
<div id="deleteModal" class="modal">
    <div class="modal-content text-left">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to permanently delete <strong id="deleteProductName"></strong> from the inventory system?</p>
        <form id="deleteForm" method="POST">
            <div class="modal-buttons">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </form>
    </div>
</div>


<!-- ================================================= -->
<!-- JAVASCRIPT -->
<!-- ================================================= -->
<script>
    // Auto-show success modal on page load if session message exists
    window.addEventListener('DOMContentLoaded', (event) => {
        const successMsg = document.getElementById('successMessage').textContent.trim();
        if (successMsg !== "") {
            document.getElementById('successModal').style.display = 'flex';
        }
    });

    function closeSuccessModal() {
        document.getElementById('successModal').style.display = 'none';
    }

    function openAddModal() {
        document.getElementById('addModal').style.display = 'flex';
    }

    function closeAddModal() {
        document.getElementById('addModal').style.display = 'none';
    }

    function openEditModal(product) {
        document.getElementById('edit_product_name').value = product.product_name;
        document.getElementById('edit_description').value = product.description;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_quantity').value = product.quantity;
        document.getElementById('editForm').action = '<?= site_url('products/update') ?>/' + product.id;
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function openDeleteModal(id, productName) {
        document.getElementById('deleteProductName').textContent = productName;
        document.getElementById('deleteForm').action = '<?= site_url('products/delete') ?>/' + id;
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target === document.getElementById('addModal')) {
            closeAddModal();
        }
        if (event.target === document.getElementById('editModal')) {
            closeEditModal();
        }
        if (event.target === document.getElementById('deleteModal')) {
            closeDeleteModal();
        }
        if (event.target === document.getElementById('successModal')) {
            closeSuccessModal();
        }
    }
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #f1f5f9;
            --text-main: #334155;
            --text-muted: #64748b;
            --accent-color: #4f46e5;
            --row-bg: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-color);
            color: var(--text-main);
            padding: 40px 20px;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1100px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            color: #1e293b;
            letter-spacing: -0.02em;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px; /* Creates the floating row effect */
            text-align: left;
        }

        th, td {
            padding: 16px 20px;
        }

        /* Header Styling */
        th {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: none;
        }

        /* Row Styling */
        tbody tr {
            background-color: var(--row-bg);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
        }

        /* Rounded corners for the "floating cards" */
        tbody td:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        
        tbody td:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        /* Data Cell Styling */
        td {
            font-size: 0.95rem;
            border-top: 1px solid transparent;
            border-bottom: 1px solid transparent;
        }

        /* Special styling for the ID column */
        .id-badge {
            background: #e2e8f0;
            color: #475569;
            font-weight: 700;
            font-size: 0.8rem;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .email-text {
            color: var(--text-muted);
        }

        .username-badge {
            background: #e0e7ff;
            color: var(--accent-color);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header-section">
        <h1>User Management</h1>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <span class="id-badge"><?= htmlspecialchars($user['id']) ?></span>
                        </td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($user['firstname']) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($user['lastname']) ?></td>
                        <td class="email-text"><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <span class="username-badge">@<?= htmlspecialchars($user['username']) ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
<x-app-layout>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Gestion des Clients</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 20px;
            }
            h1 {
                margin-top: 20px;
            }
            h1, h2 {
                color: #333;
            }
            .form-container {
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-top: 20px;
                margin-bottom: 20px;
                display: inline-block;
                width: 100%;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-group label {
                display: inline-block;
                width: 150px;
                font-weight: bold;
            }
            .form-group input {
                width: calc(100% - 160px);
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .form-group button {
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                background-color: #28a745;
                color: white;
                cursor: pointer;
            }
            .form-group button:hover {
                background-color: #218838;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid #ddd;
            }
            th, td {
                padding: 12px;
                text-align: left;
            }
            th {
                background-color: #28a745;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #ddd;
            }
            .action-buttons {
                display: flex;
                gap: 10px;
            }
            .action-buttons button, .action-buttons a {
                padding: 5px 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .action-buttons button {
                background-color: #dc3545;
                color: white;
            }
            .action-buttons button:hover {
                background-color: #c82333;
            }
            .action-buttons a {
                background-color: #007bff;
                color: white;
                text-decoration: none;
            }
            .action-buttons a:hover {
                background-color: #0056b3;
            }
            th.name, td.name {
                width: 30%;
            }
            th.contact, td.contact {
                width: 35%;
            }
        </style>
    </head>
    <body>
        <h1>Ajouter un nouveau client</h1>
    
        <!-- Formulaire pour ajouter un nouveau client -->
        <div class="form-container">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nom du client</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input type="text" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    
        <!-- Liste des clients -->
        <h2>Liste des Clients</h2>
        <table>
            <tr>
                <th class="name">Nom</th>
                <th class="contact">Téléphone</th>
                <th class="contact">Email</th>
                <th>Actions</th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td class="name">{{ $client->name }}</td>
                    <td class="contact">{{ $client->phone }}</td>
                    <td class="contact">{{ $client->email }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('clients.edit', $client->id) }}">Modifier</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </body>
    </html>
    </x-app-layout>
    
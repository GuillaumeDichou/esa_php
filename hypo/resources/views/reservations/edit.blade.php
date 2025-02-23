<x-app-layout>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Modifier une Réservation</title>
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
            .form-group input, .form-group select {
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
            .checkbox-container {
                display: flex;
                align-items: center;
                margin-bottom: 5px;
            }
            .checkbox-container input[type="checkbox"] {
                width: 15px;
                height: 15px;
                margin-right: 5px;
                cursor: pointer;
            }
            .checkbox-container label {
                font-size: 14px;
            }
            .form-group input[type="number"],
            .form-group input[type="time"] {
                width: 100px;
            }
            .form-group select {
                width: 200px;
            }
        </style>
    </head>
    <body>
        <h1>Modifier une Réservation</h1>
    
        <!-- Formulaire pour modifier une réservation -->
        <div class="form-container">
            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="client_id">Nom du client</label>
                    <select id="client_id" name="client_id" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $reservation->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="number_of_people">Nombre de personnes</label>
                    <input type="number" id="number_of_people" name="number_of_people" value="{{ $reservation->number_of_people }}" required min="1" max="8" style="width: 100px;">
                </div>
                <div class="form-group">
                    <label for="start_time">Heure de début</label>
                    <input type="time" id="start_time" name="start_time" value="{{ $reservation->start_time }}" required style="width: 100px;">
                </div>
                <div class="form-group">
                    <label for="end_time">Heure de fin</label>
                    <input type="time" id="end_time" name="end_time" value="{{ $reservation->end_time }}" required style="width: 100px;">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="{{ $reservation->date }}" required>
                </div>
                <div class="form-group">
                    <label for="total_price">Prix total</label>
                    <input type="number" step="0.01" id="total_price" name="total_price" value="{{ $reservation->total_price }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Statut</label>
                    <select id="status" name="status" required>
                        <option value="confirmé" {{ $reservation->status == 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                        <option value="annulé" {{ $reservation->status == 'annulé' ? 'selected' : '' }}>Annulé</option>
                    </select>
                </div>
    
                <!-- Cases à cocher pour les poneys -->
                <div class="form-group">
                    <label>Poneys disponibles</label>
                    @foreach($horses as $horse)
                        @if($horse->status === 'disponible')
                            <div class="checkbox-container">
                                <input type="checkbox" id="horse_{{ $horse->id }}" name="horses[]" value="{{ $horse->id }}"
                                    {{ $reservation->horses->contains($horse->id) ? 'checked' : '' }}>
                                <label for="horse_{{ $horse->id }}">{{ $horse->name }}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
    
                <div class="form-group">
                    <button type="submit">Mettre à jour</button>
                </div>
            </form>
        </div>
    </body>
    </html>
    </x-app-layout>
    
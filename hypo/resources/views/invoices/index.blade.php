<x-app-layout>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Facture</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 20px;
            }
            .invoice-container {
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 800px;
                margin: auto;
                margin-top: 10px;
            }
            .invoice-header {
                text-align: center;
                margin-bottom: 20px;
            }
            .invoice-body {
                margin-bottom: 20px;
            }
            .invoice-item {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .invoice-item div {
                width: 50%;
            }
            .invoice-item label {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        @foreach($invoices as $invoice)
            <div class="invoice-container">
                <div class="invoice-header">
                    <h1>Facture</h1>
                    <p>Numéro de facture: {{ $invoice->id }}</p>
                    <p>Date: {{ $invoice->date }}</p>
                </div>
                <div class="invoice-body">
                    <div class="invoice-item">
                        <div>
                            <label>Client:</label>
                            <p>{{ $invoice->client->name }}</p>
                        </div>
                        <div>
                            <label>Date de réservation:</label>
                            <p>{{ $invoice->reservation->date }}</p>
                        </div>
                    </div>
                    <div class="invoice-item">
                        <div>
                            <label>Heure de début:</label>
                            <p>{{ $invoice->reservation->start_time }}</p>
                        </div>
                        <div>
                            <label>Heure de fin:</label>
                            <p>{{ $invoice->reservation->end_time }}</p>
                        </div>
                    </div>
                    <div class="invoice-item">
                        <div>
                            <label>Nombre de personnes:</label>
                            <p>{{ $invoice->reservation->number_of_people }}</p>
                        </div>
                        <div>
                            <label>Poneys utilisés:</label>
                            <p>
                                @foreach($invoice->reservation->horses as $horse)
                                    {{ $horse->name }}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="invoice-item">
                        <div>
                            <label>Prix total:</label>
                            <p>{{ $invoice->reservation->total_price }} €</p>
                        </div>
                        <div>
                            <label>Statut:</label>
                            <p>{{ $invoice->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </body>
    </html>
    </x-app-layout>
    
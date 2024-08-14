<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .ticket-container {
            padding: 20px;
            border: 1px solid #000;
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }
        .ticket-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <h2>Ticket ID: {{ $ticket['ticket_id'] }}</h2>
        <div class="ticket-item">Key: {{ $ticket['ticket_key'] }}</div>
        <div class="ticket-item">Email: {{ $ticket['ticket_email'] }}</div>
        <div class="ticket-item">Phone: {{ $ticket['ticket_phone'] }}</div>
        <div class="ticket-item">Quantity: {{ $ticket['ticket_quantity'] }}</div>
        <div class="ticket-item">Order ID: {{ $ticket['ticket_order_id'] }}</div>
        <div class="ticket-item">Ticket Type ID: {{ $ticket['ticket_ticket_type_id'] }}</div>
        <div class="ticket-item">Status: {{ $ticket['ticket_status'] }}</div>
    </div>
</body>
</html>

<div style="background-color: #F1EEDF; border-radius: 15px;">
    <div style="padding: 20px 20px 20px 20px;">
        <h1 style="text-size: 30px; color: #F48142; text-align: center;">You're in, {{ $user->first_name }}!</h1>
        <hr>
        <h2>Your order number is: {{ $order->order_number }}</h2>

        <p>Order Total: €{{ number_format($order->amount_paid_cents / 100, 2) }}</p>
        <p>Number Of Entries: {{ $order->  }}</p>
        <p>Best of luck in Champ or Chimp 2024!</p>

        <p>If you have any queries regarding your entry, please email us at info@champorchimp.com</p>

        <p>Kind regards,</p>
        <p>Champ or Chimp Team</p>
    </div>
</div>
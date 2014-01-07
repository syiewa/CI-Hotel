Hallo <strong><?php echo $this->session->userdata('email'); ?></strong>,<br/>
Below is reservation on Hotel Adem :<br/>
<table>
    <tr >
        <td >Code</td><td><?php echo $order->order_id; ?></td>
    </tr>
    <tr>
        <td>Date</td><td><?php echo $order->tgl_order; ?></td>
    </tr>
    <tr>
        <td>Total</td><td><?php echo getOptions('currency'). ' '. $this->cart->format_number($order->payment_total); ?></td>
    </tr>
    <tr>
        <td>Method</td><td><?php echo $paymentMethods[$order->payment_id]; ?></td>
    </tr>
    <tr>
        <td>Status</td><td><?php echo $status[$order->order_status]; ?></td>
    </tr>
</table>
<h3>Detail Items</h3>
<table class="cart_table">
    <tr class="cart_title">

        <td>Kamar</td>
        <td>Tgl Check In</td>
        <td>Tgl Check Out</td>
        <td>Total Bayar</td>

    </tr>
        <tr>

            <td><?php echo $kelas->title; ?></td>
            <td><?php echo $order->check_in; ?></td>
            <td><?php echo $order->check_out; ?></td>
            <td style="text-align:right"><?php echo getOptions('currency'). ' '.$this->cart->format_number($order->payment_total); ?></td>

        </tr>                

</table>
<br/>
Please transfer to our bank account, and confirm it soon. Thanks for shopping.

<br/>
<br/>
Regard,
<br/><br/><br/>


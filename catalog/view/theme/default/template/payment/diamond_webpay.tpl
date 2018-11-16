
<form method="POST" id="upay_form" name="upay_form" action="https://cipg.diamondbank.com/cipg/MerchantServices/MakePayment.aspx" target="_top">
    <input type="hidden" name="mercId" value="<?php echo $merchant_id; ?>"> 
    <input type="hidden" name="currCode" value="566"> 
    <input type="hidden" name="amt" value="<?php echo $order_amount; ?>"> 
    <input type="hidden" name="orderId" value="<?php echo $order_id; ?>"> 
    <input type="hidden" name="prod" value="Online Payment"> 
    <input type="hidden" name="email" value="<?php echo $order_email; ?>"> 
    <div class="right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary btn-lg" />
    </div>
</form>
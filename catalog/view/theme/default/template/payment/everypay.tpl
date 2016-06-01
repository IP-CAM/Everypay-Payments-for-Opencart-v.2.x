<form action="<?php echo $action === 1 ? 'https://pay.every-pay.eu/transactions/' : 'https://igw-demo.every-pay.com/transactions/' ; ?>" method="post">

    <?php foreach($form_data as $key => $value) { ?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
    <?php } ?>



    <input class="btn btn­-primary pull-right" type="submit" value="Proceed to Payment">
    <img src="catalog/view/theme/default/image/visa-mastercard.jpg" width="130" class="pull-right" style="margin-right: 15px;" />

</form>

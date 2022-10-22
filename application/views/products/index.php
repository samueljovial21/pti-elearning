<!-- List all products -->
<?php if(!empty($products)){ foreach($products as $row){ ?>
    <div class="card">
        <img src="<?php echo base_url('assets/images/'.$row['image']); ?>" />
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <h6>$<?php echo $row['price'].' '.$row['currency']; ?></h6>
            <a href="<?php echo base_url('products/buy/'.$row['id']); ?>" class="btn"><img src="<?php echo base_url('assets/images/paypal-btn.png'); ?>" /></a>
        </div>
    </div>
<?php } }else{ ?>
    <p>Product(s) not found...</p>
<?php } ?>	
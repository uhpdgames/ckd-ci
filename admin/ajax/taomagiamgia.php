<?php
include "ajax_config.php";

require_once LIBRARIES."class/class.EGiftVoucherSystem.php";


$soluong = 1;

for($i = 0; $i < $soluong ; $i++){

}


// Usage demonstration of the EGiftVoucherSystem class

// Create a new e-gift voucher system
$voucherSystem = new EGiftVoucherSystem();

// Generate a new e-gift voucher
$voucher1 = $voucherSystem->generateVoucher("John Doe", 50.00);
echo "Generated e-gift voucher with ID: {$voucher1->getVoucherId()}, recipient: {$voucher1->getRecipientName()}, amount: {$voucher1->getAmount()}.\n";

// Generate another e-gift voucher
$voucher2 = $voucherSystem->generateVoucher("Jane Smith", 100.00);
echo "Generated e-gift voucher with ID: {$voucher2->getVoucherId()}, recipient: {$voucher2->getRecipientName()}, amount: {$voucher2->getAmount()}.\n";

// Get all the e-gift vouchers in the system
$vouchers = $voucherSystem->getAllVouchers();
echo "All e-gift vouchers in the system:\n";
foreach ($vouchers as $voucher) {
    echo "Voucher ID: {$voucher->getVoucherId()}, recipient: {$voucher->getRecipientName()}, amount: {$voucher->getAmount()}.\n";
}



?>
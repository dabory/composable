<?php

namespace App\Services\Shop;

class ShippingChargeService
{
    public function calc($shippingChargeDefaultSetup, $sub_total)
    {
        $setup = json_decode($shippingChargeDefaultSetup['C1'], true);

        switch ($shippingChargeDefaultSetup['C2']) {
            case 'amt':
                return $this->amtType($setup, $sub_total);
            case 'free':
                return $this->freeType($setup, $sub_total);
        }
    }

    public function amtType($setup, $sub_total)
    {
        $chargeAmt = 0;
        foreach ($setup['ShippingChargeBase'] ?? [] as $base) {
            if ($base['From'] <= $sub_total && $base['To'] > $sub_total) {
                $chargeAmt = $base['ChargeAmt'];
                break;
            }
        }

        return $chargeAmt;
    }

    public function freeType($setup, $sub_total)
    {
        return 0;
    }
}

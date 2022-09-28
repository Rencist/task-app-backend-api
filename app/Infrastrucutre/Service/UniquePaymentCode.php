<?php

namespace App\Infrastrucutre\Service;

use App\Core\Domain\Service\UniquePaymentCodeInterface;
use Illuminate\Support\Facades\DB;

class UniquePaymentCode implements UniquePaymentCodeInterface {
    /**
     * function to acquaire unique code for payment by event
     *
     * @param string $eventType
     * @return integer
     */
    public static function getByEventType(string $eventType): int
    {
        if($eventType==='nlc_code')
        {
            $latestbiaya = DB::table('nlc_team')->latest('created_at')->first(['unique_payment_code'])?->unique_payment_code;
        }
        if($eventType==='npc_junior_code')
        {
            $latestbiaya = DB::table('npc_team')->where('kategori', 'junior')->latest('created_at')->first(['unique_payment_code'])?->unique_payment_code;
        }
        if($eventType==='npc_senior_code')
        {
            $latestbiaya = DB::table('npc_team')->where('kategori', 'senior')->latest('created_at')->first(['unique_payment_code'])?->unique_payment_code;
        }
        if($eventType==='nst_order')
        {
            $latestbiaya = DB::table('nst_order')->latest('created_at')->first(['unique_payment_code'])?->unique_payment_code;
        }
        $latestbiaya = $latestbiaya ?? 0;
        $latestbiaya+=1;
        return $latestbiaya;
    }
}

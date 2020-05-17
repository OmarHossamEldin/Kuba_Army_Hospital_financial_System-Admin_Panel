<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\VisitIn;
use App\VisitOutDetail;
use App\WalletDetail;
use App\Wallet;
use App\WalletOfWallet;
use App\User;
use App\Service;
use App\OthersPrice;
use App\Morafek;
use App\VisitInFRankPrice;

class MorafeksController extends Controller
{
    public function update_date(Morafek $Morafek,Request $request)
    {
        $request->validate([
            "DayIn"              =>"required|date",
            "DayOut"                =>"required|date"
        ]);
        $Mstart=strtotime($request->DayIn);
        $Mend=strtotime($request->DayOut);
        $Pstart=strtotime($Morafek->VisitIn->date);
        $Pend=strtotime($Morafek->VisitIn->visitOut->first()->date);
        if($Mstart<$Pstart)
        {
            return 0;
        }
        if($Mend>$Pend)
        {
            return 0;
        }
        $Mstart==$Mend ? $MorafekDays=1 : $MorafekDays=abs($Mend-$Mstart)/60/60/24;
        
        //VisitIn Permission price VisitInFRankPrice using $R_FRank
        $Morafek->VisitIn->patient->frank!=null ? $VisitInPermissionPrice=VisitInFRankPrice::where('FRank_ID',$Morafek->VisitIn->patient->frank)->first()->price : $VisitInPermissionPrice=0;
        //VisitOut Which Is Master For CheckOut InVoice
        $visitOut=$Morafek->VisitIn->visitOut->first();
        //Get Total Of SupServices 
        $totalServices=0;
        foreach($Morafek->VisitIn->VisitOutDetails as $VisitOutDetail)
        {
            if($VisitOutDetail->subService_ID==2||$VisitOutDetail->subService_ID==3)
            {
                $OthersPrice=OthersPrice::findOrFail($VisitOutDetail->subService_ID);
        
                $morafekMoney=$OthersPrice->price*$MorafekDays;

                $VisitOutDetail->totalPrice=$morafekMoney;
            }
            $totalServices+=$VisitOutDetail->totalPrice;                                               //->total Price For Services
            $VisitOutDetail->save();
        }
        $totalVisitOut=$totalServices+$VisitInPermissionPrice;                                         //->TotalVisitOut
        $totalVisitOut=$Morafek->VisitIn->myCash-$totalVisitOut;                                       //->adjust From VisitIn MyCash
        if($totalVisitOut>=0){
            $visitOut->remainderMoney=$totalVisitOut;
            $visitOut->requestedMoney=0;
        }
        else{
            $visitOut->remainderMoney=0; 
            $visitOut->requestedMoney=abs($totalVisitOut);
        }
        $Morafek->date=$request->DayIn;
        $Morafek->dayOut=$request->DayOut;
        //SaveAll
        if( $visitOut->save() && $Morafek->save() )
        {
            return 1;
        }
        else{
            return 0;
        }
        
    }
    public function update_service(Morafek $Morafek ,request $request)
    {
        $request->validate([
            "ServiceId"      =>"required"
        ]);
        $OthersPrice=OthersPrice::findOrFail($request->ServiceId);
        $date=explode(' ',$Morafek->date);
        $morafekstart=strtotime($date[0]);
        $morafekend=strtotime($Morafek->dayOut);
        
        $morafekend==$morafekstart ? $MorafekDays=1 : $MorafekDays=abs($morafekend-$morafekstart)/60/60/24;
        $morafekMoney=$OthersPrice->price*$MorafekDays;

        $visitOutDetail=VisitOutDetail::where([['visitIn_ID',$Morafek->visitIn_ID],['subService_ID',$request->ServiceId]])->first();
        if($visitOutDetail)
        {
            $visitOutDetail->totalPrice=$morafekMoney;
            if($visitOutDetail->save()){
                //VisitOut Which Is Master For CheckOut InVoice
                 $visitOut=$Morafek->VisitIn->visitOut()->first();
                 //VisitIn Permission price VisitInFRankPrice using $R_FRank
                 $Morafek->VisitIn->patient->frank!=null ? $VisitInPermissionPrice=VisitInFRankPrice::where('FRank_ID',$Morafek->VisitIn->patient->frank)->first()->price : $VisitInPermissionPrice=0;
                 //Get Total Of SupServices 
                 $totalServices=0;
                 foreach($Morafek->VisitIn->VisitOutDetails as $VisitOutDetail)
                 {
                     $totalServices+=$VisitOutDetail->totalPrice;                                               //->total Price For Services
                 }
                 $totalVisitOut=$totalServices+$VisitInPermissionPrice;                                         //->TotalVisitOut
                 $totalVisitOut=$Morafek->VisitIn->myCash-$totalVisitOut;                                                //->adjust From VisitIn MyCash
                 if($totalVisitOut>=0){
                     $visitOut->remainderMoney=$totalVisitOut;
                     $visitOut->requestedMoney=0;
                 }
                 else{
                     $visitOut->remainderMoney=0; $visitOut->requestedMoney=abs($totalVisitOut);
                 }
                 if($visitOut->save())
                 {
                     return 1;
                 }
                 else{
                     return 0;
                 }
             }
        }
        $visitOutDetail=VisitOutDetail::where([['visitIn_ID',$Morafek->visitIn_ID],['subService_ID',2]])->first();
        if($visitOutDetail)
        {
            $visitOutDetail->totalPrice=$morafekMoney;
            if($visitOutDetail->save()){
                //VisitOut Which Is Master For CheckOut InVoice
                 $visitOut=$Morafek->VisitIn->visitOut()->first();
                 //VisitIn Permission price VisitInFRankPrice using $R_FRank
                 $Morafek->VisitIn->patient->frank!=null ? $VisitInPermissionPrice=VisitInFRankPrice::where('FRank_ID',$Morafek->VisitIn->patient->frank)->first()->price : $VisitInPermissionPrice=0;
                 //Get Total Of SupServices 
                 $totalServices=0;
                 foreach($Morafek->VisitIn->VisitOutDetails as $VisitOutDetail)
                 {
                     $totalServices+=$VisitOutDetail->totalPrice;                                               //->total Price For Services
                 }
                 $totalVisitOut=$totalServices+$VisitInPermissionPrice;                                         //->TotalVisitOut
                 $totalVisitOut=$Morafek->VisitIn->myCash-$totalVisitOut;                                                //->adjust From VisitIn MyCash
                 if($totalVisitOut>=0){
                     $visitOut->remainderMoney=$totalVisitOut;
                     $visitOut->requestedMoney=0;
                 }
                 else{
                     $visitOut->remainderMoney=0; $visitOut->requestedMoney=abs($totalVisitOut);
                 }
                 if($visitOut->save())
                 {
                     return 1;
                 }
                 else{
                     return 0;
                 }
             }
        }
        $visitOutDetail=VisitOutDetail::where([['visitIn_ID',$Morafek->visitIn_ID],['subService_ID',3]])->first();
        if($visitOutDetail)
        {
            $visitOutDetail->totalPrice=$morafekMoney;
            if($visitOutDetail->save()){
               //VisitOut Which Is Master For CheckOut InVoice
                $visitOut=$Morafek->VisitIn->visitOut()->first();
                //VisitIn Permission price VisitInFRankPrice using $R_FRank
                $Morafek->VisitIn->patient->frank!=null ? $VisitInPermissionPrice=VisitInFRankPrice::where('FRank_ID',$Morafek->VisitIn->patient->frank)->first()->price : $VisitInPermissionPrice=0;
                //Get Total Of SupServices 
                $totalServices=0;
                foreach($Morafek->VisitIn->VisitOutDetails as $VisitOutDetail)
                {
                    $totalServices+=$VisitOutDetail->totalPrice;                                               //->total Price For Services
                }
                $totalVisitOut=$totalServices+$VisitInPermissionPrice;                                         //->TotalVisitOut
                $totalVisitOut=$Morafek->VisitIn->myCash-$totalVisitOut;                                                //->adjust From VisitIn MyCash
                if($totalVisitOut>=0){
                    $visitOut->remainderMoney=$totalVisitOut;
                    $visitOut->requestedMoney=0;
                }
                else{
                    $visitOut->remainderMoney=0; $visitOut->requestedMoney=abs($totalVisitOut);
                }
                if($visitOut->save())
                {
                    return 1;
                }
                else{
                    return 0;
                }
            }
        } 
    }
    public function update_balance(Morafek $Morafek,request $request)
    {
        $request->validate([
            "MyCash"      =>"required"
        ]);
        $VisitIn=$Morafek->VisitIn;
        $VisitIn->myCash=$VisitIn->myCash-$Morafek->myCash;
        $VisitIn->myCash=$VisitIn->myCash+$request->MyCash;
        $Morafek->myCash=$request->MyCash;
        
        $DWallet=Wallet::where([['user_ID',$VisitIn->user->ID],['date',$VisitIn->date]])->first();//->Daily Wallet
        $DWallet->totalMoney=$request->MyCash;
        
        $WalletDetail=WalletDetail::where([
            ['Patient_ID',$VisitIn->patient_ID],
            ['Wallet_ID',$DWallet->ID],
            ['date',$Morafek->date],
            ['Service_ID',12]])->first();                                                         //->WalletDetails                
        $WalletDetail->price=$request->MyCash;
        
        //VisitOut Which Is Master For CheckOut InVoice
        $visitOut=$Morafek->VisitIn->visitOut()->first();
        //VisitIn Permission price VisitInFRankPrice using $R_FRank
        $Morafek->VisitIn->patient->frank!=null ? $VisitInPermissionPrice=VisitInFRankPrice::where('FRank_ID',$Morafek->VisitIn->patient->frank)->first()->price : $VisitInPermissionPrice=0;
        //Get Total Of SupServices 
        $totalServices=0;
        foreach($Morafek->VisitIn->VisitOutDetails as $VisitOutDetail)
        {
            $totalServices+=$VisitOutDetail->totalPrice;                                               //->total Price For Services
        }
        $totalVisitOut=$totalServices+$VisitInPermissionPrice;                                         //->TotalVisitOut
        $totalVisitOut=$Morafek->VisitIn->myCash-$totalVisitOut;                                       //->adjust From VisitIn MyCash
        if($totalVisitOut>=0){
            $visitOut->remainderMoney=$totalVisitOut;
            $visitOut->requestedMoney=0;
        }
        else{
            $visitOut->remainderMoney=0; $visitOut->requestedMoney=abs($totalVisitOut);
        }
        if($VisitIn->save() && $Morafek->save() && $DWallet->save() && $WalletDetail->save() && $visitOut->save())
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }
    public function destroy(Morafek $Morafek)
    {
        $VisitIn=$Morafek->VisitIn;

        $VisitIn->myCash=$VisitIn->myCash-$Morafek->myCash;
        
        $DWallet=Wallet::where([['user_ID',$VisitIn->user->ID],['date',$VisitIn->date]])->first();//->Daily Wallet
        $DWallet->totalMoney=$DWallet->totalMoney-$Morafek->myCash;
        
        $WalletDetail=WalletDetail::where([
            ['Patient_ID',$VisitIn->patient_ID],
            ['Wallet_ID',$DWallet->ID],
            ['date',$Morafek->date],
            ['Service_ID',12]])->first();                                                         //->WalletDetails                
        $WalletDetail->price= $WalletDetail->price-$Morafek->myCash;

        //VisitOut Which Is Master For CheckOut InVoice
        $visitOut=$Morafek->VisitIn->visitOut()->first();
        //VisitIn Permission price VisitInFRankPrice using $R_FRank
        $Morafek->VisitIn->patient->frank!=null ? $VisitInPermissionPrice=VisitInFRankPrice::where('FRank_ID',$Morafek->VisitIn->patient->frank)->first()->price : $VisitInPermissionPrice=0;
        //Get Total Of SupServices 
        $totalServices=0;
        foreach($Morafek->VisitIn->VisitOutDetails as $VisitOutDetail)
        {
            $totalServices+=$VisitOutDetail->totalPrice;                                               //->total Price For Services
        }
        $totalVisitOut=$totalServices+$VisitInPermissionPrice;                                         //->TotalVisitOut
        $totalVisitOut=$VisitIn->myCash-$totalVisitOut;                                                //->adjust From VisitIn MyCash
        if($totalVisitOut>=0){
            $visitOut->remainderMoney=$totalVisitOut;
            $visitOut->requestedMoney=0;
        }
        else{
            $visitOut->remainderMoney=0; $visitOut->requestedMoney=abs($totalVisitOut);
        }

        if($Morafek->delete())
        {
            if($VisitIn->save()  && $DWallet->save() && $WalletDetail->save() && $visitOut->save())
            {
                $Morafeks=$VisitIn->Morafeks()->get();                                          //->Which He Has Morafeks

                if(count($Morafeks)>0)
                {
                    return 1;
                }
                elseif(count($Morafeks)==0)
                {
                    foreach($Morafek->VisitIn->VisitOutDetails as $VisitOutDetail)
                    {
                        $VisitOutDetail->withMoreafek=0; 
                        if($VisitOutDetail->subService_ID==2||$VisitOutDetail->subService_ID==3)
                        {
                            $VisitOutDetail->delete();
                        }
                        else{
                            $VisitOutDetail->save();
                        }
                    }
                    return 1;
                }
                else{
                    return 0; 
                }
            }
            else
            {
                return 0;
            }
        }
    }
}

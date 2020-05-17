<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Patient;
use App\VisitIn;
use App\WalletDetail;
use App\Wallet;
use App\WalletOfWallet;
use App\User;
use App\Service;
use App\OthersPrice;
use App\VisitInFRankPrice;

class VisitInController extends Controller
{
    public function index()
    {
        return view('visitin.index');
    }

    public function get_visitIns($key)
    {   
        // selector refer to patient for visitIn
        is_numeric($key) ? 
        $patient=Patient::where('code',$key)->first()
        : 
        $patient=Patient::where('name',$key)->first();
        $state=" ";
        $datef=" ";
        $vistiIns=VisitIn::where('patient_ID',$patient->ID)->orderBy('date','DESC')->paginate(50); // get all visitIns paginated
        echo "<div class='table-scrollbar'>
                <table  class='table table-bordered table-hover' dir='rtl'>
                <thead  style='background-color:#4b545c;color:#fff;text-align:right'>
                    <tr>
                        <th>التسلسل</th>
                        <th>المريض</th>
                        <th>الملاحظات</th>
                        <th>المستشفي</th>
                        <th>الحالة</th>
                        <th>الاجمالى</th>
                        <th>تاريخ الدخول</th>
                        <th>تاريخ المغادرة</th>
                        <th>تعديل</th>
                    </tr>
                </thead>
                <tbody style='cursor: pointer;text-align:right'>";
                if(count($vistiIns)>0){
                    foreach($vistiIns as $visitIn)
                    {
                        if($visitIn->isExist==1)
                        {
                            $state="متواجد";
                        }
                        else
                        {
                            $state="غادر";
                        }
                        if($visitIn->datefinish)
                        {
                            $datef=Carbon::create($visitIn->datefinish)->toFormattedDateString();
                        }
                        else
                        {   
                            $datef=null;
                        }
                        echo "<tr>
                                <td>
                                    ".$visitIn->ID."
                                </td>
                                <td>
                                    ".$visitIn->patient->name."
                                </td>
                                <td>
                                    ".$visitIn->notes."
                                </td>
                                <td>
                                    ".$visitIn->hospital->name."
                                </td>
                                <td>
                                    ".$state."
                                </td>
                                <td>
                                    ".$visitIn->myCash."
                                </td>
                                <td>
                                    ".Carbon::create($visitIn->VisitOut()->first()->date)->toFormattedDateString()."
                                </td>
                                <td>
                                    ".$datef."
                                <td>
                                    <a href='\\visitIn/".$visitIn->ID."/edit' class='btn btn-primary' >تعديل</a>
                                </td>
                            </tr>";   
                    }
                }
                else{
                        echo  "<tr><td colspan='9' class='alert alert-danger' style='text-align: center;'>لا توجد لديه/لديها اي زيارات</td> </tr>";
                }
                
            echo "</tbody>
                </table>
                </div>";
            echo $vistiIns->links();
    }
    
    public function update_date(Request $request,VisitIn $visitIn)
    {
        /*Step1 We Gonna Get Patient Rank Or FRank Depend On
        It We Calculate The Value Of Each Service Per Single Day
        And VisitIn Permission Used To (Add  It On Total For Once ),
        Start And End Dates Used To Calculte Period Of Days Which Is
        Important To Get Total Of The VisitIn And Submit It To VisitOut.
        We Can Do All Of That Using.
        EQ:-
        TotalVisitOut=
        [(R|FRPatient Service Value)*Days]+Each Service +(R|FR)Patient VisitIn Permission.
        ===============================================================
        */
        $request->validate([
            "start"              =>"required|date",
            "end"                =>"required|date"
        ]);
        //VisitOut Which Is Master For CheckOut InVoice
        $visitOut=$visitIn->visitOut()->first();
        //->R|FRPatient $visitIn->patient
        $visitIn->patient->Rank_ID!=null ? $R_FRank=$visitIn->patient->rank->ID : $R_FRank=$visitIn->patient->frank->ID;  
        // Period Of Days
        $start=strtotime($request->start);                                              //->Convert It To Sec.s
        $end=strtotime($request->end);                                                  //->Convert It To Sec.s
        $start==$end ? $number_of_days = 1 : $number_of_days = ($end-$start)/60/60/24;  //->Period Of Days 
        if($number_of_days<=0)  
            return 0;                                                                   //->Fail For Wrong Dates                
        foreach($visitIn->VisitOutDetails as $VisitOutDetail)
        {
            $serviceId=$VisitOutDetail->subService_ID;
            $servicePricePerSingleDay=OthersPrice::findOrFail($serviceId)->price;      //->(R|FRPatient Service Value)
            if($serviceId==2 || $serviceId==3){                                        //->Which He Has Morafeks
                $Morafeks=$visitIn->Morafeks()->get();
                $MorafekDays=0;
                $morafekmoney=0;
                foreach($Morafeks as $Morafek){
                    $date=explode(' ',$Morafek->date);
                    $morafekstart=strtotime($date[0]);
                    $morafekend=strtotime($Morafek->dayOut);
                    if($morafekend>$end)
                    {
                        return 0;
                    }
                    if($morafekstart<$start)
                    {
                        return 0;
                    }
                    $morafekend==$morafekstart ? $MorafekDays=1 : $MorafekDays=abs($morafekend-$morafekstart)/60/60/24;
                    $morafekmoney+=$servicePricePerSingleDay*$MorafekDays;
                }
                $VisitOutDetail->totalPrice=$morafekmoney;
                $VisitOutDetail->save();
                 
            }
            else{    
                $VisitOutDetail->totalPrice=$servicePricePerSingleDay*$number_of_days;      //->[(R|FRPatient Service Value)*Days]
                $VisitOutDetail->save();                                                    //->save Changes To VisitOutDetails
            }                                                   
        } 
        //VisitIn Permission price VisitInFRankPrice using $R_FRank
        $visitIn->patient->frank!=null ? $VisitInPermissionPrice=VisitInFRankPrice::where('FRank_ID',$R_FRank)->first()->price : $VisitInPermissionPrice=0;
        //Get Total Of SupServices 
        $totalServices=0;
        foreach($visitIn->VisitOutDetails as $VisitOutDetail)
        {
            $totalServices+=$VisitOutDetail->totalPrice;                                               //->total Price For Services
        }
        $totalVisitOut=$totalServices+$VisitInPermissionPrice;                                         //->TotalVisitOut
        $totalVisitOut=$visitIn->myCash-$totalVisitOut;                                                //->adjust From VisitIn MyCash
        if($totalVisitOut>=0){
            $visitOut->remainderMoney=$totalVisitOut;
            $visitOut->requestedMoney=0;
        }
        else{
            $visitOut->remainderMoney=0; $visitOut->requestedMoney=abs($totalVisitOut);
        }    
           
        $visitIn->date=$request->start;
        $visitOut->date=$request->end;
        $visitOut->daysNumber=$number_of_days;
        //save changes
        if($visitIn->save() && $visitOut->save())
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    public function edit(VisitIn $visitIn)
    {
        /*  :) tried to deal with this db structure not mine btw :3 */
                                            
        $Morafeks=$visitIn->Morafeks()->get();                                          //->Which He Has Morafeks
      
        if($visitIn->patient->Rank_ID!=null)
        {
            $patientn=$visitIn->patient->rank->RName." / ".$visitIn->patient->name;     //->Patient name with Rank
        }
        else
        {
            $patientn=$visitIn->patient->frank->FRName." / ".$visitIn->patient->name;   //->Patient name with Frank
        }
        $info=[
            "visitIn"       =>$visitIn,
            "patientname"   =>$patientn,
            "Morafeks"      =>$Morafeks
        ];
        return view('visitin.edit')->with($info);
    }

    public function update(Request $request,VisitIn $visitIn) //->VisitIn $visitIn => doing the same job of findOrFail and prepare
    {
        $request->validate([
            "MyCash"                 =>"required"
        ]);
        if($request->MyCash>0)
        {
            $visitIn->myCash=$request->MyCash;                                                        //->newCash For Patient
 
            $DWallet=Wallet::where([['user_ID',$visitIn->user->ID],['date',$visitIn->date]])->first();//->Daily Wallet
            $DWallet->totalMoney=$request->MyCash;
            
            $WalletDetail=WalletDetail::where([
                ['Patient_ID',$visitIn->patient_ID],
                ['Wallet_ID',$DWallet->ID],
                ['date',$visitIn->date],
                ['Service_ID',11]])->first();                                                         //->WalletDetails                
            $WalletDetail->price=$request->MyCash;
            //$WalletDetail->done=0;
            
            /*$MWallet=WalletOfWallet::where('User_ID',$visitIn->user_ID)->first();                   //->mainWallet
            $MWallet->totalMoney=$MWallet->totalMoney+$request->WalletPrice;*/

            //VisitIn Permission price VisitInFRankPrice using $R_FRank
            $visitIn->patient->frank!=null ? $VisitInPermissionPrice=VisitInFRankPrice::where('FRank_ID',$R_FRank)->first()->price : $VisitInPermissionPrice=0;
            //VisitOut Which Is Master For CheckOut InVoice
            $visitOut=$visitIn->visitOut->first();
            //Get Total Of SupServices 
            $totalServices=0;
            foreach($visitIn->VisitOutDetails as $VisitOutDetail)
            {
                $totalServices+=$VisitOutDetail->totalPrice;                                               //->total Price For Services
            }
            $totalVisitOut=$totalServices+$VisitInPermissionPrice;                                         //->TotalVisitOut
            $totalVisitOut=$visitIn->myCash-$totalVisitOut;                                                //->adjust From VisitIn MyCash
            if($totalVisitOut>=0){
                $visitOut->remainderMoney=$totalVisitOut;
                $visitOut->requestedMoney=0;
            }
            else{
                $visitOut->remainderMoney=0; 
                $visitOut->requestedMoney=abs($totalVisitOut);
            }  
            //SaveAll
            if($visitIn->save()  && $DWallet->save() && $WalletDetail->save() && $visitOut->save() )
            {
                return 1;
            }
            else{
                return 0;
            }
        }
    }

}

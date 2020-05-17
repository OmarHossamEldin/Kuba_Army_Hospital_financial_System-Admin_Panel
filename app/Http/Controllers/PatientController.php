<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\FRank;
use App\Rank;
use App\Relation;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient.index');
    }

    public function search_patient($patient)
    {
        is_numeric($patient)
        ?
            $patients=Patient::where([['code','like','%'.$patient.'%']])->paginate(50)
        :
            $patients=Patient::where([['name','like','%'.$patient.'%']])->paginate(50);


            if($patients->count()==0){
                return 0;
            }
            else
            {
                $rank        =null;
                $frank       =null;
                $frankdetails=null;
                foreach($patients as $patient)
                {
                    if(isset($patient->rank)){
                        $rank=$patient->rank->RName;
                        $frank=null;
                        $frankdetails=null;
                    }
                    if(isset($patient->frank)){
                        $frank=$patient->frank->FRName;
                        $frankdetails=$patient->parents()->first()->childs()->first()->rank->RName.' / '.$patient->parents()->first()->childs()->first()->name;
                        $rank=null;

                    }
                    echo '<div class="row" dir="rtl" style="text-align: right;">
                            <div class="form-group col-2">
                                <label class="control-label">رقم الحاسب</label> 
                                <input type="text" class="form-control" readonly data="'.$patient->code.'" value="'.$patient->code.'">
                            </div>
                            <div class="form-group col-3">
                                <label class="control-label">اسم المريض</label> 
                                <input type="text" class="form-control" readonly data="'.$patient->name.'" value="'.$patient->name.'">
                            </div>
                            <div class="form-group col-2">
                                <label class="control-label">الرتبة</label> 
                                <input type="text" class="form-control" readonly data="'.$rank.'" value="'.$rank.'">
                            </div>
                            <div class="form-group col-2">
                                <label class="control-label">درجة القرابة</label> 
                                <input type="text" class="form-control" readonly title="'.$frankdetails.'" data="'.$frank.'" value="'.$frank.'">
                            </div>
                            <div class="form-group col-1">
                                <a href="\patient/'.$patient->ID.'/edit" class="btn btn-primary" style="margin-top:32px;width:100%">تعديل</a>
                            </div>
                            <div class="form-group col-1"> 
                                <button class="btn btn-danger delete" info="'.$patient->ID.'" style="margin-top:32px;width:100%">حذف</button>
                            </div>
                        </div>';    
                }
               echo $patients->links();
            }
        }
       

    public function edit($id)
    {
        $Patient=Patient::findOrfail($id);
        $franks=FRank::all();
        $ranks=Rank::all();

        $info=[
            "Patient"=>$Patient,
            "franks"=>$franks,
            "ranks"=>$ranks
        ];

        return view('patient.edit')->with($info);
    }

    public function search_parent($parent)
    {
        if(is_numeric($parent))
        {
            $patients=Patient::where([['code','like','%'.$parent.'%']])->get()->take(50);

            if($patients->count()==0){
                return 0;
            }
            else
            {
                $codes=[];
                foreach($patients as $patient){

                    array_push($codes,strval($patient->code));

                }
                return $codes;
            }
        }
        if(is_string($parent))
        {
            $patients=Patient::where([['name','like','%'.$parent.'%']])->get()->take(50);

            if($patients->count()==0){
                return 0;
            }
            else
            {
                $names=[];
                foreach($patients as $patient){

                    array_push($names,$patient->name);

                }
                return $names;
            }
        }
    }

    public function parent_info($key)
    {
        is_numeric($key)
        ?
            $patient=Patient::where('code',$key)->first()
        :
            $patient=Patient::where('name',$key)->first();

        $info=[
            "patient"=>$patient,
            "rank"=>$patient->rank->RName
        ];

        return $info;
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            "name"=>"required",
            "code"=>"required",
        ]);

        $Patient=Patient::findOrFail($id);

        $Patient->code=$request->code;
        $Patient->name=$request->name;
        
        if($request->rank==null)
        {
            if($request->frank)
            {
                $Patient->FRank_ID=$request->frank;
                $Patient->Rank_ID=null;
                if($Patient->childs->count()>0)
                {
                    foreach($Patient->childs as $child){

                       $child->delete();
                    }
                    Relation::create([
                        'Child_ID'=>$id,
                        'Parent_ID'=>$request->parentid
                    ]);
                    
                    $Patient->save();
                    return 1;
                }
                else
                {
                    Relation::create([
                        'Child_ID'=>$id,
                        'Parent_ID'=>$request->parentid
                    ]);

                    $Patient->save();
                    return 1;
                }
            }
            else
            {
                return 0;
            }
        }
        else
        {
           $Patient->Rank_ID=$request->rank;
           $Patient->FRank_ID=null;
           if($Patient->parents->count()>0)
           {
               $Patient->parents->first()->delete();  
           }
           $Patient->save(); 
           return 1;
        }
    }

    public function destroy(Patient $patient)
    {
        if($patient->delete()){
            return 1;
        }
        else{
            return 0;
        }
        
    }
}

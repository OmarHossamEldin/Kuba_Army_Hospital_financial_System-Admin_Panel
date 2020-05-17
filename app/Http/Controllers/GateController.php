<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Password_reset;


class GateController extends Controller
{
    use AuthenticatesUsers;

    public function welcomepage()
    {
        return view('welcome');
    }

    public function getloginform()
    {
        return view('login');

    }

    public function login(Request $request)
    {
        $request->validate([
            "username"=>"required|string|max:255",
            "password"=>"required"
        ]);

        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password]))
        {
            return redirect('dashboard')->with('success','لقد تم تسجيل الدخول بنجاح'); 
        }
        else{
            return redirect()->back()->withInput($request->only('username'))->with('error','برجاء التاكد من اسم المستخدم وكلمة المرور');
        }
    }

    public function safetyQuestion()
    {
        $question=[
            "ما هو رقم المنزل واسم الشارع الذي كنت تعيش فيه كطفل؟",
            "ما هي الأرقام الأربعة الأخيرة من رقم هاتف طفلك؟",
            "ما المدرسة الابتدائية التي التحقت بها؟",
            "في أي مدينة أو مدينة كانت أول وظيفة لك بدوام كامل؟",
            "في أي مدينة أو مدينة قابلت زوجتك / شريكك؟",
            "ما هو الاسم الأوسط لأكبر طفل؟",
            "ما هي آخر خمسة أرقام من رقم رخصة القيادة/ البطاقة الخاصة بك؟",
            "ما هو اسم جدتك (على جانب والدتك)؟",
            "في أي مدينة أو مدينة قابلت أمك وأبيك؟",
            "في أي وقت من اليوم ولدت؟",
            "في أي وقت من اليوم ولد طفلك الأول؟"
        ];

        // get random index from array $questions
        $key = array_rand($question);
    
        $info=[
            "question"=>$question,
            "key"=>$key
        ];
        
        return view('safetyQuestion.safetyQuestion')->with($info);
    }

    public function sQstore(Request $request)
    {
        $request->validate([
            'answer'=>'required|string|max:255',
            'key'=>'required'
        ]);

        Password_reset::create([
            'username'=>auth()->user()->username,
            'key'=>$request->key,
            'answer'=>$request->answer
        ]);
        return redirect('dashboard')->with('success','تم تسجيل الدخول بنجاح');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('success','تم تسجيل الخروج بنجاح');
    }

    public function forgepatPasswordForm()
    {
        return view('safetyQuestion.forgetPassword');
    }

    public function forgetPasswordUsername($username)
    {
        $safetyQuestion=Password_reset::where('username',$username)->first();
        if($safetyQuestion==null){
            return ['ليس لك سؤال امان برجاء متابعة رائيس النظم'];
        }
        else{
            $question=[
                "ما هو رقم المنزل واسم الشارع الذي كنت تعيش فيه كطفل؟",
                "ما هي الأرقام الأربعة الأخيرة من رقم هاتف طفلك؟",
                "ما المدرسة الابتدائية التي التحقت بها؟",
                "في أي مدينة أو مدينة كانت أول وظيفة لك بدوام كامل؟",
                "في أي مدينة أو مدينة قابلت زوجتك / شريكك؟",
                "ما هو الاسم الأوسط لأكبر طفل؟",
                "ما هي آخر خمسة أرقام من رقم رخصة القيادة/ البطاقة الخاصة بك؟",
                "ما هو اسم جدتك (على جانب والدتك)؟",
                "في أي مدينة أو مدينة قابلت أمك وأبيك؟",
                "في أي وقت من اليوم ولدت؟",
                "في أي وقت من اليوم ولد طفلك الأول؟"
            ];
            return [$question[$safetyQuestion->key],1];
        }
    }

    public function confirmAnswer($username,$answer)
    {
        $safetyQuestion=Password_reset::where(
            [
                ['username', '=', $username],
                ['answer', '=', $answer]
            ])->first();
        if(!$safetyQuestion){
            return 'NotConfirmed';
        }
        else{
            return $safetyQuestion->username;
        }
    }

    public function changingPassword($username)
    {
        $username=Admin::where('username',$username)->first();

        if( url()->previous()=='http://finanicalmoneyadminpanel.com:8085/forgetPassword' || url()->previous()=='128.16.7.38:8085/forgetPassword')
        {
			//dd(url()->previous());
            return redirect('login')->with('error','غير مصرح اليك دخول هذه الصفحة');
        }

        return view('safetyQuestion.changingPassword')->with('username',$username->id);
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            "id"=>"required",
            "password"=>"required|confirmed"
        ]);
        
        $user=Admin::findOrFail($request->id);
        $user->password=Hash::make($request->password);
        $user->save();

        return redirect('\login')->with('success','لقد تم اعادة تعين كلمة المرور');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use Event;
use App\Events\ResumeUploaded;
use App\Repositories\Resume\ResumeRepositoryInterface;
use App\User;
use App\Profile;
use App\Role;
use App\Payment;
use Softon\Indipay\Facades\Indipay;
use App\PaymentSupport\Itdprocess\Facades\Itdprocess;

class RegistrationController extends Controller
{
    protected $resume;

    public function __construct(ResumeRepositoryInterface $resume)
    {
        $this->resume = $resume;
    }
    public function getRegister()
    {
        return view('user.register');
    }
    
    public function postRegister(Request $request)
    {    
        // dd($request->ip());
        // Create User       
        $user = User::create([            
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'verification_code' => str_random(10),            
            'ip' => $request->ip(),
        ]);
        // Attach Role
        $subscriber = Role::whereName('user')->first();
        $user->attachRole($subscriber);

        return redirect()->route('user::register.get.profile', ['user' => $user->id]);  	
    }

    public function getRegisterProfile($id)
    {
        // dd($id);
        return view('user.register-profile', [ 'id' => $id ]);
    }

    public function postRegisterProfile(Request $request)
    {
        // dd($request->all());
        // Create User Profile
        $profile = new Profile;
        $profile->first_name = $request['first_name'];
        $profile->last_name = $request['last_name'];
        $profile->mobile = $request['mobile'];

        $user = User::find($request['user_id']);
        $user->profile()->save($profile);
        
        // Login User
        Auth::login($user);
        return redirect()->route('user::payment.resume');
    }

    public function getPayment()
    {
        $user = Auth::User();

        return view('user.payment', ['user' => Auth::user()]);
    }

    public function postPayment(Request $request)
    {   
        // dd($request->all());
        $user = Auth::User();
        $parameters = [
            'fname' => $request->fname,
            'fphone' => $request->fphone,
            'femail' => $request->femail,
            'famount' => 1500,
        ];
        $order = Itdprocess::prepare($parameters);       
        return Itdprocess::process($order);        
       
        // // Uncomment before pushing to production server    
        // $user = Auth::user();
        // $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);  
        // $orderid = date("Y")."/".date("m")."/".date("d")."/".$txnid;
        // $sitekey = 'K&lQ89nJpPZ';
        // $famount = strval(1500);
        // $hashtest= $user->profile->first_name.'|'.$user->profile->mobile.'|'.$user->email.'|'.$famount.'|'.$orderid.'|'.$sitekey;
        // $hashtestoutput = hash("sha512", $hashtest);
        // $txnref=$hashtestoutput;      

        // // $user->has_paid = true;
        // // $user->save();
        
        // $order_id = Payment::all()->count() + 1;
        // $parameters = [
        //     'sitekey' => $sitekey,
        //     'txnref' => $txnref,
        //     'orderid' => $order_id,
        //     'famount' => 1500,
        //     'fname' => $user->profile->first_name,
        //     'femail' => $user->email,
        //     'fphone' => $user->profile->mobile,
        //     'productinfo' => 'Dummy Product',
        // ];
        // $order = Indipay::prepare($parameters);
        // return Indipay::process($order);
        // // $payment = new Payment();
        // // $payment->user_id = $user->id;
        // // $payment->transaction_id = $txnid;            
        // // $payment->save();
        
        // // return redirect()->route('user::invite.contacts');
    }

    public function paymentResponse(Request $request)
    {        
        $response = Itdprocess::response($request);
        // $response = Indipay::response($request);

        // dd($response);
        $user = Auth::User();
        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->transaction_id = $request->txnid;
        $payment->amount = $request->famout;            
        $payment->save();
        
        dd($response);
        return redirect()->route('user::invite.contacts');
    }

    public function invite()
    {
        return view('user.invite',['user' => Auth::user()]);
    }

    public function importGoogleContact(Request $request)
    {
        // get data from request
        $code = $request->get('code');

        // get google service
        $googleService = \OAuth::consumer('Google');

        // check if code is valid

        // if code is provided get user data and sign in
        if ( ! is_null($code)) {
            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);
           
            // Send a request with it
            $result = json_decode($googleService->request('https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=10'), true);

            // Going through the array to clear it and create a new clean array with only the email addresses
            $emails = []; 
            foreach ($result['feed']['entry'] as $key => $contact) {
                if (isset($contact['gd$email'])) { // Sometimes, a contact doesn't have email address                
                    
                    $photo_val = $googleService->request($contact['link'][1]['href']);
                    $imgData = base64_encode($photo_val);
                    $image ='data:image/jpeg;base64,'.$imgData .'';

                    $emails[ $key++ ] = [
                        'title' => $contact['title']['$t'], 
                        'email' => $contact['gd$email'][0]['address'], 
                        'link' => $image
                    ];
                }
            }
            
            // Test Code
            // $photo_val = $googleService->request('https://www.google.com/m8/feeds/photos/media/srijit777%40gmail.com/e9e20899252dd');
            // $imgData = base64_encode($photo_val);
            // $image ='data:image/jpeg;base64,'.$imgData .'';
            // echo '<img src="' . $image . '">';

            // Display Results
            // foreach ($emails as $key => $email) {
            //   echo 'No: ' . $key . '<br>';
            //   echo 'Title: ' . $email['title'] .'<br>';
            //   echo 'Email: ' . $email['email'] . '<br>';  
            //   echo 'Picture: <img src="' . $email['link'] . '"> <br>';  
            // }
            
        }
        
        // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return redirect((string)$url);
        }

        return redirect()->route('user::upload.resume');
    } 

    public function upload()
    {
        return view('user.upload', ['user' => Auth::user()]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $number = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $resumeCount = $this->resume->getCount();
        $user->has_uploaded = true;
        $user->save();

        // $fileName = generateFile($request->resume_file,$resumeCount);
        // Generate New File name
        $file = $request->resume_file;
        $extension = $file->getClientOriginalExtension();
        $fileName = 'Resume-' . ++$resumeCount;

        // Generate Iteration Number to Word
        $count = $user->resumes()->count();
        $iteration = $number->format($count + 1);        
        $fileAlias = 'resume-draft-'. $iteration; 

        // Determine if First Time or Subsequent upload
        if($count >= 2 ) 
        {
            if( $user->resumes()->get()->last()->review_id === 4)
            {
                $parent = 0;
            } else {
                $parent = $user->resumes()->get()->last()->id;
            }
        } else {
            $parent = 0;
        }

        
        // Store the resume on storage/app/resumes
        Storage::put('resumes/' . $fileName . '.' . $extension, File::get($file));
        
        // Fire Event to register the resume with User
        Event::fire(new ResumeUploaded($user, $fileName, $fileAlias, $parent));
        
        return redirect()->route('user::dashboard');
    }
}

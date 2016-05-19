<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Event;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\Resume\ResumeRepositoryInterface;
use App\Repositories\Report\ReportRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Parameter\ParameterRepositoryInterface;
use App\User;
use App\Report;
use App\Resume;
use App\Review;
use App\Parameter;
use App\Events\ReportGenerated;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;
use Softon\Indipay\Facades\Indipay;
use Alert;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user, $resume, $report, $payment, $parameter;

    public function __construct(UserRepositoryInterface $user, ResumeRepositoryInterface $resume, 
                                ReportRepositoryInterface $report, PaymentRepositoryInterface $payment,
                                ParameterRepositoryInterface $parameter)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->resume = $resume;
        $this->report = $report;
        $this->payment = $payment;
        $this->parameter = $parameter;
    }

    public function welcome()
    {        
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.home');
    }

    /**
     * Show all registered Users
     * @return [type] [description]
     */
    public function getUsers(){
        $roles = $this->user->getAllUsers();
        return view('admin.dashboard.users', ['users' => $roles->first()->users]);
    }

    public function getUserTimeline(User $user)
    {
        return view('admin.dashboard.user-timeline', compact('user'));
    }

    /**
     * Show all Resumes
     * @return [type] [description]
     */
    public function getResumes(){    	
        $resumes = $this->resume->getAll();
        $allResumes = true;
        return view('admin.dashboard.resumes', compact('resumes','allResumes'));
    }

    public function getNewResumes()
    {
        $resumes = $this->resume->getNew();
        $pendingResumes = $this->resume->getPending();
        return view('admin.dashboard.resumes', compact('resumes','pendingResumes'));
    }  

    /**
     * Show all Payments
     * @return [type] [description]
     */
    public function getPayments(){

    	return view('admin.dashboard.payments', ['payments' => $this->payment->getAll()]);
    }

    public function postPayments(Request $request)
    {
        $parameters = [
            'tid' => $request->tid,
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'firstname' => 'John',
            'email' => 'john@doe99s.com',
            'phone' => '97468639589',
            'productinfo' => 'Dummy Product',
        ];
        $order = Indipay::prepare($parameters);
        return Indipay::process($order);
    }

    public function response(Request $request)
    {        
        $response = Indipay::response($request);
        dd($response);
    }  

    /**
     * Review a resume
     * @param  Resume $resume [description]
     * @return [type]         [description]
     */
    public function getReview(Resume $resume)
    {
        $parameters = $this->parameter->getAll();
        return view('admin.dashboard.review', compact('resume','parameters'));
    }

    /**
     * Post the review 
     * @return [type] [description]
     */
    public function postReview(Request $request)
    {           
        
        // $number = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        
        $paramCount = $this->parameter->getCount();
        $totalScore = 0;
        $index = 0;
        

        // Parameters to be filled     
        foreach ($request->parameter as $param => $score) {          
            $params[$param] = ['score' => $score, 'remark' => $request->remarks[$index++]];
            $totalScore+=$score;           
        }


        if(isset($request->rep_file)) {
            $number = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
            $count = $this->report->getCount();
            $file = $request->rep_file;
            $extension = $file->getClientOriginalExtension();
            $fileName = 'Report-' . ++$count;
            
            // Store the resume on storage/app/resumes
            Storage::put('reports/' . $fileName . '.' . $extension, File::get($file));
        }

        $report = new Report();
        $report->user_id = $request->user_id;
        $report->resume_id = $request->resume_id;
        $report->score = $totalScore;
        $report->gen_remark = $request->gen_remark;
        $report->file = $request->rep_file ? $fileName : null;
        $report->save();

        $report->parameters()->attach($params);
        
        $resume = Resume::find($request->resume_id);
        $resume->review_id = Review::whereName('reviewing')->first()->id;
        $resume->save();

        return redirect()->route('admin::dashboard.showReport',[$report->id]);
    }

    /**
     * Get the resume file
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function getFile(Request $request)
    {
        $response = findFile($request->file_id, $request->type);
        return $response;
    }
    /**
     * Get all Reports
     * @return [type] [description]
     */
    public function getReports(){
        $reports = $this->report->getAll();
        return view('admin.dashboard.reports', compact('reports'));
    }

    /**
     * Show individual Report
     * @return [type] [description]
     */
    public function showReport(Report $report)
    {   
        return view('admin.dashboard.singlereport', compact('report'));
    }  

    /**
     * Get the drafted report for editing
     * @return [type] [description]
     */
    public function getEditReport(Report $report)
    {   
        return view('admin.dashboard.edit-report', compact('report'));        
    }

    public function postEditReport(Request $request)
    {
        $paramCount = Parameter::count();
        $totalScore = 0;   
        $index = 0;
        // Parameters to be filled     
        foreach ($request->parameter as $param => $score) {          
            $params[$param] = ['score' => $score, 'remark' => $request->remarks[$index++]];
            $totalScore+=$score;           
        }

        if(isset($request->rep_file)) {
            $number = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
            $count = $this->report->getCount();
            $file = $request->rep_file;
            $extension = $file->getClientOriginalExtension();
            $fileName = 'Report-' . ++$count;
            
            // Store the resume on storage/app/resumes
            Storage::put('reports/'. $fileName . '.' . $extension, File::get($file));
        }

        $report = Report::find($request->report_id);
        $report->score = $totalScore;
        $report->gen_remark = $request->gen_remark;
        $report->file = $request->rep_file ? $fileName : null;
        $report->save();

        $report->parameters()->sync($params);

        return redirect()->route('admin::dashboard.showReport',[$request->report_id]);
    }

    /**
     * Generate report from draft
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function generateReport(Request $request)
    {
        $resume = Resume::find($request->resume_id);
        $resume->review_id = Review::whereName('reviewed')->first()->id;
        $resume->save();

        $user = User::findOrFail($resume->user_id);
        
        Event::fire(new ReportGenerated($user));
        
        Session::flash('msg','Report generated and notified to User.');
        
        return redirect()->route('admin::dashboard.showReport',[$request->report_id]);
    }

    public function getDropoffs()
    {       
        $values = $this->user->getDropoffs(2016);
        $dropoffs = \Lava::DataTable();

        // dd($values);
        $dropoffs->addDateColumn('Month')
                 ->addNumberColumn('Subscribed')
                 ->addNumberColumn('Paid')
                 ->setDateTimeFormat('n');
            foreach ($values as $value) {
                $dropoffs->addRow([
                    strval($value->month), $value->subscribed, intval($value->paid)
                ]);
            }
                 // $dropoffs->addRow([
                 //    1, 1, 
                 //    ]);
                \Lava::ColumnChart('Dropoffs', $dropoffs, [
                    'title' => 'Dropoffs in Year 2016',
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 14
                    ]
                ]);
                return view('admin.dashboard.analytics');
            }

    public function getParameters()
    {
        return view('admin.dashboard.parameters', ['parameters' => $this->parameter->getAll() ]);
    }
    public function createParameter()
    {
        return view('admin.dashboard.create-parameter');
    }

    public function saveParameter(Request $request)
    {
        Parameter::create([
            'name' => $request->p_name,
        ]);
        Alert::success('Parameter Successfully Created');
        return redirect()->route('admin::dashboard.parameters');
    }

    public function editParameter(Parameter $parameter)
    {
        return view('admin.dashboard.edit-parameter', ['parameter' => $parameter]);
    }

    public function updateParameter(Request $request)
    {
        $parameter = Parameter::findOrFail($request->p_id);
        $parameter->name = $request->p_name;
        $parameter->save();
        Alert::success('Parameter Updated successfuly');
        return redirect()->route('admin::dashboard.parameters');
    }

    public function destroy(Parameter $parameter)
    {
        // $parameter->delete();
        Alert::success('Parameter Deleted successfuly');
        return redirect()->route('admin::dashboard.parameters');
    }

    public function test()
    {
        // $type = 'resume';
        // $fileCount = 5;
        // $totalCount = 10;
        // $file = Storage::get('resumes/Resume-1.pdf');
        // $extension = $file->getClientOriginalExtension();
        // $response = Response::make($file, 200);            
        // $response->header('Content-Type', 'application/pdf');
        // return $response;
        // dd(generateFile($type,$file,$fileCount,$totalCount));
        return view('form-check');
    }
    public function testPost(Request $request)
    {
        // dd($request->all());
        dd(generateFile($request->type,$request->file,$request->fileCount,$request->totalCount));
    }     
}

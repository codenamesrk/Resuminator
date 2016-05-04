<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use App\Profile;
use App\Report;
use App\Repositories\Resume\ResumeRepositoryInterface;
use DB;

class UserController extends Controller
{
    protected $resume, $user;

    public function __construct(ResumeRepositoryInterface $resume)
    {
    	$this->resume = $resume;
    	$this->user = Auth::user();
    }
    public function welcome()
    {
    	return view('user.welcome');
    }

    public function index()
    {
    	
    	// $resumes = $this->user->resumes()->get();
    	// $reports = $this->user->reports()->get();

        $resume_reports = DB::table('resumes')
        ->where('resumes.user_id',$this->user->id)            
        ->leftjoin('reports','reports.resume_id','=','resumes.id')                                     
        ->select('resumes.*','reports.id AS report_id' ,'reports.score', 'reports.gen_remark','reports.file')
        ->orderBy('resumes.created_at','desc')                       
        ->get();

        // dd($resume_reports);

    	return view('user.dashboard.home', ['user' => Auth::user(), 'resume_reports' => $resume_reports ]);
    }

    public function getReport(Report $report)
    {
        return view('user.dashboard.report', ['user' => Auth::user(), 'report' => $report]);
    }

    public function getFile(Request $request)
    {
        $response = findFile($request->file_id,$request->type);
        return $response;
    }    

}

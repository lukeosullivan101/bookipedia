<?php

namespace App\Http\Controllers;

use App\Submission;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{

    public function index()
  {
    //fetch 10 posts from database which are active and latest
    $submissions = Submission::orderBy('created_at','desc')->paginate(3);

    //return blog.blade.php template from resources/views folder
    return view('/submissions')->withSubmissions($submissions);
  }
    public function writeForUs(){
        return view('write');
    }

    //User submitting summaries functionality
    public function storeSubmission(Request $request)
  {
    
    $this->validate($request, [
        'title'=>'required',
        'summary'=>'required'
      ]);
    $submission = new Submission();
    $submission->title = $request->get('title');
    $submission->summary = $request->get('summary');
    $submission->author_id = $request->user()->id;

    $submission->save();

    return redirect('write')->with('message', 'Thank you, you have succesfully submitted your summary!'); 
  }

  public function deleteSubmission(Request $request, $id){
    $submission = Submission::where('id', $id)->first();
    if($submission && ($request->user()->is_admin()))
      {
        $submission->delete();
        return redirect('submissions')->with('message', 'Submission has been deleted!');
      }
      else 
      {
        return redirect('submissions')->with('message', 'There was an error deleting submission');
      }
  }

} //Controller

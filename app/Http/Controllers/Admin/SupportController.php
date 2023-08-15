<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Support;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Events\StatusChanged;
use Datatables;
use Input;




class SupportController extends Controller
{
   public function dashboard(){
      //echo Hash::make('web123'); die();
      $ticket_closed=Support::where('status',2)->where('parent_id',0)->count();
      $ticket_open=Support::where('status',1)->where('parent_id',0)->count();

      return view('admin.dashboard',compact('ticket_closed','ticket_open'));  
   }

   public function index(){
      return view('admin.support.index');  
   }

   public function list(Request $request){
        $input = $request->all();
        $title = Input::get('title');
        $description = Input::get('description');
        

        //if(!empty($input['draw'])){
            $datas=Support::where('parent_id',0);//->OrderBy('id','DESC');
            
            if(!empty($title)){ 
              $datas->where("title",$title);
            }

            if(!empty($description)){ 
              $datas->where("description",$description);
            }

         $dataTable=Datatables::of($datas)
            ->editColumn('status', function($data){
                  if($data->status==1)
                     return '<span class="statusChange btn btn-danger" data-id="'.encrypt($data->id).'"> Open </span>';
                  else
                    return '<span class="statusChange btn btn-success" data-id="'.encrypt($data->id).'"> Closed </span>';
              })
            ->editColumn('created_at', function($data){
                  return $data->createdAt();
              })
            ->editColumn('assigned_to', function($data){
                  return $data->assignedTo->name;
              })
            ->editColumn('created_by', function($data){
                  return $data->createdBy->name;
              })
            ->addColumn('action', function($data){
                  
                  $edit='<a href="'.route('admin.support.view',encrypt($data->id)).'"><i class="fa fa-eye"></i> View </a>';
                  return $edit;
              })
            ->rawColumns(['action','status'])
            ->make(true);

         return $dataTable;
    }

   public function add(){
      $user=User::where('status',1)->get();
      return view('admin.support.add',compact('user'));  
   }

   public function addTicket(Request $request){
      $rules = [
         'assigned_to' => 'required|numeric',
         'title' => 'required',
         'description' => 'required'
      ];

      $validator = Validator::make($request->all(),$rules);
      if($validator->fails()){
         return back()->withErrors($validator->errors())->withInput();
      }

      $user=Auth::user();
      
      $data=[];
      $data['parent_id']=0;
      $data['created_by']=$user->id;
      $data['assigned_to']=$request->assigned_to;
      $data['title']=$request->title;
      $data['description']=$request->description;
      $data['status']=1;
      Support::insert($data);
      return back()->with('success','Ticket Created Successfully!'); 
   }

   public function statusChange(Request $request){
      try {
        $id=decrypt($request->id);
      }catch (DecryptException $e) {
         return response(['status'=>false,'msg'=>'Something went wrong'],200); 
      }
      
      $support=Support::where('id',$id)->first();
      $status=$support->status==1?2:1;
      $support->update(['status'=>$status]);
      
      $status=$status==1?'Open':'Closed';
      $id=encrypt($support->id);
      event(new \App\Events\StatusChanged(['id'=>$id,'status'=>$status,'title'=>$support->title,'user_id'=>$support->assigned_to]));
      
      return response(['status'=>true,'msg'=>'Status Changed Successfully!'],200); 
   }

   public function view($id){
      try {
      $id=decrypt($id);//die();
      }catch (DecryptException $e) {
         return back()->with('error','In Valid Payload'); 
      }
      $ticket=Support::with(['reply'])->where('id',$id)->first();
      return view('admin.support.view',compact('ticket'));  
   }
   public function reply(Request $request,$id){
      try {
        $id=decrypt($id);
      }catch (DecryptException $e) {
         return back()->with('error','In Valid Payload'); 
      }
       
      $rules = [
            'reply' => 'required',
        ];

      $validator = Validator::make($request->all(),$rules);
      if($validator->fails()){
         return back()->withErrors($validator->errors())->withInput();
      }

      $user=Auth::user();
      
      $data=[];
      $data['parent_id']=$id;
      $data['created_by']=$user->id;
      $data['assigned_to']=$user->id;
      $data['title']='-';
      $data['description']=$request->reply;
      $data['status']=2;
      Support::insert($data);
      return back()->with('success','Reply saved Successfully!');
   }
}

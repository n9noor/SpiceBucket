<?php

namespace App\Http\Controllers;

use App\Models\Mail as MailModel;  
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class MailController extends Controller
{
    use SoftDeletes;
    protected $dates = [ 'deleted_at' ];
    
    public function index(Request $request){
        
        try {
            //abort_if(Gate::denies('mail_index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
           $mails =  MailModel::orderBy('id','ASC')->get();
            
            return view('admin.mail.index',['title' => 'Mail - SpiceBucket Administrator','mails'=>$mails]);       
            
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
        
    }

    function add(){
        try {
            //abort_if(Gate::denies('mail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data=[];
            return view('admin.mail.add' , ['data'=>$data,'title' => 'Add Mail - SpiceBucket Administrator']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id){ 
        try {
          //  abort_if(Gate::denies('mail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data['id'] = $id;
            if($data['id'] != ''){
                $data['res'] = MailModel::where(DB::raw('md5(id)'), $id)->first();
                $data['id'] = $data['res']->id; 
            }
            return view('admin.mail.add' , ['data'=>$data,'title' => 'Edit Mail - SpiceBucket Administrator']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    function save(Request $request){ 
        
        try {
            
           // abort_if(Gate::denies('mail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            
            $data = $request->except('_method','_token','submit');
            
            $rules =  [ 
                'subject' => 'required|string|min:3|unique:mails,subject,'.$request->input('id').',id,deleted_at,NULL',
                'from_name' => 'required',
                'from_email' => 'required',
                'is_active' => 'required',
            ] ;
       
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->Back()->withInput()->withErrors($validator);
            }
         
            if($request->input('id') > 0){
            
                $data['updated_at'] = date('Y-m-d H:i:s');
                $wh['id'] = $data['id'];

                $response['status'] = "success";
                MailModel::where($wh)->update($data);
                Session::flash('message', 'Mail has been updated Successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                if($record = MailModel ::create($data)){
                    Session::flash('message', 'Mail has been  Successfully!');
                    Session::flash('alert-class', 'alert-success');
                } else {
                    Session::flash('message', 'Data not saved!');
                    Session::flash('alert-class', 'alert-danger');
                }
            }
            
            //   dd($data);die;
            return redirect("/administrator/mail");
            //$data['userList'] = UserModel::where(['user_type'=>'signage'])->get();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-success');
        }
    }
}
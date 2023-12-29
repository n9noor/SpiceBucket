<?php

namespace App\Http\Controllers;

use App\Models\Message ;  
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class MessageController extends Controller
{
    use SoftDeletes;
    protected $dates = [ 'deleted_at' ];
    
    public function index(Request $request){
        
        try {
            //abort_if(Gate::denies('message_index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
           $messages =  Message::orderBy('id','ASC')->get();
            
            return view('admin.message.index',['title' => 'Message - SpiceBucket Administrator','messages'=>$messages]);       
            
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
        
    }

    function add(){
        try {
            //abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data=[];
            return view('admin.message.add' , ['data'=>$data,'title' => 'Add Message - SpiceBucket Administrator']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id){ 
        try {
          //  abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data['id'] = $id;
            if($data['id'] != ''){
                $data['res'] = Message::where(DB::raw('md5(id)'), $id)->first();
                $data['id'] = $data['res']->id; 
            }
            return view('admin.message.add' , ['data'=>$data,'title' => 'Edit Message - SpiceBucket Administrator']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    function save(Request $request){ 
        
        try {
            
           // abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            
            $data = $request->except('_method','_token','submit');
            
            $rules =  [ 
                'subject' => 'required|string|min:3|unique:messages,subject,'.$request->input('id').',id,deleted_at,NULL',
                 
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
                Message::where($wh)->update($data);
                Session::flash('message', 'Message has been updated Successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                if($record = Message ::create($data)){
                    Session::flash('message', 'Message has been  Successfully!');
                    Session::flash('alert-class', 'alert-success');
                } else {
                    Session::flash('message', 'Data not saved!');
                    Session::flash('alert-class', 'alert-danger');
                }
            }
            
            //   dd($data);die;
            return redirect("/administrator/message");
            //$data['userList'] = UserModel::where(['user_type'=>'signage'])->get();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-success');
        }
    }
}
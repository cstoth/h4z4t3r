<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageUpdateRequest;
use App\Models\Messages;
use App\Http\Controllers\Controller;
use App\Helpers\Hazater;
use Illuminate\Http\Request;
use App\Models\Auth\User;

class MessagesController extends Controller
{

    /**
     *
     */
    public function list (Request $request) {
        $messages = [];

        if (Auth::check()) {
            // $msgs = Auth::user()->messages(); //Messages::where('to_user_id', Auth::user()->id);
            $messages = Messages::where('to_user_id', Auth::user()->id)->get();
            $unreads = Messages::where('to_user_id', Auth::user()->id)->where('readed', 0)->count();
            $messages = [
                'count' => count($messages),
                'unreads' => $unreads,
                'datas' => $messages,
            ];
        }

        return view('frontend.user.messages')->with([
            'messages' => $messages,
        ]);
    }

    // public function search()
    // {
    //     $data = Messages::all();
    //     return $data;
    // }

    // public function add()
    // {
    //     return view('messages/add');
    // }

    // public function addPost()
    // {
    //     $model_data = array(
    //         'to_user_id' => Input::get('to_user_id'),
    //         'subject' => Input::get('subject'),
    //         'message' => Input::get('message'),
    //     );
    //     $model_id = Messages::insert($model_data);
    //     return redirect('messages')->with('message', 'Messages successfully added');
    // }

    public function delete($id)
    {
        $model = Messages::find($id);
        if ($model) $model->delete();
        return redirect('dashboard')->with('message', 'Messages deleted successfully.');
    }

    // public function edit($id)
    // {
    //     $data['messages'] = Messages::find($id);
    //     return view('messages/edit', $data);
    // }

    // public function editPost()
    // {
    //     $id = Input::get('messages_id');
    //     $model = Messages::find($id);

    //     $model_data = array(
    //         'to_user_id' => Input::get('to_user_id'),
    //         'subject' => Input::get('subject'),
    //         'message' => Input::get('message'),
    //     );
    //     $model_id = Messages::where('id', '=', $id)->update($model_data);
    //     return redirect('messages')->with('message', 'Messages Updated successfully');
    // }

    // public function view($id)
    // {
    //     $data['messages'] = Messages::find($id);
    //     return view('messages/view', $data);
    // }

    /**
     *
     */
    public function get($id)
    {
        $model = Messages::find($id);
        if ($model) {
            $model['from_user'] = $model->fromUser->full_name;
            $model['to_user'] = $model->toUser->full_name;
            $model['route_label'] = $model->advertise->route_label;
        }
        return $model;
        // return [
        //     'id' => $model->id,
        //     'from_user_id' => $model->from_user_id,
        //     'from_user' => $model->fromUser->full_name,
        //     'to_user_id' => $model->to_user_id,
        //     'to_user' => $model->toUser->full_name,
        //     'advertise_id' => $model->advertise_id,
        //     'advertise' => $model->advertise->route_label,
        //     'subject' => $model->subject,
        //     'message' => $model->message,
        //     'created_at' => $model->created_at,
        // ];
    }

    /**
     *
     */
    public function read($id)
    {
        $model = Messages::find($id);
        if ($model) {
            $model->readed = true;
            $model->save();

            $model['from_user'] = $model->fromUser->full_name;
            $model['to_user'] = $model->toUser->full_name;
            $model['route_label'] = Hazater::routeLabel($model->advertise_id);
        }
        return $model;
        // return [
        //     'id' => $model->id,
        //     'from_user_id' => $model->from_user_id,
        //     'from_user' => $model->fromUser->full_name,
        //     'to_user_id' => $model->to_user_id,
        //     'to_user' => $model->toUser->full_name,
        //     'advertise_id' => $model->advertise_id,
        //     'advertise' => $model->advertise->route_label,
        //     'subject' => $model->subject,
        //     'message' => $model->message,
        //     'created_at' => $model->created_at,
        // ];
    }

    /**
     *
     */
    public function set(MessageUpdateRequest $request)
    {
        $param = $request->data;
        $id = $param['id'];

        $model = Messages::find($id);
        if ($model) {
            $model->fill($param)->save();
        } else {
            $model = new Messages;

            $model->from_user_id = Auth::user()->id;
            $model->to_user_id = $param['to_user_id'];
            $model->advertise_id = $param['advertise_id'];
            $model->subject = $param['subject'];
            $model->message = $param['message'];

            $model->save();
        }

        return $model;
    }


    /**
     *
     */
    public function search(Request $request)
    {
        $filter = Input::get('message-search');
        $messages = [];

        if (Auth::check()) {
            // $msgs = Auth::user()->messages(); //Messages::where('to_user_id', Auth::user()->id);
            $messages = Messages::where('to_user_id', Auth::user()->id);
            if ($filter) {
                $senders = User::select('id')->where('first_name', 'like', '%'.$filter.'%')->orWhere('last_name', 'like', '%'.$filter.'%')->get();
                //dd($senders);
                $messages = $messages->whereIn('from_user_id', $senders);
            }
            $messages = $messages->get();
            $unreads = Messages::where('to_user_id', Auth::user()->id)->where('readed', 0)->count();
            $messages = [
                'count' => count($messages),
                'unreads' => $unreads,
                'datas' => $messages,
                'filter' => $filter,
            ];
        }

        return view('frontend.user.messages')->with([
            'messages' => $messages,
        ]);

        //redirect()->route('frontend.messages.list');
    }
}

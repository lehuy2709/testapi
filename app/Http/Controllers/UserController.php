<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\UserUpdateRequest;
use App\Imports\UsersImport;
use App\Models\Classroom;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    //
    public function index()
    {
        // test Relations
        // $users = User::all();
        $users = User::select('id', 'name', 'code', 'email', 'role')
            ->where('id', '>=', 3)
            ->where('id', '<', 7)
            ->get();

        $userPaginate = User::select('id', 'name', 'code', 'email', 'role', 'avatar')
            ->with([
                'posts',
                'posts.classroom', // lấy thêm classroom theo từng post đó
                'classrooms'
            ]) // lấy thêm các bản ghi post theo id của user và classrooms  theo id
            ->paginate(5);

        return view('admin.user.list', compact('userPaginate'));
    }

    public function delete(User $user)
    {

        // cách 1 truyền id vào tham số của hàm
        //    if($id){
        //         $user = User::find($id);
        //         $posts = Post::where('user_id',$id)->get();
        //         // chạy qua toàn bộ post liên quan và update user_id

        //         // update relations cách 1

        //         // foreach($posts as $post){
        //         //     $post->update(['user_id'=>0]);
        //         // }

        //         //  // update relations cách 2

        //         // lấy ra 1 mảng id
        //         $postIds = $posts->pluck('id');
        //         Post::whereIn('id',$postIds)->update(['user_id'=>0]);
        //         $user->delete();
        //         // quay lại trang trước
        //         return redirect()->back();


        //    }
        // cách 2
        if ($user) {

            $posts = Post::where('user_id', $user->id)->get();

            $classrooms = Classroom::where('user_id', $user->id)->get();
            $classroomId = $classrooms->pluck('id');
            Classroom::whereIn('id', $classroomId)->update(['user_id' => 0]);

            // chạy qua toàn bộ post liên quan và update user_id

            // update relations cách 1

            // foreach($posts as $post){
            //     $post->update(['user_id'=>0]);
            // }

            //  // update relations cách 2

            // lấy ra 1 mảng id

            $postIds = $posts->pluck('id');

            Post::whereIn('id', $postIds)->update(['user_id' => 0]);
            $user->delete();
            // quay lại trang trước
            return redirect()->back()->with('noti_success', 'chuyển trang thành công');
        }
    }

    public function create()
    {
        return view('admin.user.create');
    }

    private function saveFile($file, $prefixName = '', $folder = 'public')
    {
        if ($file) {
            $fileName = $file->hashName();
            $fileName = isset($prefixName)
                ? $prefixName . '_' . $fileName
                : $fileName;

            return $file->storeAs($folder, $fileName);
        }
    }
    public function store(Request $request)
    {
        // định nghĩa các điều kiện validate
        $request->validate([
            'name' => 'required|min:6|max:50',
            'email' => 'required|min:6|email'
        ]);
        // nếu ko thỏa mãn sẽ redirect về form và kèm theo errors
        $user = new User();
        // 1. Match request lên có giống các trường trên db k
        $user->fill($request->all());

        // 2. Kiểm tra file và lưu
        if ($request->hasFile('avatar')) {
            // 2.1 xử lý tên file
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->username . '_' . $avatarName;


            // 2.2 Lưu file vào bộ nhớ
            // dd($avatar->storeAs('users/avatar',$avatarName));
            // 2.3 lấy đường dẫn gán vào cho $user
            $user->avatar = $avatar->storeAs('images/users', $avatarName);
            // lưu vào thư mục storages/app/images/users
            // * Cần link vào public để đọc ảnh => nên phải config ở trong file config/filesystem.php
        } else {
            $user->avatar = '';
        }
        $user->password = hash('md5', $request->password);
        $user->save();
        return redirect()->route('users.list');
        // 3. gán vào csdl
    }

    public function edit(User $user)
    {
        $title = 'Edit User';
        $nameButton = 'Save';
        return view('admin.user.create', compact('user', 'title', 'nameButton'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $input = $request->all();
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $request->username . '_' . $avatar->hashName();
            $input['avatar'] = $avatar->storeAs('images/users', $avatarName);
        }
        if ($request->password) {
            $user->password = hash('md5', $request->password);
        }

        $user->update($input);
        return redirect()->route('users.list');
    }

    public function update_role(Request $request, User $user)
    {
        if ($user->role == 1) {
            $user->role = 0;
        } else {
            $user->role = 1;
        }
        $user->update(['role' => $user->role]);
        return redirect()->back();
    }
    public function apiGetListUser()
    {
        $users = User::select('id', 'name', 'username')
            ->with('posts')
            ->paginate(3);
        return response()->json([
            'data' => $users
        ], 200);
    }

    public function formImport(){
        return view('admin.user.import');

    }

    public function storeImport(Request $request){
        $userAll = User::all();
        $file = $request->file('file');
        $users =  Excel::toCollection(new UsersImport,$file);
        $i = 0;
        foreach($users as $userUpdate){
           foreach($userUpdate as $u){
            User::where('id',$u)->update([
                'name' => $u[1]
            ]);
           }
        }
        // dd($users);

    }

    public function exportUser()
    {
        return new UsersExport;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class profileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $avatar = asset('public/upload/' . $admin->avatar);
        return view('profile.my_profile', ['admin' => $admin, 'avatar' => $avatar]);
    }

    public function changeProfile(Request $rq)
    {
        $file = $rq->file('image');
        //thực ra là khi truyền bằng axios kia nếu không chọn ảnh thì
        //server không nhận được file ảnh đó nên phải tách ra 2 trg hợp xem server có đọc đc ảnh
        //hay không nếu đọc đc ảnh thì move_upload còn không thì chỉ thay đổi các cột khác
        if (isset($file)) {
            $typeAllow = ['JPG', 'GIF', 'PNG', 'JPEG', 'TIFF'];
            if (in_array(strtoupper($file->getClientOriginalExtension()), $typeAllow)) {
                if ($file->getSize() <= 5242880) {
                    $admin = Auth::guard('admin')->user();
                    // check xem admin này có ảnh không nếu có ảnh thì xóa ảnh cũ trong
                    //public/upload update ảnh mới
                    if (File::exists(public_path() . '/upload/' . $admin->avatar)) {
                        File::delete(public_path() . '/upload/' . $admin->avatar);
                    }
                    // tên file ảnh đại diện phải không trùng bất kì tên file ảnh nào khác nên
                    // sẽ nối với time() nhưng k đc nối với id vì các trình duyệt khi
                    // tải trang sẽ lưu vào cache nên nếu đuôi file ảnh mới up lên
                    // mà giống với đuôi file ảnh cũng thì nó sẽ không đổi ảnh
                    $file_name = time() . '.' . $file->getClientOriginalExtension();
                    $file->move('public/upload', $file_name);
                    $rq->offsetSet('avatar', $file_name);
                    Admin::find($admin->id)->update($rq->all());
                    $profile = ['full_name' => $rq->full_name, 'avatar' => asset('public/upload/' . $file_name)];
                    return response()->json($profile);
                } else {
                    return "Dung lượng ảnh quá quy định";
                }
            } else {
                return "Đây không phải là file ảnh";
            }
        } else {
            $id = Auth::guard('admin')->user()->id;
            Admin::find($id)->update($rq->all());
            $profile = ['full_name' => $rq->full_name, 'avatar' => ''];
            return response()->json($profile);
        }
    }

    public function changePassword(Request $rq)
    {
        try {
            $admin = Admin::find(Auth::guard('admin')->user()->id)->update(['password' => bcrypt($rq->password)]);
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }
}

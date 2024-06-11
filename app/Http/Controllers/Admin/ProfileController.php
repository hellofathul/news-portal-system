<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Requests\AdminUpdatePasswordRequest;

class ProfileController extends Controller
{

    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard("admin")->user();
        return view("admin.profile.index", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileUpdateRequest $request, string $id)
    {
        // Handle image uploads
        $imagePath = $this->handleFileUpload($request, "image", $request->old_image);

        // Update data
        $admin = Admin::findOrFail($id);
        $admin->image = ! empty($imagePath) ? $imagePath : $request->old_image;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();
        toast(__('Updated successfully!'),'success')->width("300");
        return redirect()->back();
    }

    /**
     * Update password
     */
    public function updatePassword(AdminUpdatePasswordRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->password = bcrypt($request->password);
        $admin->save();
        toast(__('Updated successfully!'),'success')->width("300");
        return redirect()->back();
    }
}

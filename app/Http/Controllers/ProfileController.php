<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Hiển thị trang chỉnh sửa thông tin cá nhân.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Cập nhật thông tin cá nhân.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $user = $request->user();
            $validatedData = $request->validated();

            // Nếu email thay đổi, đặt lại trạng thái xác minh
            if ($user->email !== $validatedData['email']) {
                $validatedData['email_verified_at'] = null;
            }

            $user->update($validatedData);

            return Redirect::route('profile.edit')->with('success', 'Cập nhật thông tin thành công');
        } catch (\Exception $e) {
            return Redirect::route('profile.edit')->with('error', 'Lỗi khi cập nhật thông tin: ' . $e->getMessage());
        }
    }

    /**
     * Xóa tài khoản người dùng.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            // Bắt đầu transaction để đảm bảo xóa tài khoản an toàn
            DB::transaction(function () use ($user, $request) {
                Auth::logout();
                $user->delete();

                $request->session()->invalidate();
                $request->session()->regenerateToken();
            });

            return Redirect::to('/')->with('success', 'Tài khoản của bạn đã bị xóa');
        } catch (\Exception $e) {
            return Redirect::route('profile.edit')->with('error', 'Lỗi khi xóa tài khoản: ' . $e->getMessage());
        }
    }
}

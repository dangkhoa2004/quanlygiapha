<?php

namespace App\Http\Controllers;

use App\Services\SocialService;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    protected $socialService;

    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }

    /**
     * Hiển thị danh sách bài đăng
     */
    public function index()
    {
        try {
            $posts = $this->socialService->getAllPosts();
            return view('social.index', compact('posts'));
        } catch (\Exception $e) {
            return redirect()->route('social.index')->with('error', 'Lỗi khi tải danh sách bài đăng: ' . $e->getMessage());
        }
    }

    /**
     * Thêm bài đăng mới
     */
    public function store(Request $request)
    {
        try {
            $this->socialService->createPost($request);
            return redirect()->route('social.index')->with('success', 'Bài đăng đã được tạo');
        } catch (\Exception $e) {
            return redirect()->route('social.index')->with('error', 'Lỗi khi tạo bài đăng: ' . $e->getMessage());
        }
    }

    /**
     * Xóa bài đăng
     */
    public function destroy($id)
    {
        try {
            $this->socialService->deletePost($id);
            return redirect()->route('social.index')->with('success', 'Bài đăng đã bị xóa');
        } catch (\Exception $e) {
            return redirect()->route('social.index')->with('error', 'Lỗi khi xóa bài đăng: ' . $e->getMessage());
        }
    }
}

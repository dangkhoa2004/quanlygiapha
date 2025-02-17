<?php

namespace App\Services;

use App\Models\SocialComment;
use App\Models\SocialPost;
use Illuminate\Http\Request;

class SocialService
{
    /**
     * Lấy tất cả bài đăng
     */
    public function getAllPosts()
    {
        return SocialPost::with('comments')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Lấy danh sách bài đăng của một thành viên
     */
    public function getPostsByMember($memberId)
    {
        return SocialPost::where('member_id', $memberId)->with('comments')->get();
    }

    /**
     * Tạo bài đăng mới
     */
    public function createPost(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|exists:members,id',
            'content' => 'required|string',
            'media' => 'nullable|string',
        ]);

        $post = SocialPost::create($validatedData);

        return response()->json(['message' => 'Bài đăng đã được tạo', 'data' => $post], 201);
    }

    /**
     * Xóa bài đăng
     */
    public function deletePost($id)
    {
        $post = SocialPost::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Bài đăng đã bị xóa'], 200);
    }

    /**
     * Thêm bình luận vào bài đăng
     */
    public function addComment(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required|exists:social_posts,id',
            'member_id' => 'required|exists:members,id',
            'comment' => 'required|string',
        ]);

        $comment = SocialComment::create($validatedData);

        return response()->json(['message' => 'Bình luận đã được thêm', 'data' => $comment], 201);
    }

    /**
     * Xóa bình luận
     */
    public function deleteComment($id)
    {
        $comment = SocialComment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Bình luận đã bị xóa'], 200);
    }
}

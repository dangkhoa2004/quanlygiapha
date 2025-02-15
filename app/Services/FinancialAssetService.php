<?php

namespace App\Services;

use App\Models\FinancialAsset;
use Illuminate\Http\Request;

class FinancialAssetService
{
    /**
     * Lấy tất cả tài sản tài chính
     */
    public function getAllAssets()
    {
        return FinancialAsset::all();
    }

    /**
     * Lấy tài sản của một thành viên
     */
    public function getAssetsByMember($memberId)
    {
        return FinancialAsset::where('owner_id', $memberId)->get();
    }

    /**
     * Lấy tài sản theo ID
     */
    public function getAssetById($id)
    {
        return FinancialAsset::findOrFail($id);
    }

    /**
     * Tạo mới tài sản
     */
    public function createAsset(Request $request)
    {
        $validatedData = $request->validate([
            'owner_id' => 'required|exists:members,id',
            'asset_name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'details' => 'nullable|string',
        ]);

        $asset = FinancialAsset::create($validatedData);
        return response()->json(['message' => 'Tài sản đã được thêm', 'data' => $asset], 201);
    }

    /**
     * Cập nhật tài sản
     */
    public function updateAsset(Request $request, $id)
    {
        $validatedData = $request->validate([
            'asset_name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'details' => 'nullable|string',
        ]);

        $asset = FinancialAsset::findOrFail($id);
        $asset->update($validatedData);

        return response()->json(['message' => 'Tài sản đã được cập nhật', 'data' => $asset], 200);
    }

    /**
     * Xóa tài sản
     */
    public function deleteAsset($id)
    {
        $asset = FinancialAsset::findOrFail($id);
        $asset->delete();

        return response()->json(['message' => 'Tài sản đã bị xóa'], 200);
    }
}

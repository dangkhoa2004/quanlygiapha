<?php

namespace App\Http\Controllers;

use App\Services\FinancialAssetService;
use Illuminate\Http\Request;

class FinancialAssetController extends Controller
{
    protected $financialAssetService;

    public function __construct(FinancialAssetService $financialAssetService)
    {
        $this->financialAssetService = $financialAssetService;
    }

    /**
     * Hiển thị danh sách tài sản tài chính
     */
    public function index()
    {
        try {
            $assets = $this->financialAssetService->getAllAssets();
            return view('financialassets.index', compact('assets'));
        } catch (\Exception $e) {
            return redirect()->route('financialassets.index')->with('error', 'Lỗi khi tải danh sách tài sản: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị form tạo tài sản
     */
    public function create()
    {
        return view('financialassets.create');
    }

    /**
     * Lưu tài sản mới
     */
    public function store(Request $request)
    {
        try {
            $this->financialAssetService->createAsset($request);
            return redirect()->route('financialassets.index')->with('success', 'Tài sản được thêm thành công');
        } catch (\Exception $e) {
            return redirect()->route('financialassets.create')->with('error', 'Lỗi khi tạo tài sản: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị form chỉnh sửa tài sản
     */
    public function edit($id)
    {
        try {
            $asset = $this->financialAssetService->getAssetById($id);
            return view('financialassets.edit', compact('asset'));
        } catch (\Exception $e) {
            return redirect()->route('financialassets.index')->with('error', 'Không tìm thấy tài sản');
        }
    }

    /**
     * Cập nhật tài sản
     */
    public function update(Request $request, $id)
    {
        try {
            $this->financialAssetService->updateAsset($request, $id);
            return redirect()->route('financialassets.index')->with('success', 'Cập nhật tài sản thành công');
        } catch (\Exception $e) {
            return redirect()->route('financialassets.edit', ['id' => $id])->with('error', 'Lỗi khi cập nhật tài sản: ' . $e->getMessage());
        }
    }

    /**
     * Xóa tài sản
     */
    public function destroy($id)
    {
        try {
            $this->financialAssetService->deleteAsset($id);
            return redirect()->route('financialassets.index')->with('success', 'Tài sản đã bị xóa');
        } catch (\Exception $e) {
            return redirect()->route('financialassets.index')->with('error', 'Lỗi khi xóa tài sản: ' . $e->getMessage());
        }
    }
}

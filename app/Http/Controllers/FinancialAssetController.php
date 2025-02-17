<?php

namespace App\Http\Controllers;

use App\Services\FinancialAssetService;
use Illuminate\Http\Request;

class FinancialAssetController extends Controller
{
    protected $financialervice;

    public function __construct(FinancialAssetService $financialervice)
    {
        $this->financialervice = $financialervice;
    }

    /**
     * Hiển thị danh sách tài sản tài chính
     */
    public function index()
    {
        try {
            $assets = $this->financialervice->getAllAssets();
            return view('financial.index', compact('assets'));
        } catch (\Exception $e) {
            return redirect()->route('financial.index')->with('error', 'Lỗi khi tải danh sách tài sản: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị form tạo tài sản
     */
    public function create()
    {
        return view('financial.create');
    }

    /**
     * Lưu tài sản mới
     */
    public function store(Request $request)
    {
        try {
            $this->financialervice->createAsset($request);
            return redirect()->route('financial.index')->with('success', 'Tài sản được thêm thành công');
        } catch (\Exception $e) {
            return redirect()->route('financial.create')->with('error', 'Lỗi khi tạo tài sản: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị form chỉnh sửa tài sản
     */
    public function edit($id)
    {
        try {
            $asset = $this->financialervice->getAssetById($id);
            return view('financial.edit', compact('asset'));
        } catch (\Exception $e) {
            return redirect()->route('financial.index')->with('error', 'Không tìm thấy tài sản');
        }
    }

    /**
     * Cập nhật tài sản
     */
    public function update(Request $request, $id)
    {
        try {
            $this->financialervice->updateAsset($request, $id);
            return redirect()->route('financial.index')->with('success', 'Cập nhật tài sản thành công');
        } catch (\Exception $e) {
            return redirect()->route('financial.edit', ['id' => $id])->with('error', 'Lỗi khi cập nhật tài sản: ' . $e->getMessage());
        }
    }

    /**
     * Xóa tài sản
     */
    public function destroy($id)
    {
        try {
            $this->financialervice->deleteAsset($id);
            return redirect()->route('financial.index')->with('success', 'Tài sản đã bị xóa');
        } catch (\Exception $e) {
            return redirect()->route('financial.index')->with('error', 'Lỗi khi xóa tài sản: ' . $e->getMessage());
        }
    }
}

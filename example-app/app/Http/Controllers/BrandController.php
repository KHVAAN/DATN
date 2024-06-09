<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.chinh-sua-chung', [
            'type' => 'nhãn hiệu',
            'updateRoute' => route('cap-nhat-nhan-hieu', ['id' => $brand->id]),
            'nameField' => 'tennhanhieu',
            'item' => $brand
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'tennhanhieu' => 'required|max:30|unique:brand,tennhanhieu,' . $id,
                'trangthai' => 'required',
            ],
            [
                'trangthai.required' => 'Không được để trống',
                'tennhanhieu.unique' => 'Tên nhãn hiệu sản phẩm đã tồn tại',
                'tennhanhieu.max' => 'Không quá 30 ký tự',
                'tennhanhieu.required' => 'Không được để trống'
            ]
        );

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        alert()->success('Thành công', 'Cập nhật nhãn hiệu thành công');
        return \redirect()->back();
    }
    public function destroy(string $id)
    {
        Brand::destroy($id);
        alert()->success('Thành công', 'Xóa sản phẩm thành công');
        return redirect()->back();
    }
}

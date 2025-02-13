# Laravel Family Tree Management System

## **I. Quá trình triển khai cơ sở dữ liệu**

### **1. Cài đặt Laravel**
```sh
composer create-project --prefer-dist laravel/laravel quanlygiapha
cd quanlygiapha
```

### **2. Cấu hình môi trường**
- Sao chép file `.env.example` thành `.env`
```sh
cp .env.example .env
```
- Cấu hình thông tin database trong `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=family_tree
DB_USERNAME=root
DB_PASSWORD=
```

### **3. Cài đặt Authentication**
```sh
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

---

## **II. Quá trình tạo Migration và Controller**

### **1. Tạo Migration cho bảng `members`**
```sh
php artisan make:model Member -m
```

Mở `database/migrations/YYYY_MM_DD_create_members_table.php` và chỉnh sửa:
```php
public function up() {
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->date('birth_date')->nullable();
        $table->date('death_date')->nullable();
        $table->enum('gender', ['male', 'female'])->default('male');
        $table->text('bio')->nullable();
        $table->string('photo')->nullable();
        $table->timestamps();
    });
}
```

Chạy migrate:
```sh
php artisan migrate
```

### **2. Tạo Controller `MemberController`**
```sh
php artisan make:controller MemberController --resource
```

Mở `app/Http/Controllers/MemberController.php` và chỉnh sửa:
```php
namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller {
    public function index() {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create() {
        return view('members.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        Member::create($data);
        return redirect()->route('members.index')->with('success', 'Thành viên được thêm thành công');
    }
}
```

---

## **III. Thiết lập Routes**
Mở file `routes/web.php` và thêm:
```php
use App\Http\Controllers\MemberController;

Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
});

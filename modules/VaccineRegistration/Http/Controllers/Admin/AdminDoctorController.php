<?php

namespace Modules\VaccineRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\SafeImageFile;
use App\Services\AuditLogger;
use Illuminate\Http\Request;
use Modules\VaccineRegistration\Models\Center;
use Modules\VaccineRegistration\Models\Doctor;
use Modules\VaccineRegistration\Support\AdminContext;

class AdminDoctorController extends Controller
{
    /**
     * Danh sách bác sĩ & nhân sự y tế
     */
    public function index(Request $request)
    {
        $currentCenterId = AdminContext::currentCenterId();
        $isSuperAdmin = AdminContext::isSuperAdmin();

        $query = Doctor::with('center');

        // Phân quyền theo chi nhánh nếu không phải Super Admin
        if (!$isSuperAdmin && $currentCenterId) {
            $query->where('center_id', $currentCenterId);
        } elseif ($request->filled('center_id')) {
            $query->where('center_id', $request->input('center_id'));
        }

        // Tìm kiếm theo tên hoặc số điện thoại
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Lọc trạng thái hoạt động
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        $doctors = $query->orderBy('center_id', 'asc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(15)
            ->withQueryString();

        $centers = Center::active()->orderBy('sort_order', 'asc')->get();

        if ($request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'html' => view('vaccine::admin.doctors._table', compact('doctors', 'isSuperAdmin'))->render(),
            ]);
        }

        return view('vaccine::admin.doctors.index', compact('doctors', 'centers', 'isSuperAdmin', 'currentCenterId'));
    }

    /**
     * Form thêm mới bác sĩ / nhân sự
     */
    public function create()
    {
        $doctor = new Doctor([
            'is_active' => true,
            'sort_order' => 0,
            'center_id' => AdminContext::currentCenterId(),
        ]);

        $centers = Center::active()->orderBy('sort_order', 'asc')->get();

        return view('vaccine::admin.doctors.create', compact('doctor', 'centers'));
    }

    /**
     * Lưu bác sĩ / nhân sự mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'center_id' => 'required|exists:centers,id',
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:100',
            'role' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'bio' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'avatar_url' => 'nullable|string|max:500',
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048', new SafeImageFile],
            'is_active' => 'nullable',
        ]);

        // Xử lý upload avatar
        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = 'doctor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destPath = public_path('images/doctors');
            if (!file_exists($destPath)) {
                @mkdir($destPath, 0755, true);
            }
            $file->move($destPath, $filename);
            $validated['avatar'] = '/images/doctors/' . $filename;
        } elseif (!empty($validated['avatar_url'])) {
            $validated['avatar'] = $validated['avatar_url'];
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        unset($validated['avatar_file'], $validated['avatar_url']);

        $doctor = Doctor::create($validated);

        AuditLogger::log('doctor.created', 'doctor', $doctor->id, null, $doctor->toArray(), $doctor->center_id);

        return redirect()->route('admin.doctors.index', ['center_id' => $doctor->center_id])
            ->with('success', 'Thêm bác sĩ / nhân sự mới thành công.');
    }

    /**
     * Form chỉnh sửa
     */
    public function edit(Doctor $doctor)
    {
        $centers = Center::active()->orderBy('sort_order', 'asc')->get();

        return view('vaccine::admin.doctors.edit', compact('doctor', 'centers'));
    }

    /**
     * Cập nhật thông tin bác sĩ
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'center_id' => 'required|exists:centers,id',
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:100',
            'role' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'bio' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'avatar_url' => 'nullable|string|max:500',
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048', new SafeImageFile],
            'is_active' => 'nullable',
        ]);

        $oldValues = $doctor->toArray();

        // Xử lý upload avatar
        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = 'doctor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destPath = public_path('images/doctors');
            if (!file_exists($destPath)) {
                @mkdir($destPath, 0755, true);
            }
            $file->move($destPath, $filename);
            $validated['avatar'] = '/images/doctors/' . $filename;
        } elseif (!empty($validated['avatar_url'])) {
            $validated['avatar'] = $validated['avatar_url'];
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        unset($validated['avatar_file'], $validated['avatar_url']);

        $doctor->update($validated);

        AuditLogger::log('doctor.updated', 'doctor', $doctor->id, $oldValues, $doctor->toArray(), $doctor->center_id);

        return redirect()->route('admin.doctors.index', ['center_id' => $doctor->center_id])
            ->with('success', "Cập nhật thông tin bác sĩ {$doctor->name} thành công.");
    }

    /**
     * Bật/tắt trạng thái hiển thị
     */
    public function toggleStatus(Request $request, Doctor $doctor)
    {
        $doctor->is_active = !$doctor->is_active;
        $doctor->save();

        AuditLogger::log('doctor.toggle_status', 'doctor', $doctor->id, null, ['is_active' => $doctor->is_active], $doctor->center_id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'is_active' => $doctor->is_active,
                'message' => 'Đã cập nhật trạng thái hoạt động.',
            ]);
        }

        return back()->with('success', 'Đã cập nhật trạng thái hoạt động.');
    }

    /**
     * Xóa bác sĩ
     */
    public function destroy(Doctor $doctor)
    {
        $centerId = $doctor->center_id;
        $name = $doctor->name;
        $oldValues = $doctor->toArray();

        $doctor->delete();

        AuditLogger::log('doctor.deleted', 'doctor', $doctor->id, $oldValues, null, $centerId);

        return redirect()->route('admin.doctors.index', ['center_id' => $centerId])
            ->with('success', "Đã xóa bác sĩ / nhân sự {$name}.");
    }
}

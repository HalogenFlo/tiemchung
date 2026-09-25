@extends('vaccine::layouts.admin')

@section('title', 'Chỉnh Sửa Bác Sĩ - Medicare')
@section('page_title', 'Chỉnh Sửa Bác Sĩ / Nhân Sự Chi Nhánh')

@section('admin_content')
<div class="card-modern" style="max-width: 900px; margin: 0 auto;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; border-bottom: 1px solid var(--border-color); padding-bottom: 16px;">
        <div>
            <h2 style="font-family: var(--font-display); font-size: 19px; font-weight: 800; color: var(--text-primary); margin: 0 0 4px 0;">
                Chỉnh Sửa: {{ $doctor->name }}
            </h2>
            <p style="font-size: 13.5px; color: var(--text-muted); margin: 0;">
                Cập nhật thông tin chuyên môn, chi nhánh cơ sở hoặc ảnh đại diện bác sĩ.
            </p>
        </div>
        <a href="{{ route('admin.doctors.index', ['center_id' => $doctor->center_id]) }}" class="btn-modern btn-modern-secondary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i> Quay lại
        </a>
    </div>

    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('vaccine::admin.doctors._form', ['doctor' => $doctor, 'centers' => $centers])

        <div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('admin.doctors.index', ['center_id' => $doctor->center_id]) }}" class="btn-modern btn-modern-secondary" style="text-decoration: none;">
                Hủy bỏ
            </a>
            <button type="submit" class="btn-modern btn-modern-primary" style="display: inline-flex; align-items: center; gap: 8px;">
                <i data-lucide="save" style="width: 18px; height: 18px;"></i> Cập Nhật Bác Sĩ
            </button>
        </div>
    </form>
</div>
@endsection

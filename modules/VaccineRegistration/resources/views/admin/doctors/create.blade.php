@extends('vaccine::layouts.admin')

@section('title', 'Thêm Bác Sĩ Mới - Medicare')
@section('page_title', 'Thêm Bác Sĩ / Nhân Sự Chi Nhánh')

@section('admin_content')
<div class="card-modern" style="max-width: 900px; margin: 0 auto;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; border-bottom: 1px solid var(--border-color); padding-bottom: 16px;">
        <div>
            <h2 style="font-family: var(--font-display); font-size: 19px; font-weight: 800; color: var(--text-primary); margin: 0 0 4px 0;">
                Bổ Sung Nhân Sự Y Tế Cho Chi Nhánh
            </h2>
            <p style="font-size: 13.5px; color: var(--text-muted); margin: 0;">
                Nhập thông tin bác sĩ, cử nhân, y sĩ hoặc điều dưỡng cho cơ sở tiêm chủng.
            </p>
        </div>
        <a href="{{ route('admin.doctors.index') }}" class="btn-modern btn-modern-secondary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i> Quay lại
        </a>
    </div>

    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('vaccine::admin.doctors._form', ['doctor' => $doctor, 'centers' => $centers])

        <div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('admin.doctors.index') }}" class="btn-modern btn-modern-secondary" style="text-decoration: none;">
                Hủy bỏ
            </a>
            <button type="submit" class="btn-modern btn-modern-primary" style="display: inline-flex; align-items: center; gap: 8px;">
                <i data-lucide="save" style="width: 18px; height: 18px;"></i> Lưu Bác Sĩ
            </button>
        </div>
    </form>
</div>
@endsection

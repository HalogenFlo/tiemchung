@extends('vaccine::layouts.admin')

@section('title', 'Quản lý Bác Sĩ & Nhân Sự - Medicare')
@section('page_title', 'Quản Lý Bác Sĩ & Nhân Sự Y Tế')

@section('admin_content')
<div class="card-modern">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-family: var(--font-display); font-size: 19px; font-weight: 800; color: var(--text-primary); margin: 0 0 4px 0;">
                Danh Sách Bác Sĩ & Nhân Sự Theo Chi Nhánh
            </h2>
            <p style="font-size: 13.5px; color: var(--text-muted); margin: 0;">
                Điều chỉnh, bổ sung và phân bổ đội ngũ bác sĩ, điều dưỡng, chuyên gia y tế cho từng cơ sở tiêm chủng.
            </p>
        </div>
        <a href="{{ route('admin.doctors.create') }}" class="btn-modern btn-modern-primary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
            <i data-lucide="user-plus" style="width: 18px; height: 18px;"></i> Thêm Bác Sĩ / Nhân Sự
        </a>
    </div>

    <!-- Thanh lọc & tìm kiếm -->
    <form method="GET" action="{{ route('admin.doctors.index') }}" class="vaccine-filter-form" style="display:flex; gap:12px; align-items:flex-end; margin-bottom:20px; flex-wrap:wrap; background: #f8fafc; padding: 16px; border-radius: 10px; border: 1px solid var(--border-color);">
        @if($isSuperAdmin)
        <div style="flex: 1 1 200px;">
            <label class="form-label-modern" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; color: #475569;">Chi Nhánh Cơ Sở</label>
            <select name="center_id" class="form-control-modern" onchange="this.form.submit()">
                <option value="">-- Tất cả chi nhánh --</option>
                @foreach($centers as $c)
                    <option value="{{ $c->id }}" {{ request('center_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif

        <div style="flex: 2 1 220px;">
            <label class="form-label-modern" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; color: #475569;">Tìm kiếm</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tên bác sĩ, chuyên môn, SĐT..." class="form-control-modern">
        </div>

        <div style="flex: 1 1 130px;">
            <label class="form-label-modern" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; color: #475569;">Trạng thái</label>
            <select name="is_active" class="form-control-modern" onchange="this.form.submit()">
                <option value="">Tất cả</option>
                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Đang hoạt động</option>
                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Tạm dừng</option>
            </select>
        </div>

        <div style="display: flex; gap: 8px; align-items: flex-end;">
            <button type="submit" class="btn-modern btn-modern-primary" style="height: 42px;">
                <i data-lucide="filter" style="width: 16px; height: 16px;"></i> Lọc
            </button>
            @if(request()->hasAny(['search', 'center_id', 'is_active']))
                <a href="{{ route('admin.doctors.index') }}" class="btn-modern btn-modern-secondary" style="height: 42px; display: inline-flex; align-items: center; text-decoration: none;">
                    Xóa lọc
                </a>
            @endif
        </div>
    </form>

    <div id="doctorsTableContainer">
        @include('vaccine::admin.doctors._table', ['doctors' => $doctors, 'isSuperAdmin' => $isSuperAdmin])
    </div>
</div>
@endsection

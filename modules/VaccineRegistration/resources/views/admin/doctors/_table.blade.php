@if($doctors->isEmpty())
    <div style="text-align: center; padding: 48px 24px; color: var(--text-muted); background: #f8fafc; border-radius: 12px; margin-top: 16px;">
        <i data-lucide="stethoscope" style="width: 48px; height: 48px; margin-bottom: 12px; color: #94a3b8; stroke-width: 1.5;"></i>
        <p style="font-size: 15px; font-weight: 500; margin: 0;">Chưa tìm thấy bác sĩ hoặc nhân sự y tế phù hợp.</p>
    </div>
@else
    <div class="table-responsive-modern" style="border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; background: #ffffff;">
        <table class="table-modern" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 1px solid var(--border-color);">
                    <th style="width: 60px; text-align: center; padding: 14px 12px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">STT</th>
                    <th style="width: 70px; text-align: center; padding: 14px 12px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">Ảnh</th>
                    <th style="padding: 14px 16px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">Họ & Tên</th>
                    <th style="padding: 14px 16px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">Chuyên môn / Chức danh</th>
                    <th style="padding: 14px 16px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">Chi Nhánh</th>
                    <th style="padding: 14px 16px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">Số Điện Thoại</th>
                    <th style="width: 80px; text-align: center; padding: 14px 12px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">Thứ tự</th>
                    <th style="width: 120px; text-align: center; padding: 14px 12px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">Trạng thái</th>
                    <th style="width: 160px; text-align: right; padding: 14px 16px; font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 700;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $index => $doctor)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;">
                        <td style="text-align: center; color: var(--text-muted); font-size: 13px; font-weight: 600;">
                            {{ $doctors->firstItem() + $index }}
                        </td>
                        <td style="text-align: center; padding: 10px 8px;">
                            <img src="{{ $doctor->avatar_url }}" alt="{{ $doctor->name }}" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0; display: inline-block;">
                        </td>
                        <td style="padding: 12px 16px;">
                            <div style="font-weight: 700; color: #0f172a; font-size: 14.5px;">{{ $doctor->name }}</div>
                            @if(!empty($doctor->title))
                                <span style="display: inline-block; background: #e0f2fe; color: #0369a1; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px; margin-top: 4px;">{{ $doctor->title }}</span>
                            @endif
                        </td>
                        <td style="padding: 12px 16px; color: #334155; font-size: 13.5px; font-weight: 500;">
                            {{ $doctor->role ?: 'Nhân viên y tế' }}
                        </td>
                        <td style="padding: 12px 16px;">
                            @if($doctor->center)
                                <span style="display: inline-flex; align-items: center; gap: 4px; font-size: 12.5px; font-weight: 700; color: var(--accent-color); background: rgba(0, 75, 143, 0.08); padding: 4px 10px; border-radius: 6px;">
                                    <i data-lucide="map-pin" style="width: 13px; height: 13px;"></i>
                                    {{ $doctor->center->name }}
                                </span>
                            @else
                                <span style="color: var(--text-muted); font-size: 12px;">Toàn hệ thống</span>
                            @endif
                        </td>
                        <td style="padding: 12px 16px; font-size: 13px; color: #475569;">
                            @if(!empty($doctor->phone))
                                <a href="tel:{{ $doctor->phone }}" style="color: var(--accent-color); text-decoration: none; font-weight: 600;">
                                    {{ $doctor->phone }}
                                </a>
                            @else
                                <span style="color: #94a3b8;">—</span>
                            @endif
                        </td>
                        <td style="text-align: center; font-weight: 600; color: #64748b; font-size: 13px;">
                            {{ $doctor->sort_order }}
                        </td>
                        <td style="text-align: center;">
                            <form action="{{ route('admin.doctors.toggle-status', $doctor) }}" method="POST" style="display: inline; margin: 0;">
                                @csrf
                                <button type="submit" style="background: none; border: none; cursor: pointer; padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; {{ $doctor->is_active ? 'background: #dcfce7; color: #15803d;' : 'background: #fee2e2; color: #b91c1c;' }}">
                                    <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                                    {{ $doctor->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right; padding: 12px 16px;">
                            <div style="display: inline-flex; align-items: center; gap: 8px;">
                                <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn-action-edit" title="Chỉnh sửa" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #f1f5f9; color: #0f172a; text-decoration: none; transition: all 0.15s ease;">
                                    <i data-lucide="edit-3" style="width: 15px; height: 15px;"></i>
                                </a>
                                <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bác sĩ / nhân sự \'{{ $doctor->name }}\' khỏi chi nhánh này không?');" style="display: inline; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-delete" title="Xóa" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fee2e2; color: #dc2626; border: none; cursor: pointer; transition: all 0.15s ease;">
                                        <i data-lucide="trash-2" style="width: 15px; height: 15px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
        <div style="font-size: 13.5px; color: var(--text-muted);">
            Hiển thị <strong>{{ $doctors->firstItem() }}</strong> - <strong>{{ $doctors->lastItem() }}</strong> trong tổng số <strong>{{ $doctors->total() }}</strong> nhân sự y tế
        </div>
        <div>
            {{ $doctors->links() }}
        </div>
    </div>
@endif

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
    <!-- Chi nhánh cơ sở -->
    <div class="form-group-modern">
        <label for="center_id" class="form-label-modern" style="font-weight: 700;">
            Chi nhánh cơ sở <span style="color: var(--primary-color);">*</span>
        </label>
        <select name="center_id" id="center_id" class="form-control-modern" required>
            <option value="">-- Chọn chi nhánh cơ sở --</option>
            @foreach($centers as $c)
                <option value="{{ $c->id }}" {{ (old('center_id', $doctor->center_id) == $c->id) ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
        @error('center_id')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Học hàm / Học vị -->
    <div class="form-group-modern">
        <label for="title" class="form-label-modern" style="font-weight: 700;">
            Học hàm / Học vị viết tắt
        </label>
        <input type="text" name="title" id="title" class="form-control-modern" 
               value="{{ old('title', $doctor->title) }}" 
               placeholder="Ví dụ: BS.CK1, BS.CK2, ThS.BS, BS, CN, YS, ĐD">
        <span style="font-size: 11.5px; color: var(--text-muted); margin-top: 4px; display: block;">
            Dùng làm huy hiệu tóm tắt nhanh trên hồ sơ bác sĩ.
        </span>
        @error('title')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Họ và tên đầy đủ -->
    <div class="form-group-modern" style="grid-column: 1 / -1;">
        <label for="name" class="form-label-modern" style="font-weight: 700;">
            Họ và tên bác sĩ / nhân sự <span style="color: var(--primary-color);">*</span>
        </label>
        <input type="text" name="name" id="name" class="form-control-modern" 
               value="{{ old('name', $doctor->name) }}" 
               placeholder="Ví dụ: BS.CK1 Lê Thị Bé Tua hoặc CN. Nguyễn Thị Lan Vy" required>
        @error('name')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Chức danh / Vị trí chuyên môn -->
    <div class="form-group-modern">
        <label for="role" class="form-label-modern" style="font-weight: 700;">
            Chức danh / Vị trí chuyên môn
        </label>
        <input type="text" name="role" id="role" class="form-control-modern" 
               value="{{ old('role', $doctor->role) }}" 
               placeholder="Ví dụ: Bác sĩ chuyên môn tiêm chủng, Giám đốc chuyên môn...">
        @error('role')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Số điện thoại / Hotline -->
    <div class="form-group-modern">
        <label for="phone" class="form-label-modern" style="font-weight: 700;">
            Số điện thoại / Zalo tư vấn
        </label>
        <input type="text" name="phone" id="phone" class="form-control-modern" 
               value="{{ old('phone', $doctor->phone) }}" 
               placeholder="Ví dụ: 0938 603 839">
        @error('phone')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Thứ tự hiển thị -->
    <div class="form-group-modern">
        <label for="sort_order" class="form-label-modern" style="font-weight: 700;">
            Thứ tự ưu tiên hiển thị
        </label>
        <input type="number" name="sort_order" id="sort_order" class="form-control-modern" 
               value="{{ old('sort_order', $doctor->sort_order ?? 0) }}" min="0">
        <span style="font-size: 11.5px; color: var(--text-muted); margin-top: 4px; display: block;">
            Số nhỏ hơn sẽ đứng trước (1 đứng trước 2).
        </span>
        @error('sort_order')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email -->
    <div class="form-group-modern">
        <label for="email" class="form-label-modern" style="font-weight: 700;">
            Email liên hệ (nếu có)
        </label>
        <input type="email" name="email" id="email" class="form-control-modern" 
               value="{{ old('email', $doctor->email) }}" 
               placeholder="bacsi@medicare.vn">
        @error('email')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Ảnh đại diện -->
    <div class="form-group-modern" style="grid-column: 1 / -1; background: #f8fafc; padding: 18px; border-radius: 10px; border: 1px dashed var(--border-color);">
        <label class="form-label-modern" style="font-weight: 700;">Ảnh đại diện bác sĩ</label>
        
        <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
            @if($doctor->avatar)
                <div style="text-align: center;">
                    <img src="{{ $doctor->avatar_url }}" alt="{{ $doctor->name }}" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 2px solid #cbd5e1;">
                    <div style="font-size: 11px; color: var(--text-muted); margin-top: 4px;">Ảnh hiện tại</div>
                </div>
            @endif

            <div style="flex: 1 1 260px;">
                <label style="font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">Tải file ảnh mới từ máy tính:</label>
                <input type="file" name="avatar_file" accept="image/*" class="form-control-modern" style="padding: 8px;">
                <span style="font-size: 11.5px; color: var(--text-muted); margin-top: 4px; display: block;">Hỗ trợ JPEG, PNG, JPG, WEBP tối đa 2MB.</span>
            </div>

            <div style="flex: 1 1 260px;">
                <label style="font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">Hoặc đường dẫn ảnh (URL):</label>
                <input type="text" name="avatar_url" value="{{ old('avatar_url', $doctor->avatar) }}" placeholder="/images/avt_pktn.png hoặc https://..." class="form-control-modern">
            </div>
        </div>
        @error('avatar_file')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Tóm tắt tiểu sử -->
    <div class="form-group-modern" style="grid-column: 1 / -1;">
        <label for="bio" class="form-label-modern" style="font-weight: 700;">
            Tóm tắt quá trình công tác / chuyên môn
        </label>
        <textarea name="bio" id="bio" rows="3" class="form-control-modern" 
                  placeholder="Kinh nghiệm khám sàng lọc, đào tạo y khoa, chứng chỉ an toàn tiêm chủng...">{{ old('bio', $doctor->bio) }}</textarea>
        @error('bio')
            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Trạng thái hoạt động -->
    <div class="form-group-modern" style="grid-column: 1 / -1;">
        <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; user-select: none;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $doctor->is_active ?? true) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: var(--primary-color);">
            <span style="font-size: 14.5px; font-weight: 700; color: #1e293b;">Kích hoạt hiển thị bác sĩ / nhân sự này trên website</span>
        </label>
    </div>
</div>

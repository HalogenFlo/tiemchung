<?php

namespace Modules\VaccineRegistration\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_id',
        'name',
        'title',
        'role',
        'avatar',
        'phone',
        'email',
        'bio',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Quan hệ tới chi nhánh / trung tâm tiêm chủng
     */
    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    /**
     * Scope lọc bác sĩ / nhân sự đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope sắp xếp theo thứ tự
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Scope lọc theo chi nhánh
     */
    public function scopeForCenter($query, $centerId)
    {
        if ($centerId) {
            return $query->where('center_id', $centerId);
        }
        return $query;
    }

    /**
     * Ảnh đại diện hiển thị an toàn
     */
    public function getAvatarUrlAttribute(): string
    {
        if (!empty($this->avatar)) {
            if (str_starts_with($this->avatar, 'http') || str_starts_with($this->avatar, 'data:')) {
                return $this->avatar;
            }
            return asset(ltrim($this->avatar, '/'));
        }

        return asset('images/logo.png');
    }
}

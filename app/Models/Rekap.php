<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rekap extends Model
{
    use SoftDeletes;

    protected $table = 'rekap';

    protected $fillable = [
        'bencana_id',
        'format1_form4_id',
        'format2_form4_id',
        'format3_form4_id',
        'format4_form4_id',
        'format5_form4_id',
        'format6_form4_id',
        'format7_form4_id',
        'format8_form4_id',
        'format9_form4_id',
        'format10_form4_id',
        'format11_form4_id',
        'format12_form4_id',
        'format13_form4_id',
        'format14_form4_id',
        'format15_form4_id',
        'format16_form4_id',
        'format17_form4_id',
        'nama_kampung',
        'nama_distrik',
        'catatan',
        'total_kerusakan',
        'total_kerugian',
        'status',
    ];

    protected $casts = [
        'total_kerusakan' => 'decimal:2',
        'total_kerugian' => 'decimal:2',
        'status' => 'string',
    ];

    protected $dates = [
        'deleted_at',
    ];

    /**
     * Relationship to Bencana
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }

    /**
     * Relationship to Format1Form4
     */
    public function format1Form4(): BelongsTo
    {
        return $this->belongsTo(Format1Form4::class, 'format1_form4_id');
    }

    /**
     * Relationship to Format5Form4
     */
    public function format5Form4(): BelongsTo
    {
        return $this->belongsTo(Format5Form4::class, 'format5_form4_id');
    }

    /**
     * Relationship to Format6Form4
     */
    public function format6Form4(): BelongsTo
    {
        return $this->belongsTo(Format6Form4::class, 'format6_form4_id');
    }

    /**
     * Relationship to Format7Form4
     */
    public function format7Form4(): BelongsTo
    {
        return $this->belongsTo(Format7Form4::class, 'format7_form4_id');
    }

    /**
     * Get all format relationships (when models exist)
     */
    public function getFormatRelationships()
    {
        $formats = [];
        
        for ($i = 1; $i <= 17; $i++) {
            $formatIdColumn = "format{$i}_form4_id";
            $modelClass = "App\\Models\\Format{$i}Form4";
            
            if ($this->$formatIdColumn && class_exists($modelClass)) {
                $formats[$i] = $modelClass::find($this->$formatIdColumn);
            }
        }
        
        return $formats;
    }

    /**
     * Get filled formats count
     */
    public function getFilledFormatsCount(): int
    {
        $count = 0;
        
        for ($i = 1; $i <= 17; $i++) {
            $formatIdColumn = "format{$i}_form4_id";
            if ($this->$formatIdColumn) {
                $count++;
            }
        }
        
        return $count;
    }

    /**
     * Get completion percentage
     */
    public function getCompletionPercentage(): float
    {
        return round(($this->getFilledFormatsCount() / 17) * 100, 2);
    }

    /**
     * Check if specific format is filled
     */
    public function hasFormat(int $formatNumber): bool
    {
        $formatIdColumn = "format{$formatNumber}_form4_id";
        return !is_null($this->$formatIdColumn);
    }

    /**
     * Get location string
     */
    public function getLocationAttribute(): string
    {
        return $this->nama_kampung . ', ' . $this->nama_distrik;
    }

    /**
     * Scope for specific bencana
     */
    public function scopeForBencana($query, $bencanaId)
    {
        return $query->where('bencana_id', $bencanaId);
    }

    /**
     * Scope for specific status
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for location
     */
    public function scopeInLocation($query, $kampung, $distrik)
    {
        return $query->where('nama_kampung', $kampung)
                    ->where('nama_distrik', $distrik);
    }

    /**
     * Update status based on filled formats
     */
    public function updateStatusBasedOnCompletion()
    {
        $filledCount = $this->getFilledFormatsCount();
        
        if ($filledCount === 0) {
            $this->status = 'draft';
        } elseif ($filledCount < 17) {
            $this->status = 'draft';
        } else {
            $this->status = 'completed';
        }
        
        $this->save();
    }

    /**
     * Calculate total kerusakan from all formats
     */
    public function calculateTotalKerusakan(): float
    {
        $total = 0;
        
        // Format 1 - Perumahan dan Pemukiman
        if ($this->format1Form4) {
            $total += $this->format1Form4->grand_total ?? 0;
        }
        
        // Format 5 - Sektor Keagamaan
        if ($this->format5Form4) {
            $total += $this->format5Form4->total_kerusakan_bangunan ?? 0;
        }
        
        // Format 6 - Sarana dan Prasarana Air Minum & Sanitasi
        if ($this->format6Form4) {
            $total += $this->format6Form4->total_kerusakan_air_minum ?? 0;
            $total += $this->format6Form4->total_kerusakan_sanitasi ?? 0;
        }
        
        // Format 7 - Transportasi
        if ($this->format7Form4) {
            $total += $this->format7Form4->total_kerusakan_infrastruktur ?? 0;
        }
        
        return $total;
    }

    /**
     * Calculate total kerugian from all formats
     */
    public function calculateTotalKerugian(): float
    {
        $total = 0;
        
        // Format 1 - Perumahan dan Pemukiman
        if ($this->format1Form4) {
            // Sudah termasuk dalam grand_total, jadi skip untuk menghindari double counting
        }
        
        // Format 5 - Sektor Keagamaan
        if ($this->format5Form4) {
            $total += $this->format5Form4->total_kerugian_peralatan ?? 0;
            $total += $this->format5Form4->total_biaya_pembersihan ?? 0;
        }
        
        // Format 6 - Sarana dan Prasarana Air Minum & Sanitasi
        if ($this->format6Form4) {
            $total += $this->format6Form4->total_kerugian ?? 0;
        }
        
        // Format 7 - Transportasi
        if ($this->format7Form4) {
            $total += $this->format7Form4->total_kehilangan_pendapatan ?? 0;
            $total += $this->format7Form4->total_kenaikan_biaya_operasional ?? 0;
            $total += $this->format7Form4->total_biaya_infrastruktur_darurat ?? 0;
        }
        
        return $total;
    }

    /**
     * Update calculated totals
     */
    public function updateCalculatedTotals()
    {
        $this->total_kerusakan = $this->calculateTotalKerusakan();
        $this->total_kerugian = $this->calculateTotalKerugian();
        $this->save();
    }

    /**
     * Get status badge class for UI
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'draft' => 'badge-secondary',
            'completed' => 'badge-success',
            'verified' => 'badge-primary',
            default => 'badge-light'
        };
    }

    /**
     * Get status label for UI
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'draft' => 'Draft',
            'completed' => 'Completed',
            'verified' => 'Verified',
            default => 'Unknown'
        };
    }
}

<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Day extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'days';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function daysDoctors()
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function daysPharmacies()
    {
        return $this->belongsToMany(Pharmacy::class);
    }
}

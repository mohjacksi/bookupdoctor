<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Cite extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'cites';

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

    public function cityPharmacies()
    {
        return $this->hasMany(Pharmacy::class, 'city_id', 'id');
    }

    public function cityDoctors()
    {
        return $this->hasMany(Doctor::class, 'city_id', 'id');
    }
}

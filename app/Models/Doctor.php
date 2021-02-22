<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Doctor extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'doctors';
    protected $hidden = ['media', 'image'];

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'expiration_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone_number',
        'about',
        'location',
        'stars',
        'is_special',
        'is_active',
        'expiration_date',
        'latitude',
        'longitude',
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $columns = [
        'name',
        'phone_number',
        'about',
        'location',
        'stars',
        'is_special',
        'is_active',
        'expiration_date',
        'latitude',
        'longitude',
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ]; // add all columns from you table

    public function scopeExclude($query, $value = [])
    {
        return $query->select(array_diff($this->columns, (array) $value));
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function doctorPortfolios()
    {
        return $this->hasMany(Portfolio::class, 'doctor_id', 'id');
    }

    public function doctorPayments()
    {
        return $this->hasMany(Payment::class, 'doctor_id', 'id');
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function days()
    {
        return $this->belongsToMany(Day::class)
        ->withPivot(['morning', 'evening']);
    }

    public function getExpirationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setExpirationDateAttribute($value)
    {
        $this->attributes['expiration_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}

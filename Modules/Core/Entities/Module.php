<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Module extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    const ENABLED = 1;

    CONST DISABLED = 0;

    protected $fillable = ['name', 'status'];

    protected $appends = ['status_text'];

    public function getStatusTextAttribute()
    {
        return $this->status ? 'Enable' : "Disable";
    }

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\ModuleFactory::new();
    }

}

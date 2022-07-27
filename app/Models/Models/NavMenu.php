<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    use HasFactory;

    protected $table = "nav_menu";

    const TABLE_NAME = "nav_menu";

    const ID = "id";
    const TITLE = "title";
    const URL = "url";
    const URL_TARGET = "url_target";
    const NAV_TYPE = "nav_type";
    const POSITION = "position";
    const STATUS = "status";
    const CREATED_BY = "created_by";
    const CREATED_AT = "created_at";
    const UPDATED_BY = "updated_by";
    const UPDATED_AT = "updated_at";
}

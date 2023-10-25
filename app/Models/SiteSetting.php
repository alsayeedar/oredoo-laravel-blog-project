<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = "site_settings";

    protected $fillable = [
        "site_title",
        "tagline",
        "description",
        "logo_dark",
        "logo_light",
        "copyright_text",
        "enable_registration",
    ];

    protected $casts = [
        "enable_registration" => "boolean",
    ];
}

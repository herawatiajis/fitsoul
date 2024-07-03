<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'phone',
        'subject',
        'message',
    ];
    }


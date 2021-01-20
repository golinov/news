<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NewsView extends Pivot
{
    protected $table = 'users_news';
}

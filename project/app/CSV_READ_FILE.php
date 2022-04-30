<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CSV_READ_FILE extends Model
{
    //
    protected $table = "csv_read_files";

    protected $primaryKey = "id";
    protected $fillable = ['file_name','read_date_time'];
}

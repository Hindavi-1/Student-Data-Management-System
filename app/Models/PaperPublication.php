<?php
// app/Models/PaperPublication.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperPublication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'authors',
        'abstract',
        'journal_name',
        'publisher',
        'doi',
        'publication_date',
        'document_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

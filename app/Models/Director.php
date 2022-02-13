<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Director
 *
 * @property int $id
 * @property string $name
 * @property int $tmdb_id
 * @property string $biography
 * @property string $date_of_birth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movie[] $movies
 * @property-read int|null $movies_count
 * @method static \Illuminate\Database\Eloquent\Builder|Director newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Director newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Director query()
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereTmdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Director extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id', 'name', 'biography', 'date_of_birth'];

    public function movies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_director');
    }
}

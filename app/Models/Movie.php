<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Movie
 *
 * @property int $id
 * @property int $tmdb_id
 * @property string $title
 * @property string $release_date
 * @property string|null $overview
 * @property string|null $poster_path
 * @property string|null $poster_url
 * @property float|null $tmdb_vote_average
 * @property int|null $tmdb_vote_count
 * @property string|null $tmdb_url
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Director[] $directors
 * @property-read int|null $directors_count
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie wherePosterPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie wherePosterUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTmdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTmdbUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTmdbVoteAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTmdbVoteCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'title',
        'release_date',
        'overview',
        'poster_path',
        'poster_url',
        'tmdb_vote_average',
        'tmdb_vote_count',
        'tmdb_url',
        'order'
    ];

    /**
     * @return BelongsToMany
     */
    public function directors(): BelongsToMany
    {
        return $this->belongsToMany(Director::class, 'movie_director');
    }

    /**
     * @return BelongsToMany
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    /**
     * Generate viewable url for the movie's poster.
     * If you change something here, the MovieTest unit test should be changed too!
     * @param string $imagePath
     * @return string
     */
    public static function generatePosterUrl(string $imagePath): string
    {
        return config('movie.poster_url_base'). $imagePath;
    }

    /**
     * Generate The Movie Databse url for the movie
     * If you change something here, the MovieTest unit test should be changed too!
     * @param int $id
     * @return string
     */
    public static function generateUrl(int $id): string
    {
        return config('movie.movie_url_base') . $id;
    }
}

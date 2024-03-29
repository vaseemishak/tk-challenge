<?php

namespace App\Http\Controllers\Api;

use App\Models\Song\Category;
use App\Models\Song\Song;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SongController extends Controller
{

    /**
     * SongController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth.api']);
    }

    /**
     * Category List
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function categories(Request $request)
    {
        return $this->response(Category::all(), 200, __('Song category list'));
    }

    /**
     * Song list with category id
     *
     * @param Request $request
     * @param $categoryId
     * @return JsonResponse
     */
    public function listWithCategory(Request $request, $categoryId)
    {
        return $this->response(Song::filterByCategory($categoryId)->paginate(10));
    }


    /**
     * Favorite song, current device session
     *
     * @param Request $request
     * @param $songId
     * @return JsonResponse
     */
    public function favorite(Request $request, $songId)
    {
        event('device.song.favorite.before', $request, $songId);

        $userCollection = $request->attributes->get('api.user');

        $favoriteCollection = clone $userCollection->favorites();

        $favoriteEntity = $favoriteCollection->findByDeviceIdAndSongId($userCollection->id, $songId)
            ->withTrashed()
            ->first();

        /**
         * If Has $favoriteEntity restore
         */
        if ($favoriteEntity) {

            $favoriteEntity->restore();

        } else {

            $favoriteEntity = $request->attributes->get('api.user')
                ->favorites()
                ->create([
                    'song_id' => $songId,
                    'device_id' => $request->attributes->get('api.user')->id
                ]);

        }

        event('device.song.favorite.after', $request, $favoriteEntity);

        return $this->response($favoriteEntity, 201, __('Song favorite created'));
    }

    /**
     * Unfavorite song, current device session
     *
     * @param Request $request
     * @param $songId
     * @return JsonResponse
     */
    public function unfavorite(Request $request, $songId)
    {
        event('device.song.unfavorite.before', $request, $songId);

        $favoriteEntity = $request->attributes->get('api.user')
            ->favorites()
            ->findByDeviceIdAndSongId($request->attributes->get('api.user')->id, $songId)
            ->first();

        /**
         * If has $favoriteEntity soft delete
         */
        if ($favoriteEntity)
        {
            $favoriteEntity->delete();
        }

        event('device.song.unfavorite.after', $request, $favoriteEntity);

        return $this->response($favoriteEntity, 204, __('Song favorite deleted'));
    }
}

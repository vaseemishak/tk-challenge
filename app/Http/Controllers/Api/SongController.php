<?php

namespace App\Http\Controllers\Api;

use App\Models\Song\Category;
use App\Models\Song\Song;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories(Request $request)
    {
        return $this->response(Category::all(), 200, __('Song category list'));
    }

    /**
     * Song list with category id
     *
     * @param Request $request
     * @param $category_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function listWithCategory(Request $request, $category_id)
    {
        return $this->response(Song::filterByCategory($category_id)->paginate(10));
    }


    /**
     * Favorite song, current device session
     *
     * @param Request $request
     * @param $song_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function favorite(Request $request, $song_id)
    {
        event('device.song.favorite.before', $request, $song_id);

        $data = $request->attributes->get('api.user')
            ->favorite()
            ->create([
                'song_id' => $song_id,
                'device_id' => $request->attributes->get('api.user')->id
            ]);

        event('device.song.favorite.after', $request, $data);

        return $this->response($data, 201, __('Song favorite created'));
    }

    /**
     * Unfavorite song, current device session
     *
     * @param Request $request
     * @param $song_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfavorite(Request $request, $song_id)
    {
        event('device.song.unfavorite.before', $request, $song_id);

        $data = $request->attributes->get('api.user')
            ->favorite()
            ->findByDeviceAndSongId($request->attributes->get('api.user')->id, $song_id)
            ->delete();

        event('device.song.unfavorite.after', $request, $data);

        return $this->response($data, 204, __('Song favorite deleted'));
    }
}

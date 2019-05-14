<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateroomImagesRequest;
use App\Http\Requests\UpdateroomImagesRequest;
use App\Repositories\roomImagesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class roomImagesController extends AppBaseController
{
    /** @var  roomImagesRepository */
    private $roomImagesRepository;

    public function __construct(roomImagesRepository $roomImagesRepo)
    {
        $this->roomImagesRepository = $roomImagesRepo;
    }

    /**
     * Display a listing of the roomImages.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->roomImagesRepository->pushCriteria(new RequestCriteria($request));
        $roomImages = $this->roomImagesRepository->all();

        return view('room_images.index')
            ->with('roomImages', $roomImages);
    }

    /**
     * Show the form for creating a new roomImages.
     *
     * @return Response
     */
    public function create()
    {
        return view('room_images.create');
    }

    /**
     * Store a newly created roomImages in storage.
     *
     * @param CreateroomImagesRequest $request
     *
     * @return Response
     */
    public function store(CreateroomImagesRequest $request)
    {
        $input = $request->all();

        $roomImages = $this->roomImagesRepository->create($input);

        Flash::success('Room Images saved successfully.');

        return redirect(route('roomImages.index'));
    }

    /**
     * Display the specified roomImages.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roomImages = $this->roomImagesRepository->findWithoutFail($id);

        if (empty($roomImages)) {
            Flash::error('Room Images not found');

            return redirect(route('roomImages.index'));
        }

        return view('room_images.show')->with('roomImages', $roomImages);
    }

    /**
     * Show the form for editing the specified roomImages.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roomImages = $this->roomImagesRepository->findWithoutFail($id);

        if (empty($roomImages)) {
            Flash::error('Room Images not found');

            return redirect(route('roomImages.index'));
        }

        return view('room_images.edit')->with('roomImages', $roomImages);
    }

    /**
     * Update the specified roomImages in storage.
     *
     * @param  int              $id
     * @param UpdateroomImagesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateroomImagesRequest $request)
    {
        $roomImages = $this->roomImagesRepository->findWithoutFail($id);

        if (empty($roomImages)) {
            Flash::error('Room Images not found');

            return redirect(route('roomImages.index'));
        }

        $roomImages = $this->roomImagesRepository->update($request->all(), $id);

        Flash::success('Room Images updated successfully.');

        return redirect(route('roomImages.index'));
    }

    /**
     * Remove the specified roomImages from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $roomImages = $this->roomImagesRepository->findWithoutFail($id);

        if (empty($roomImages)) {
            Flash::error('Room Images not found');

            return redirect(route('roomImages.index'));
        }

        $this->roomImagesRepository->delete($id);

        Flash::success('Room Images deleted successfully.');

        return redirect(route('roomImages.index'));
    }
}

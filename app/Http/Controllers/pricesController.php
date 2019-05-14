<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepricesRequest;
use App\Http\Requests\UpdatepricesRequest;
use App\Repositories\pricesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Routing\Controller as BaseController;

class pricesController extends BaseController
{
    /** @var  pricesRepository */
    private $pricesRepository;

    public function __construct(pricesRepository $pricesRepo)
    {
        $this->pricesRepository = $pricesRepo;
    }

    /**
     * Display a listing of the prices.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pricesRepository->pushCriteria(new RequestCriteria($request));
        $prices = $this->pricesRepository->all();

        return view('prices.index')
            ->with('prices', $prices);
    }

    /**
     * Show the form for creating a new prices.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $room_id = $request->room_id ;

        return view('prices.create')->with('room_id',$room_id) ;
    }

    /**
     * Store a newly created prices in storage.
     *
     * @param CreatepricesRequest $request
     *
     * @return Response
     */
    public function store(CreatepricesRequest $request)
    {
        $input = $request->all();
        $input["icon"] = "/assets/imgs/people-$request->players.png" ;
        $prices = $this->pricesRepository->create($input);

        Flash::success('Prices saved successfully.');

        return redirect("/admin/rooms/$request->room_id/edit");
    }

    /**
     * Display the specified prices.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $prices = $this->pricesRepository->findWithoutFail($id);

        if (empty($prices)) {
            Flash::error('Prices not found');

            return redirect(route('prices.index'));
        }

        return view('prices.show')->with('prices', $prices);
    }

    /**
     * Show the form for editing the specified prices.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $prices = $this->pricesRepository->findWithoutFail($id);

        if (empty($prices)) {
            Flash::error('Prices not found');

            return redirect(route('prices.index'));
        }

        return view('prices.edit')->with(['prices' => $prices, 'room_id' => $prices->room_id]);
    }

    /**
     * Update the specified prices in storage.
     *
     * @param  int              $id
     * @param UpdatepricesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepricesRequest $request)
    {
        $prices = $this->pricesRepository->findWithoutFail($id);

        if (empty($prices)) {
            Flash::error('Prices not found');

            return redirect(route('prices.index'));
        }

        $prices = $this->pricesRepository->update($request->all(), $id);

        Flash::success('Prices updated successfully.');

        return redirect(route('prices.index'));
    }

    /**
     * Remove the specified prices from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $prices = $this->pricesRepository->findWithoutFail($id);

        if (empty($prices)) {
            Flash::error('Prices not found');

            return redirect(route('prices.index'));
        }

        $this->pricesRepository->delete($id);

        Flash::success('Prices deleted successfully.');

        return back();
    }
}

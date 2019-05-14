<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreategustbookRequest;
use App\Http\Requests\UpdategustbookRequest;
use App\Repositories\gustbookRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\gustbook;
use Illuminate\Routing\Controller as BaseController;

class gustbookController extends BaseController
{
    /** @var  gustbookRepository */
    private $gustbookRepository;

    public function __construct(gustbookRepository $gustbookRepo)
    {
        $this->gustbookRepository = $gustbookRepo;
    }

    /**
     * Display a listing of the gustbook.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->gustbookRepository->pushCriteria(new RequestCriteria($request));
        $gustbooks = $this->gustbookRepository->paginate(20);

        return view('gustbooks.index')
            ->with('gustbooks', $gustbooks);
    }


    public function siteGustBook($page = 0)
    {
        $gusts = gustbook::where('status', 1)->orderBy('id', 'desc')->paginate(24);
        return view('home.gusts')
            ->with('gusts', $gusts);
    }

    /**
     * Show the form for creating a new gustbook.
     *
     * @return Response
     */
    public function create()
    {
        return view('gustbooks.create');
    }

    /**
     * Store a newly created gustbook in storage.
     *
     * @param CreategustbookRequest $request
     *
     * @return Response
     */
    public function store(CreategustbookRequest $request)
    {
        $input = $request->all();
        if ($request->has('image')) {
            $image = $request->file('image');
            $filename = '-gust-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image'] = $filename;
        }
        $gustbook = $this->gustbookRepository->create($input);

        Flash::success('Gustbook saved successfully.');

        return redirect(route('gustbooks.index'));
    }

    /**
     * Display the specified gustbook.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gustbook = $this->gustbookRepository->findWithoutFail($id);

        if (empty($gustbook)) {
            Flash::error('Gustbook not found');

            return redirect(route('gustbooks.index'));
        }

        return view('gustbooks.show')->with('gustbook', $gustbook);
    }

    /**
     * Show the form for editing the specified gustbook.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gustbook = $this->gustbookRepository->findWithoutFail($id);

        if (empty($gustbook)) {
            Flash::error('Gustbook not found');

            return redirect(route('gustbooks.index'));
        }

        return view('gustbooks.edit')->with('gustbook', $gustbook);
    }

    /**
     * Update the specified gustbook in storage.
     *
     * @param  int $id
     * @param UpdategustbookRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategustbookRequest $request)
    {
        $gustbook = $this->gustbookRepository->findWithoutFail($id);

        if (empty($gustbook)) {
            Flash::error('Gustbook not found');

            return redirect(route('gustbooks.index'));
        }

        $gustbook = $this->gustbookRepository->update($request->all(), $id);

        Flash::success('Gustbook updated successfully.');

        return redirect(route('gustbooks.index'));
    }

    /**
     * Remove the specified gustbook from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gustbook = $this->gustbookRepository->findWithoutFail($id);

        if (empty($gustbook)) {
            Flash::error('Gustbook not found');

            return redirect(route('gustbooks.index'));
        }

        $this->gustbookRepository->delete($id);

        Flash::success('Gustbook deleted successfully.');

        return redirect(route('gustbooks.index'));
    }
}

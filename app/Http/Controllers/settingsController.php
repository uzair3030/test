<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesettingsRequest;
use App\Http\Requests\UpdatesettingsRequest;
use App\Repositories\settingsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;


class settingsController extends BaseController
{
    /** @var  settingsRepository */
    private $settingsRepository;

    public function __construct(settingsRepository $settingsRepo)
    {
        $this->settingsRepository = $settingsRepo;
    }

    /**
     * Display a listing of the settings.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->settingsRepository->pushCriteria(new RequestCriteria($request));
        $settings = $this->settingsRepository->all();

        return view('settings.index', compact('settings'))->with(['controller' => $this]);
    }

    /**
     * Show the form for creating a new settings.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created settings in storage.
     *
     * @param CreatesettingsRequest $request
     *
     * @return Response
     */
    public function store(CreatesettingsRequest $request)
    {
        $input = $request->all();

        $settings = $this->settingsRepository->create($input);

        Flash::success('Settings saved successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified settings.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $settings = $this->settingsRepository->findWithoutFail($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        return view('settings.show')->with('settings', $settings);
    }

    /**
     * Show the form for editing the specified settings.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $settings = $this->settingsRepository->findWithoutFail($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        return view('settings.edit')->with('settings', $settings);
    }

    /**
     * Update the specified settings in storage.
     *
     * @param  int $id
     * @param UpdatesettingsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesettingsRequest $request)
    {
        $settings = $this->settingsRepository->findWithoutFail($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        $settings = $this->settingsRepository->update($request->all(), $id);

        Flash::success('Settings updated successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified settings from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $settings = $this->settingsRepository->findWithoutFail($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        $this->settingsRepository->delete($id);

        Flash::success('Settings deleted successfully.');

        return redirect(route('settings.index'));
    }

    public function updateSystemSetting(Request $request, $code)
    {
        if ($code == "contactUs_image" or $code == "homeSlider_1" or $code == "homeSlider_2" or $code == "homeSlider_3" or $code == "homeSlider_4" or $code == "homeSlider_5" or $code == "homeSlider_6" or $code == "home_video") {
            $image = $request["content"];
            $filename = $code . '_' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/settings');
            $image->move($destinationPath, $filename);
            DB::table('system_settings')
                ->where('code', '=', $code)
                ->update(['content' => $filename]);
        } else {


            DB::table('system_settings')
                ->where('code', '=', $code)
                ->update(['content' => $request["content"]]);
        }
        Flash::success('Settings updated successfully.');

        return redirect(route('settings.index'));
    }

    public static function getSystemSetting($what)
    {
        $system_setting = DB::table('system_settings')
            ->where('code', '=', $what)
            ->first();
        return $system_setting->content;
    }
}

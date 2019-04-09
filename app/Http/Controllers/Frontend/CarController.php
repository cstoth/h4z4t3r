<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Models\Advertise;

class CarController extends Controller {

    public function list() {
        return view('frontend.user.pages.driver.cars')->with([
            'cars' => Auth::user()->cars()->get(),
        ]);
    }

    public function delete($id) {
        $cnt = Advertise::where('status', Advertise::ACTIVE)->where('car_id', $id)->count();
        if ($cnt > 0) {
            return redirect()->route('frontend.user.driver.cars')->withFlashDanger('A gépjármű nem törölhető, mert jelenleg aktív hirdetésben szerepel!');
        }
        $car = Car::find($id);
        if ($car) {
            $car->status = Car::DELETED;
            $car->save();
            return redirect()->route('frontend.user.driver.cars')->withFlashSuccess(__('alerts.backend.car.deleted'));
        }
        return redirect()->route('frontend.user.driver.cars')->withFlashDanger('A gépjármű nem található!');
    }

    /**
     *
     */
    public function get($id) {
        $model = Car::find($id);
        $model['user'] = $model->user->full_name;
        return $model;
    }

    /**
     *
     */
    public function set(CarUpdateRequest $request) {
        $param = $request->data;
        $id = $param['id'];

        $model = Car::find($id);
        if ($model) {
            $model->fill($param)->save();
        } else {
            $model = new Car;

            $model->user_id = Auth::user()->id;
            $model->license = $param['license'];
            $model->type = $param['type'];
            $model->seats = $param['seats'];
            $model->brand = $param['brand'];
            $model->color = $param['color'];
            $model->year = $param['year'];
            $model->image = $param['image'];
            $model->image = $param['image2'];
            $model->smoke = $param['smoke'];
            $model->cooler = $param['cooler'];
            $model->pet = $param['pet'];
            $model->bag = $param['bag'];

            $model->save();
        }

        return redirect()->route('frontend.user.driver.cars')->withFlashSuccess(__('alerts.backend.car.updated'));
    }

    public function deleteImage($id) {
    }
}

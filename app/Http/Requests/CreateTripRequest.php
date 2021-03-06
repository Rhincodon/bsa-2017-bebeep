<?php

namespace App\Http\Requests;

use App\User;
use Carbon\Carbon;
use App\Models\Trip;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Requests\CreateTripRequest as CreateTripRequestInterface;

class CreateTripRequest extends FormRequest implements CreateTripRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $minStartAt = Carbon::now()->addSeconds(Trip::MIN_DELAY_TO_START_DATE)->timestamp;

        return [
            'price' => 'required',
            'seats' => 'required|integer|min:0|max_seats_from_vehicle:'.$this->get('vehicle_id'),
            'start_at' => 'required|integer|greater_than_date:'.$minStartAt,
            'end_at' => 'required|integer|greater_than_date:'.$this->get('start_at'),
            'from' => 'required|array',
            'to' => 'required|array',
            'vehicle_id' => [
                'required',
                'integer',
                Rule::exists('vehicles', 'id')->where(function ($query) {
                    $query->where([
                        'user_id' => Auth::user()->id,
                    ]);
                }),
            ],
        ];
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return (float) $this->get('price');
    }

    /**
     * @return int
     */
    public function getSeats(): int
    {
        return (int) $this->get('seats');
    }

    /**
     * @return Carbon
     */
    public function getStartAt(): Carbon
    {
        return Carbon::createFromTimestampUTC($this->get('start_at'));
    }

    /**
     * @return Carbon
     */
    public function getEndAt(): Carbon
    {
        return Carbon::createFromTimestampUTC($this->get('end_at'));
    }

    /**
     * @return int
     */
    public function getVehicleId(): int
    {
        return $this->get('vehicle_id');
    }

    /**
     * @return array
     */
    public function getFrom(): array
    {
        return (array) $this->get('from');
    }

    /**
     * @return array
     */
    public function getTo(): array
    {
        return (array) $this->get('to');
    }
}

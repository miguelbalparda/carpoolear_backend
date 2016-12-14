<?php namespace STS\Entities;

use Illuminate\Database\Eloquent\Model;
use STS\Entities\Passenger;

class Trip extends Model {
	const FINALIZADO 	= 0;
    const ACTIVO 		= 1;

	const PRIVACY_PUBLIC = 2;
	const PRIVACY_FRIENDS = 0;
	const PRIVACY_FOF = 1;

	protected $table = 'trips';
	protected $fillable = [
		'user_id',
		'from_town', 
		'to_town', 
		'trip_date',
		'description',
		'total_seats',
		'friendship_type_id',
		'is_active',
		'distance',
		'estimated_time',
		'co2',
		'es_recurrente',
		'esta_carpooleado',
		'tripscol',
		'es_pasajero',
		'mail_send'
	];
	protected $hidden = [];
	protected $appends = ['passenger_count', 'seats_available', 'is_driver'];
	protected $casts = [
        'es_pasajero' => 'boolean',
		'es_recurrente' => 'boolean',
		'esta_carpooleado' => 'boolean',
		'is_active' => 'boolean'
    ];

	public function user() {
        return $this->belongsTo('STS\User','user_id');
    }


	public function passenger() {
        return $this->hasMany('STS\Entities\Passenger','trip_id')->with("user");
    } 

	public function passengerAccepted() {
		return $this->passenger()->whereRequestState(Passenger::STATE_ACEPTADO);
	}

	public function passengerPending() {
		return $this->passenger()->whereRequestState(Passenger::STATE_PENDIENTE);
	}

	public function days() {
		return $this->hasMany('STS\Entities\TripDay','trip_id');
	}

	public function califications() {
        return $this->hasMany('STS\Entities\Calification','viajes_id');
    } 

	public function getPassengerCountAttribute() 
	{
		return $this->passengerAccepted()->count();
		//return ($viajeActual->total_seats - count($pasajeros));
    }

	public function getSeatsAvailableAttribute()
    {
        return $this->total_seats - $this->passengerAccepted()->count();
    } 

	public function getIsDriverAttribute()
    {
        return !$this->es_pasajero;
    } 

	public function checkFriendship($user) 
	{
		$conductor 	= $this->user;
		$fiends  	= $conductor->friends()->whereId($user->id)->first();
		$fof  		= $conductor->relativeFriends()->whereId($user->id)->first();

		if ($conductor->id == $user->id) return true;

		switch ($this->friendship_type_id) {
			case Trip::PRIVACY_PUBLIC:
				return true;
			case Trip::PRIVACY_FRIENDS:
				return !is_null($fiends);
			case Trip::PRIVACY_FOF:
				return !is_null($fiends) || !is_null($fof);			
		}
	}


}

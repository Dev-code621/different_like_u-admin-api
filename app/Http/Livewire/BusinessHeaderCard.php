<?php

namespace App\Http\Livewire;

use App\Business;
use App\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BusinessHeaderCard extends Component
{
    public $business;
    public $reviews;
    private $hours;
    public $isOpen;
    public $reviewAvg;

    public function mount()
    {
        $this->business = Business::where('user_id', Auth::id())->first();
        $this->reviews = Review::with('user')->where('business_id', $this->business->id)->orderBy('created_at', 'desc')->get();
        $this->hours = json_decode('{  "periods": [ {
        "close": {
            "day": 0, "time": "2030" }, "open": {
            "day": 0, "time": "1200" } }, {
        "close": {
            "day": 1, "time": "2030" }, "open": {
            "day": 1, "time": "1200" } }, {
        "close": {
            "day": 2, "time": "2030" }, "open": {
            "day": 2, "time": "1200" } }, {
        "close": {
            "day": 3, "time": "2030" }, "open": {
            "day": 3, "time": "1200" } }, {
        "close": {
            "day": 4, "time": "2030" }, "open": {
            "day": 4, "time": "1200" } }, {
        "close": {
            "day": 5, "time": "2030" }, "open": {
            "day": 5, "time": "1200" } }, {
        "close": {
            "day": 6, "time": "2030" }, "open": {
            "day": 6, "time": "1200" } } ]}');
    }
    function get_local_time(){

        $ip = file_get_contents("http://ipecho.net/plain");

        $url = 'http://ip-api.com/json/'.$ip;

        $tz = file_get_contents($url);

        $tz = json_decode($tz,true)['timezone'];

        return $tz;

    }
    public function render()
    {
        $now = Carbon::now()->timezone($this->get_local_time());
        $start = Carbon::createFromFormat('Hi', $this->hours->periods[date ('w')]->open->time, $this->get_local_time());
        $end =  Carbon::createFromFormat('Hi', $this->hours->periods[date ('w')]->close->time, $this->get_local_time());
        $this->isOpen = $now->isBetween($start, $end);
        $this->reviewAvg =  $this->reviews->avg('overall_score');
        return view('livewire.business-header-card');
    }
}

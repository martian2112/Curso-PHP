<?php

class WorkingHours extends Model {
    protected static $tablename = 'working_hours';
    protected static $columns = [
        'id',
        'user_id',
        'work_date',
        'time1',
        'time2',
        'time3',
        'time4',
        'worked_time'
    ];

    public static function loadfromuseranddate($userid, $workdate) {
        $registry = self::getone(['user_id' => $userid, 'work_date' => $workdate]);
        
        if(!$registry){
            $registry = new WorkingHours([
                'user_id' => $userid,
                'work_date' => $workdate,
                'worked_time' => 0
            ]);
        }
        return $registry;

    }

    public function getnexttime() {
        if(!$this->time1) return 'time 1';
        if(!$this->time2) return 'time 2';
        if(!$this->time3) return 'time 3';
        if(!$this->time4) return 'time 4';
        return null;
    }

    public function innout($time){
        $timecolumn = $this->getnexttime();
        if(!$timecolumn) {
            throw new AppException("Você já fez os 4 batimentos do dia!");
        }
        $this->$timecolumn = $time;
        if($this->id) {
            $this->update();
        }else {
            $this->insert();
        }
    }
}
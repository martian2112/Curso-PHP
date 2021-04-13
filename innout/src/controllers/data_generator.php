<?php
loadmodel('WorkingHours');

Database::executeSQL('DELETE FROM working_hours');
Database::executeSQL('DELETE FROM users WHERE id > 5');

function getdaytemplatebyodds($regularrate, $extrarate, $lazyrate){
    $regulardaytemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME
    ];

    $extrahourdaytemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '18:00:00',
        'worked_time' => DAILY_TIME + 3600
    ];

    $lazydaytemplate = [
        'time1' => '08:30:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME - 1800
    ];

    $value = rand(0,100);
    if($value <= $regularrate) {
        return $regulardaytemplate;
    } elseif ($value <= $regularrate + $extrarate){
        return $extrahourdaytemplate;
    } else {
        return $lazydaytemplate;
    }
}

function populateworkinghours($userid, $initialdate, $regularrate, $extrarate, $lazyrate){
    $currentdate = $initialdate;
    $today = new DateTime();
    $columns = ['user_id' => $userid, 'work_date' => $currentdate];

    while(isbefore($currentdate, $today)) {
        if(!isweekend($currentdate)){
            $template = getdaytemplatebyodds($regularrate, $extrarate, $lazyrate);
            $columns = array_merge($columns, $template);
            $workinghours = new WorkingHours($columns);
            $workinghours->insert();
        }
        $currentdate = getnextday($currentdate)->format('Y-m-d');
        $columns['work_date'] = $currentdate;
    }
}


populateworkinghours(1, date('Y-m-1'), 70, 20, 10);
echo 'Tudo Certo:)';
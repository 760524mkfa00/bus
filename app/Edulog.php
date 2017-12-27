<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Edulog extends Model
{


//    protected $connection = 'sqlsrv';

//    protected $edulog_id;


    public function EdulogUser( int $map_sys_id)
    {

       $data = \DB::connection('sqlsrv')->select("SELECT Stu_AutoID, Stu_FirstName, Stu_LastName, 
                Cast(CONVERT(DECIMAL(10,2), Stu_SchDist_Walk) AS NVARCHAR) + ' km.' AS StudWalkDistance, 
                CONVERT(VARCHAR(5), Stu_zElgCode_ID) + ' - ' + zElgCode_Desc AS DispEligibility, 
                zTripType_Desc AS BusStopDesc,
                Stop_Desc AS BusStop,
                FORMAT( RunSrv_TimeAtSrv, 'hh:mm tt') as DispTimeAtStop,
                Rte_BusNumber AS BusNum
                FROM Route RIGHT JOIN 
                  ((Run RIGHT JOIN 
                  ((Stop RIGHT JOIN 
                  (StopService RIGHT JOIN 
                  ((zTripType RIGHT JOIN 
                  ((zEligibilityCode INNER JOIN Student ON zEligibilityCode.zElgCode_ID = Student.Stu_zElgCode_ID) LEFT JOIN 
                  StudentTrip ON Student.Stu_AutoID = StudentTrip.StuTrip_Stu_AutoID) ON 
                  zTripType.zTripType_ID = StudentTrip.StuTrip_zTripType_ID) LEFT JOIN 
                  TripAssignment ON StudentTrip.StuTrip_AutoID = TripAssignment.TripAsgn_StuTrip_AutoID) ON 
                  StopService.StopSrv_AutoID = TripAssignment.TripAsgn_StopSrv_AutoID) ON 
                  Stop.Stop_AutoID = StopService.StopSrv_Stop_AutoID) LEFT JOIN RunService ON 
                  StopService.StopSrv_AutoID = RunService.RunSrv_StopSrv_AutoID) ON 
                  Run.Run_AutoID = RunService.RunSrv_Run_AutoID) LEFT JOIN RunRoute ON 
                  Run.Run_AutoID = RunRoute.RunRte_Run_AutoID) ON Route.Rte_AutoID = RunRoute.RunRte_Rte_AutoID
                WHERE Stu_AutoID = ? AND TripAssignment.TripAsgn_Sch = 0", [$map_sys_id]);

        return (array) $data;

    }
}

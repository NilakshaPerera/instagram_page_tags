<?php

namespace Libraries;

use Auth;
use App\Eventlog;
use App\Generallead;
use App\Branch;

class LogData {

    static function addDelete() {
        
    }

    static function log($event, $function, $content) {
        $userId = 0;
        if (Auth::user()) {
            $userId = Auth::user()->id;
        }
        $logData = array(
            'user_id' => $userId,
            'event' => $event,
            'functionname' => $function,
            'content' => $content,
            'iserror' => 0,
        );
        Eventlog::create($logData);
    }

    static function logError($event, $function, $error) {
        $userData = array(
            'user_id' => Auth::user()->id,
            'event' => $event,
            'functionname' => $function,
            'content' => $error,
            'iserror' => 1,
        );
        Eventlog::create($userData);
    }

    static function numberShorten($number, $precision = 1, $divisors = null) {
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
                pow(1000, 7) => 'Si', // Sextillion
            );
        }
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                break;
            }
        }
        return number_format($number / $divisor, $precision) . $shorthand;
    }

    /**
     * Created By : Nilaksha 
     * Created At : 18-11-2019
     * Summary : New leads count based on the logged in user
     * 
     * @return type
     */
    static function newLeadsCount() {
        $leads = 0;
        if (config('constants.roles.administrator') == Auth::user()->role_id) {
            $leads = Generallead::where('conversionstatus_id', '=', 5)->where('agent_id', '<>', NULL)->count();
        } else if ((config('constants.roles.callagent') == Auth::user()->role_id) && (1 == Branch::where('id', Auth::user()->branch_id)->first()->main)) {
            $leads = Generallead::where('conversionstatus_id', '=', 5)->where('agent_id', '<>', NULL)->count();
        } else if ((config('constants.roles.callagent') == Auth::user()->role_id) && (0 == Branch::where('id', Auth::user()->branch_id)->first()->main)) {
            $leads = Generallead::where('conversionstatus_id', '=', 5)->where('branch_id', Auth::user()->branch_id)->where('agent_id', Auth::user()->id)->count();
        } else if (config('constants.roles.marketer') == Auth::user()->role_id) {
            $leads = Generallead::where('conversionstatus_id', '=', 5)->where('branch_id', Auth::user()->branch_id)->where('marketer_id', Auth::user()->id)->count();
        }
        return $leads;
    }

    /**
     * Created At : 18-11-2019
     * Created By : Nilaksha 
     * Summary : Orphaned leads count based on the logged in user
     * 
     * @return type
     */
    static function orphanedLeadsCount() {
        $leads = 0;
        if (config('constants.roles.administrator') == Auth::user()->role_id) {
            $leads = Generallead::where('agent_id', NULL)->count();
        } else if ((config('constants.roles.callagent') == Auth::user()->role_id) && (1 == Branch::where('id', Auth::user()->branch_id)->first()->main)) {
            $leads = Generallead::where('agent_id', NULL)->count();
        }
        return $leads;
    }

    /**
     * Created At : 18-11-2019
     * Created By : Nilaksha 
     * Summary : Returns the count of in progress leads
     * 
     * @return type
     */
    static function inProgressLeads() {
        $leads = 0;
        if (config('constants.roles.administrator') == Auth::user()->role_id) {
            $leads = Generallead::where('branch_id', '<>', NULL)
                    ->where(function($query) {
                        $query->where('conversionstatus_id', '=', 3)
                        ->orWhere('conversionstatus_id', '=', 7)
                        ->orWhere('conversionstatus_id', '=', 9)
                        ->orWhere('conversionstatus_id', '=', 10);
                    })
                    ->count();
        } else if ((config('constants.roles.callagent') == Auth::user()->role_id) && (1 == Branch::where('id', Auth::user()->branch_id)->first()->main)) {
            $leads = Generallead::where('branch_id', '<>', NULL)
                    ->where(function($query) {
                        $query->where('conversionstatus_id', '=', 3)
                        ->orWhere('conversionstatus_id', '=', 7)
                        ->orWhere('conversionstatus_id', '=', 9)
                        ->orWhere('conversionstatus_id', '=', 10);
                    })
                    ->count();
        } else if ((config('constants.roles.callagent') == Auth::user()->role_id) && (0 == Branch::where('id', Auth::user()->branch_id)->first()->main)) {

            $leads = Generallead::where('branch_id', Auth::user()->branch_id)
                    ->where('agent_id', Auth::user()->id)->where(function($query) {
                        $query->where('conversionstatus_id', '=', 3)
                        ->orWhere('conversionstatus_id', '=', 7)
                        ->orWhere('conversionstatus_id', '=', 9)
                        ->orWhere('conversionstatus_id', '=', 10);
                    })
                    ->count();
        } else if (config('constants.roles.marketer') == Auth::user()->role_id) {

            $leads = Generallead::where('branch_id', Auth::user()->branch_id)
                    ->where('marketer_id', Auth::user()->id)
                    ->where(function($query) {
                        $query->where('conversionstatus_id', '=', 3)
                        ->orWhere('conversionstatus_id', '=', 7)
                        ->orWhere('conversionstatus_id', '=', 9)
                        ->orWhere('conversionstatus_id', '=', 10);
                    })
                    ->count();
        }
        return $leads;
    }

    /**
     * Created At : 20-11-2019
     * Created By : Nilaksha 
     * Summary : returns the total showroom leads count a logged in user has 
     * 
     * 
     * @return int
     */
    static function showroomLeads() {
        $leads = 0;
        if (config('constants.roles.administrator') == Auth::user()->role_id) {
            $leads = Generallead::where('conversionstatus_id', '=', 8)->where('agent_id', '<>', NULL)->count();
        } else if ((config('constants.roles.callagent') == Auth::user()->role_id) && (1 == Branch::where('id', Auth::user()->branch_id)->first()->main)) {
            $leads = Generallead::where('conversionstatus_id', '=', 8)->where('agent_id', '<>', NULL)->count();
        } else if ((config('constants.roles.callagent') == Auth::user()->role_id) && (0 == Branch::where('id', Auth::user()->branch_id)->first()->main)) {
            $leads = Generallead::where('conversionstatus_id', '=', 8)->where('branch_id', Auth::user()->branch_id)->where('agent_id', Auth::user()->id)->count();
        } else if (config('constants.roles.marketer') == Auth::user()->role_id) {
            $leads = Generallead::where('conversionstatus_id', '=', 8)->where('branch_id', Auth::user()->branch_id)->where('marketer_id', Auth::user()->id)->count();
        }
        return $leads;
    }

    /**
     * Created At : 18-11-2019
     * Created By : Nilaksha 
     * Summary : returns the total leads count a logged in user has 
     * 
     * 
     * @return int
     */
    static function totalLeadsCount() {
        return self::newLeadsCount() + self::inProgressLeads() + self::orphanedLeadsCount() + self::showroomLeads();
    }

}

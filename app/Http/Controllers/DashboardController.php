<?php

namespace App\Http\Controllers;

use App\Models\PlatForm;
use App\Models\Blog;
use App\Models\Project;
use DateTime;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
       $platForm=PlatForm::count();
       $project=Project::count();
       $blog=Blog::count();
        return view('dashboard',compact('platForm','project','blog'));
    }
    public function scrapData()
    {
         $this->estateGuru();
         $this->crowdEstate();
        $this->other('HousersNew','yes');
        $this->other('NordstreetNew','yes');
        $this->other('ProfitusNew','yes');
        $this->other('RendityNew','no');
        
    }
    protected function estateGuru()
    {
        $estateguru=DB::table('EstateguruNew')->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
        for ($i=0; $i < count($estateguru) ; $i++) { 
            # code...
        $id=$estateguru[$i]->id;
        $projectName=trim($estateguru[$i]->Project_Name);
        $goal=str_replace(",","",$estateguru[$i]->Goal);
        $loanDuration=$estateguru[$i]->Loan_Duration;
        $interest=str_replace("%","",$estateguru[$i]->Interest);
        $ltv=str_replace("%","",$estateguru[$i]->LTV);
        $linkToProject=$estateguru[$i]->Link_To_Project;
        $raisedToDate=$estateguru[$i]->Raised_To_Date;
        $fundingProgress=str_replace("%","",$estateguru[$i]->Funding_Progress);
        $numberOfInvestors=str_replace(",","",$estateguru[$i]->Number_Of_Investors);
        $remainingToRaise=str_replace(",","",$estateguru[$i]->Remaining_To_Raise);
        $loanType=$estateguru[$i]->Loan_Type;
        $comment=$estateguru[$i]->Comment;
        $dateTimeRounded=Date('Y-m-d',strtotime($estateguru[$i]->Date_Time_Rounded));
        $platForm=$estateguru[$i]->Platform;
        $fetchData=$estateguru[$i]->fetch_data;
        $raisedToDate=$goal*$fundingProgress;
        $avgTicket=$raisedToDate/$numberOfInvestors;
        $date1 = new DateTime($dateTimeRounded);
        $date2 = new DateTime(Date('Y-m-d'));
        $interval = $date1->diff($date2);
        $days=$interval->days;
        if($fundingProgress < "100")
        {
            $status="in process";
            $fundingPlace=$raisedToDate/$days;
        }
        elseif($fundingProgress == "100")
        {
            $status="funded";
            if($raisedToDate != '')
            {
                $fundingPlace=$raisedToDate/$days;
            }
            else
            {
                $fundingPlace='';
            }
        }
        $estateguruProject=Project::where('project_name',$projectName)->first();
        if(!is_null($estateguruProject))
        {

            $date1 = new DateTime($estateguruProject->created_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;

            $date1 = new DateTime($estateguruProject->created_at);
            $date2 = new DateTime($estateguruProject->updated_at);
            $interval = $date1->diff($date2);
            $daysForClose=$interval->days;
            //update
        if($fundingProgress < '100' && $daysForStatus > 2)
        {
            $daysForClose=$daysForClose == 0 ? 1 : $daysForClose;
            $status="not funded";
            $date=$estateguruProject->created_at;
            try {
                $fundingPlace=$goal/$daysForClose;
            } catch (\Throwable $th) {
                $fundingPlace=0;
            }
        }
        elseif($fundingProgress == '100' )
        {
            $daysForClose=$daysForClose == 0 ? 1 : $daysForClose;
            $status="funded";
            $date=$estateguruProject->created_at;
            try {
                $fundingPlace=$goal/$daysForClose;
            } catch (\Throwable $th) {
                $fundingPlace=0;
            }
        }
        elseif($fundingProgress < '100')
        {
            $status="in process";
            $fundingPlace=$raisedToDate/$days;
            $date=Controller::currentDateTime();
        }
        
        $estateguruProject->goal=$goal;
        $estateguruProject->plat_form=$platForm;
        $estateguruProject->project_name=$projectName;
        $estateguruProject->duration_month=$loanDuration;
        $estateguruProject->interest=$interest;
        $estateguruProject->ltv=$ltv;
        $estateguruProject->raised_to_date=$raisedToDate;
        $estateguruProject->funding_progress=$fundingProgress;
        $estateguruProject->investors=$numberOfInvestors;
        $estateguruProject->average_ticket=$avgTicket;
        $estateguruProject->funding_pace=$fundingPlace;
        $estateguruProject->funding_status=$status;
        $estateguruProject->url=$linkToProject;
        $estateguruProject->comment=$comment;
        $estateguruProject->loan_type=$loanType;
        $estateguruProject->remaining_to_rise=$remainingToRaise == '' ? 0 : $remainingToRaise;
        $estateguruProject->updated_at=$date;
        $estateguruProject->save();
        DB::table('EstateguruNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            //insert
            Project::create([
                'plat_form' => $platForm,
                'project_name' => $projectName,
                'goal' => $goal,
                'duration_month' => $loanDuration,
                'interest' => $interest,
                'ltv' => $ltv,
                'raised_to_date' => $raisedToDate,
                'funding_progress' => $fundingProgress,
                'investors' => $numberOfInvestors,
                'average_ticket' => $avgTicket,
                'funding_pace' => $fundingPlace,
                'funding_status' => $status,
                'url' => $linkToProject,
                'comment' => $comment,
                'loan_type' => $loanType,
                'remaining_to_rise'=>$remainingToRaise == '' ? 0 : $remainingToRaise,
                'created_at' => Controller::currentDateTime(),
            ]);
            DB::table('EstateguruNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }

    }
    protected function crowdEstate()
    {
        $crowdEstate=DB::table('CrowdestateNew')->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
        for ($i=0; $i < count($crowdEstate) ; $i++) { 
            # code...
        $id=$crowdEstate[$i]->id;
        $projectName=trim($crowdEstate[$i]->Project_Name);
        $goal=str_replace(",","",$crowdEstate[$i]->Goal);
        $loanDuration=$crowdEstate[$i]->Loan_Duration;
        $interest=str_replace("%","",$crowdEstate[$i]->Interest);
        $ltv=str_replace("%","",$crowdEstate[$i]->LTV);
        $linkToProject=$crowdEstate[$i]->Link_To_Project;
        $raisedToDate=$crowdEstate[$i]->Raised_To_Date;
        $fundingProgress=str_replace("%","",$crowdEstate[$i]->Funding_Progress);
        $numberOfInvestors=str_replace(",","",$crowdEstate[$i]->Number_Of_Investors);
        $remainingToRaise=str_replace(",","",$crowdEstate[$i]->Remaining_To_Raise);
        $loanType=$crowdEstate[$i]->Loan_Type;
        $comment=$crowdEstate[$i]->Comment;
        $dateTimeRounded=Date('Y-m-d',strtotime($crowdEstate[$i]->Date_Time_Rounded));
        $platForm=$crowdEstate[$i]->Platform;
        $fetchData=$crowdEstate[$i]->fetch_data;
        $fundingProgress=$goal/$raisedToDate;
        // $raisedToDate=$goal*$fundingProgress;
        $numberOfInvestors == '0' ? 1 :$numberOfInvestors;
        $avgTicket=$raisedToDate/$numberOfInvestors;
        $date1 = new DateTime($dateTimeRounded);
        $date2 = new DateTime(Date('Y-m-d'));
        $interval = $date1->diff($date2);
        $days=$interval->days;
        if($fundingProgress < "100")
        {
            $status="in process";
            $fundingPlace=$raisedToDate/$days;
        }
        elseif($fundingProgress == "100")
        {
            $status="funded";
            if($raisedToDate != '')
            {
                $fundingPlace=$raisedToDate/$days;
            }
            else
            {
                $fundingPlace='';
            }
        }
        $crowdEstateProject=Project::where('project_name',$projectName)->first();
        if(!is_null($crowdEstateProject))
        {

            $date1 = new DateTime($crowdEstateProject->created_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;

            $date1 = new DateTime($crowdEstateProject->created_at);
            $date2 = new DateTime($crowdEstateProject->updated_at);
            $interval = $date1->diff($date2);
            $daysForClose=$interval->days;
            //update
        if($fundingProgress < '100' && $daysForStatus > 2)
        {
            $daysForClose=$daysForClose == 0 ? 1 : $daysForClose;
            $status="not funded";
            $date=$crowdEstateProject->created_at;
            try {
                $fundingPlace=$goal/$daysForClose;
            } catch (\Throwable $th) {
                $fundingPlace=0;
            }
        }
        elseif($fundingProgress == '100' )
        {
            $daysForClose=$daysForClose == 0 ? 1 : $daysForClose;
            $status="funded";
            $date=$crowdEstateProject->created_at;
            try {
                $fundingPlace=$goal/$daysForClose;
            } catch (\Throwable $th) {
                $fundingPlace=0;
            }
        }
        elseif($fundingProgress < '100')
        {
            $status="in process";
            $date=Controller::currentDateTime();
        }
        
        $crowdEstateProject->goal=$goal;
        $crowdEstateProject->plat_form=$platForm;
        $crowdEstateProject->project_name=$projectName;
        $crowdEstateProject->duration_month=$loanDuration;
        $crowdEstateProject->interest=$interest;
        $crowdEstateProject->ltv=$ltv;
        $crowdEstateProject->raised_to_date=$raisedToDate;
        $crowdEstateProject->funding_progress=$fundingProgress;
        $crowdEstateProject->investors=$numberOfInvestors;
        $crowdEstateProject->average_ticket=$avgTicket;
        $crowdEstateProject->funding_pace=$fundingPlace;
        $crowdEstateProject->funding_status=$status;
        $crowdEstateProject->url=$linkToProject;
        $crowdEstateProject->comment=$comment;
        $crowdEstateProject->loan_type=$loanType;
        $crowdEstateProject->remaining_to_rise=$remainingToRaise == '' ? 0 : $remainingToRaise;
        $crowdEstateProject->updated_at=$date;
        $crowdEstateProject->save();
        DB::table('CrowdestateNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            //insert
            Project::create([
                'plat_form' => $platForm,
                'project_name' => $projectName,
                'goal' => $goal,
                'duration_month' => $loanDuration,
                'interest' => $interest,
                'ltv' => $ltv,
                'raised_to_date' => $raisedToDate,
                'funding_progress' => $fundingProgress,
                'investors' => $numberOfInvestors,
                'average_ticket' => $avgTicket,
                'funding_pace' => $fundingPlace,
                'funding_status' => $status,
                'url' => $linkToProject,
                'comment' => $comment,
                'loan_type' => $loanType,
                'remaining_to_rise'=>$remainingToRaise == '' ? 0 : $remainingToRaise,
                'created_at' => Controller::currentDateTime(),
            ]);
            DB::table('CrowdestateNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }
   
    }
    protected function other($table,$avgTic)
    {
        $housers=DB::table($table)->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
        for ($i=0; $i < count($housers) ; $i++) { 
            # code...
        $id=$housers[$i]->id;
        $projectName=trim($housers[$i]->Project_Name);
        $goal=str_replace(",","",$housers[$i]->Goal);
        $loanDuration=str_replace("months","",trim($housers[$i]->Loan_Duration));
        $interest=str_replace("%","",trim($housers[$i]->Interest));
        $ltv=str_replace("%","",$housers[$i]->LTV);
        $linkToProject=$housers[$i]->Link_To_Project;
        $raisedToDate=$housers[$i]->Raised_To_Date;
        $fundingProgress=str_replace("%","",$housers[$i]->Funding_Progress);
        $numberOfInvestors=str_replace(",","",$housers[$i]->Number_Of_Investors);
        $remainingToRaise=str_replace(",","",$housers[$i]->Remaining_To_Raise);
        $loanType=trim($housers[$i]->Loan_Type);
        $comment=$housers[$i]->Comment;
        $dateTimeRounded=Date('Y-m-d',strtotime($housers[$i]->Date_Time_Rounded));
        $platForm=$housers[$i]->Platform;
        $fetchData=$housers[$i]->fetch_data;
        // $fundingProgress=$goal/$raisedToDate;
        // $raisedToDate=$goal*$fundingProgress;
        if($goal != '' && $raisedToDate != '')
        {
            try {
                $goal=str_replace( array( '\'', '"',',' , ';', '<', '>','∞','Tikslas:' ), "", $goal);
                $goal=trim($goal);
                
                $remainingToRaise=$goal-$raisedToDate;
                //code...
            } catch (\Throwable $th) {
                //throw $th;
                $remainingToRaise=0;
            }
        }
        if($avgTic=='yes')
        {
            if($raisedToDate != '' && $numberOfInvestors != '')
            {
                try {
                    $avgTicket=$raisedToDate/$numberOfInvestors;
                    //code...
                } catch (\Throwable $th) {
                    //throw $th;
                    $avgTicket=0;
                }
                 
            }
            else
            {
                $avgTicket='';
            }
        }
        else
        {
            $avgTicket='';
        }
        $date1 = new DateTime($dateTimeRounded);
        $date2 = new DateTime(Date('Y-m-d'));
        $interval = $date1->diff($date2);
        $days=$interval->days;
        if($fundingProgress < "100")
        {
            $status="in process";
            if($raisedToDate != '')
            {
                try {
                $fundingPlace=$raisedToDate/$days;
                //code...
            } catch (\Throwable $th) {
                //throw $th;
                $fundingPlace='';
            }
            }
            else
            {
                $fundingPlace='';
            }
        }
        elseif($fundingProgress == "100")
        {
            $status="funded";
            if($raisedToDate != '')
            {
                
                try {
                $fundingPlace=$raisedToDate/$days;
                //code...
            } catch (\Throwable $th) {
                //throw $th;
                $fundingPlace='';
            }
            }
            else
            {
                $fundingPlace='';
            }
        }
        $housersProject=Project::where('project_name',$projectName)->first();
        if(!is_null($housersProject))
        {

            $date1 = new DateTime($housersProject->created_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;

            $date1 = new DateTime($housersProject->created_at);
            $date2 = new DateTime($housersProject->updated_at);
            $interval = $date1->diff($date2);
            $daysForClose=$interval->days;
            //update
        if($fundingProgress < '100' && $daysForStatus > 2)
        {
            $daysForClose=$daysForClose == 0 ? 1 : $daysForClose;
            $status="not funded";
            $date=$housersProject->created_at;
            try {
                $fundingPlace=$goal/$daysForClose;
            } catch (\Throwable $th) {
                $fundingPlace=0;
            }
        }
        elseif($fundingProgress == '100' )
        {
            $daysForClose=$daysForClose == 0 ? 1 : $daysForClose;
            $status="funded";
            $date=$housersProject->created_at;
            try {
                $fundingPlace=$goal/$daysForClose;
                //code...
            } catch (\Throwable $th) {
                //throw $th;
                
                $fundingPlace='';
            }
            
        }
        elseif($fundingProgress < '100')
        {
            $status="in process";
            $date=Controller::currentDateTime();
        }
        
        $housersProject->plat_form=$platForm;
        $housersProject->goal=$goal == '' ? 0 : $goal;
        $housersProject->project_name=$projectName;
        $housersProject->duration_month=$loanDuration;
        $housersProject->interest=$interest;
        $housersProject->ltv=$ltv;
        $housersProject->raised_to_date=$raisedToDate == '' ? 0 : $raisedToDate;
        $housersProject->funding_progress=$fundingProgress == '' ? 0 : $fundingProgress;
        $housersProject->investors=$numberOfInvestors  == '' ? 0 : $numberOfInvestors;
        $housersProject->average_ticket=$avgTicket == '' ? 0 : $avgTicket;
        $housersProject->funding_pace=$fundingPlace == '' ? 0 : $fundingPlace;
        $housersProject->funding_status=$status;
        $housersProject->url=$linkToProject;
        $housersProject->comment=$comment;
        $housersProject->loan_type=$loanType;
        $housersProject->remaining_to_rise=$remainingToRaise == '' ? 0 : $remainingToRaise;
        $housersProject->updated_at=$date;
        $housersProject->save();
        DB::table($table)->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            //insert
            Project::create([
                'plat_form' => $platForm,
                'project_name' => $projectName,
                'goal' => $goal == '' ? 0 : $goal,
                'duration_month' => $loanDuration,
                'interest' => $interest,
                'ltv' => $ltv,
                'raised_to_date' => $raisedToDate == '' ? 0 : $raisedToDate,
                'funding_progress' => $fundingProgress == '' ? 0 : $fundingProgress,
                'investors' => $numberOfInvestors == '' ? 0 : $numberOfInvestors,
                'average_ticket' => $avgTicket == '' ? 0 : $avgTicket,
                'funding_pace' => $fundingPlace == '' ? 0 : $fundingPlace,
                'funding_status' => $status,
                'url' => $linkToProject,
                'comment' => $comment,
                'loan_type' => $loanType,
                'remaining_to_rise'=>$remainingToRaise == '' ? 0 : $remainingToRaise,
                'created_at' => $dateTimeRounded,
            ]);
            DB::table($table)->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }
   
    }
   
}

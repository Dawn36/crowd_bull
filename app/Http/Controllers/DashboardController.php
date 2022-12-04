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
    public function calculateHours($date1,$date2)
    {
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        
        $diff = $date2->diff($date1);
        
        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);

        return $hours;
    }
    public function scrapData()
    {
         //$this->estateGuru();
        //  $this->crowdEstate();
        //  $this->HousersNew();
        //  $this->NordstreetNew();
        // $this->ProfitusNew();
         $this->RendityNew();
       
        
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
        $dateTimeRounded=Date('Y-m-d h:i:s',strtotime($estateguru[$i]->Date_Time_Rounded));
        $platForm=$estateguru[$i]->Platform;
        $fetchData=$estateguru[$i]->fetch_data;
        $raisedToDate=$goal*($fundingProgress/100);
        $avgTicket=$raisedToDate/$numberOfInvestors;
       
        $estateguruProject=Project::where('project_name',$projectName)->first();
        if(!is_null($estateguruProject))
        {

            $date1 = new DateTime($estateguruProject->updated_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;
            //update
            if($fundingProgress < '100' && $daysForStatus > '2')
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="unknown";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress == '100' )
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="funded";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress < '100')
            {
                // $date1 = new DateTime($dateTimeRounded);
                // $date2 = new DateTime(Date('Y-m-d'));
                // $interval = $date1->diff($date2);
                // $days=$interval->days;
                // $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;

                $status="in process";
                $fundingPlace=$raisedToDate/$hours;
            }
            DB::table('projects')
            ->where('id', $estateguruProject->id)
            ->update(['goal' => $goal,'plat_form'=>$platForm
            ,'project_name'=>$projectName,'duration_month'=>$loanDuration,'interest'=>$interest
            ,'ltv'=>$ltv,'raised_to_date'=>$raisedToDate,'funding_progress'=>$fundingProgress
            ,'investors'=>$numberOfInvestors,'average_ticket'=>$avgTicket,'funding_pace'=>$fundingPlace
            ,'funding_status'=>$status,'url'=>$linkToProject,'comment'=>$comment,'loan_type'=>$loanType
            ,'remaining_to_rise'=>$remainingToRaise,'updated_at'=>$dateTimeRounded]);
            DB::table('EstateguruNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
            if($fundingProgress < "100")
            {
                $status="in process";
            }
            elseif($fundingProgress == "100")
            {
                $status="funded";
            }
            $fundingPlace=$raisedToDate/$hours;
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
                'remaining_to_rise'=>$remainingToRaise,
                'created_at' => $dateTimeRounded,
            ]);
            DB::table('EstateguruNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }

    }
    
    protected function crowdEstate()
    {
        $estateguru=DB::table('CrowdestateNew')->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
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
        $dateTimeRounded=Date('Y-m-d h:i:s',strtotime($estateguru[$i]->Date_Time_Rounded));
        $platForm=$estateguru[$i]->Platform;
        $fetchData=$estateguru[$i]->fetch_data;
        $fundingProgress=($raisedToDate/$goal)*100;
        // $raisedToDate=$goal*($fundingProgress/100);
        $avgTicket=$raisedToDate/$numberOfInvestors;
       
        $estateguruProject=Project::where('project_name',$projectName)->first();
        if(!is_null($estateguruProject))
        {

            $date1 = new DateTime($estateguruProject->updated_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;
            //update
            if($fundingProgress < '100' && $daysForStatus > '2')
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="unknown";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress == '100' )
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="funded";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress < '100')
            {
                // $date1 = new DateTime($dateTimeRounded);
                // $date2 = new DateTime(Date('Y-m-d'));
                // $interval = $date1->diff($date2);
                // $days=$interval->days;
                // $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;

                $status="in process";
                $fundingPlace=$raisedToDate/$hours;
            }
            DB::table('projects')
            ->where('id', $estateguruProject->id)
            ->update(['goal' => $goal,'plat_form'=>$platForm
            ,'project_name'=>$projectName,'duration_month'=>$loanDuration,'interest'=>$interest
            ,'ltv'=>$ltv,'raised_to_date'=>$raisedToDate,'funding_progress'=>$fundingProgress
            ,'investors'=>$numberOfInvestors,'average_ticket'=>$avgTicket,'funding_pace'=>$fundingPlace
            ,'funding_status'=>$status,'url'=>$linkToProject,'comment'=>$comment,'loan_type'=>$loanType
            ,'remaining_to_rise'=>$remainingToRaise,'updated_at'=>$dateTimeRounded]);
            DB::table('CrowdestateNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
            if($fundingProgress < "100")
            {
                $status="in process";
            }
            elseif($fundingProgress == "100")
            {
                $status="funded";
            }
            $fundingPlace=$raisedToDate/$hours;
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
                'remaining_to_rise'=>$remainingToRaise,
                'created_at' => $dateTimeRounded,
            ]);
            DB::table('CrowdestateNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }

    }
    protected function HousersNew()
    {
        $estateguru=DB::table('HousersNew')->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
        for ($i=0; $i < count($estateguru) ; $i++) { 
            # code...
        $id=$estateguru[$i]->id;
        $projectName=trim($estateguru[$i]->Project_Name);
        $goal=str_replace(",","",$estateguru[$i]->Goal);
        $loanDuration=trim(str_replace("months","",$estateguru[$i]->Loan_Duration));
        $interest=str_replace("%","",$estateguru[$i]->Interest);
        $ltv=trim(str_replace("%","",$estateguru[$i]->LTV));
        $linkToProject=$estateguru[$i]->Link_To_Project;
        $raisedToDate=$estateguru[$i]->Raised_To_Date;
        $raisedToDate=$raisedToDate == '' ? 0 : $raisedToDate;
        $fundingProgress=str_replace("%","",$estateguru[$i]->Funding_Progress);
        $numberOfInvestors=str_replace(",","",$estateguru[$i]->Number_Of_Investors);
        $remainingToRaise=str_replace(",","",$estateguru[$i]->Remaining_To_Raise);
        $loanType=$estateguru[$i]->Loan_Type;
        $comment=$estateguru[$i]->Comment;
        $dateTimeRounded=Date('Y-m-d h:i:s',strtotime($estateguru[$i]->Date_Time_Rounded));
        $platForm=$estateguru[$i]->Platform;
        $fetchData=$estateguru[$i]->fetch_data;
       // $fundingProgress=($raisedToDate/$goal)*100;
        // $raisedToDate=$goal*($fundingProgress/100);
        
        if(!is_numeric($goal))
        {
            DB::table('HousersNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
                   
            continue;
        }
       
        $remainingToRaise=$goal-$raisedToDate;
        if($numberOfInvestors != '' && $raisedToDate != '' )
        {
            $avgTicket=$raisedToDate/$numberOfInvestors;
        }
        else
        {
            $avgTicket=0;
        }
        $estateguruProject=Project::where('project_name',$projectName)->first();
        if(!is_null($estateguruProject))
        {

            $date1 = new DateTime($estateguruProject->updated_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;
            //update
            if($fundingProgress < '100' && $daysForStatus > '2')
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="unknown";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress == '100' )
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="funded";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress < '100')
            {
                // $date1 = new DateTime($dateTimeRounded);
                // $date2 = new DateTime(Date('Y-m-d'));
                // $interval = $date1->diff($date2);
                // $days=$interval->days;
                // $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;

                $status="in process";
                $fundingPlace=$raisedToDate/$hours;
            }
            DB::table('projects')
            ->where('id', $estateguruProject->id)
            ->update(['goal' => $goal,'plat_form'=>$platForm
            ,'project_name'=>$projectName,'duration_month'=>$loanDuration,'interest'=>$interest
            ,'ltv'=>$ltv,'raised_to_date'=>$raisedToDate,'funding_progress'=>$fundingProgress
            ,'investors'=>$numberOfInvestors,'average_ticket'=>$avgTicket,'funding_pace'=>$fundingPlace
            ,'funding_status'=>$status,'url'=>$linkToProject,'comment'=>$comment,'loan_type'=>$loanType
            ,'remaining_to_rise'=>$remainingToRaise,'updated_at'=>$dateTimeRounded]);
            DB::table('HousersNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
            if($fundingProgress < "100")
            {
                $status="in process";
            }
            elseif($fundingProgress == "100")
            {
                $status="funded";
            }
            $fundingPlace=$raisedToDate/$hours;
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
                'remaining_to_rise'=>$remainingToRaise,
                'created_at' => $dateTimeRounded,
            ]);
            DB::table('HousersNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }
    }

    protected function NordstreetNew()
    {
        $estateguru=DB::table('NordstreetNew')->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
        for ($i=0; $i < count($estateguru) ; $i++) { 
            # code...
        $id=$estateguru[$i]->id;
        $projectName=trim($estateguru[$i]->Project_Name);
        $goal=str_replace(",","",$estateguru[$i]->Goal);
        $goal=$goal == '' ? 0 : $goal;
        $loanDuration=trim(str_replace("months","",$estateguru[$i]->Loan_Duration));
        $interest=str_replace("%","",$estateguru[$i]->Interest);
        $ltv=str_replace("%","",$estateguru[$i]->LTV);
        $linkToProject=$estateguru[$i]->Link_To_Project;
        $raisedToDate=$estateguru[$i]->Raised_To_Date;
        $raisedToDate=$raisedToDate == '' ? 0 : $raisedToDate;
        $fundingProgress=str_replace("%","",$estateguru[$i]->Funding_Progress);
        $numberOfInvestors=str_replace(",","",$estateguru[$i]->Number_Of_Investors);
       
        if(!is_numeric($numberOfInvestors))
        {
            DB::table('NordstreetNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
            continue;
        }
        
        $remainingToRaise=str_replace(",","",$estateguru[$i]->Remaining_To_Raise);
        $loanType=$estateguru[$i]->Loan_Type;
        $comment=$estateguru[$i]->Comment;
        $dateTimeRounded=Date('Y-m-d h:i:s',strtotime($estateguru[$i]->Date_Time_Rounded));
        $platForm=$estateguru[$i]->Platform;
        $fetchData=$estateguru[$i]->fetch_data;
       // $fundingProgress=($raisedToDate/$goal)*100;
        // $raisedToDate=$goal*($fundingProgress/100);
        
       try {
            $remainingToRaise=$goal-$raisedToDate;
        } catch (\Throwable $th) {
            dd($id);
        }
       try {
             $avgTicket=$raisedToDate/$numberOfInvestors;
        } catch (\Throwable $th) {
            $avgTicket=0;
        }
          
        
       
        $estateguruProject=Project::where('project_name',$projectName)->first();
        if(!is_null($estateguruProject))
        {

            $date1 = new DateTime($estateguruProject->updated_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;
            //update
            if($fundingProgress < '100' && $daysForStatus > '2')
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="unknown";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress == '100' )
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="funded";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress < '100')
            {
                // $date1 = new DateTime($dateTimeRounded);
                // $date2 = new DateTime(Date('Y-m-d'));
                // $interval = $date1->diff($date2);
                // $days=$interval->days;
                // $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;

                $status="in process";
                $fundingPlace=$raisedToDate/$hours;
            }
            DB::table('projects')
            ->where('id', $estateguruProject->id)
            ->update(['goal' => $goal,'plat_form'=>$platForm
            ,'project_name'=>$projectName,'duration_month'=>$loanDuration,'interest'=>$interest
            ,'ltv'=>$ltv,'raised_to_date'=>$raisedToDate,'funding_progress'=>$fundingProgress
            ,'investors'=>$numberOfInvestors,'average_ticket'=>$avgTicket,'funding_pace'=>$fundingPlace
            ,'funding_status'=>$status,'url'=>$linkToProject,'comment'=>$comment,'loan_type'=>$loanType
            ,'remaining_to_rise'=>$remainingToRaise,'updated_at'=>$dateTimeRounded]);
            DB::table('NordstreetNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
            if($fundingProgress < "100")
            {
                $status="in process";
            }
            elseif($fundingProgress == "100")
            {
                $status="funded";
            }
            $fundingPlace=$raisedToDate/$hours;
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
                'remaining_to_rise'=>$remainingToRaise,
                'created_at' => $dateTimeRounded,
            ]);
            DB::table('NordstreetNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }

    }
    protected function ProfitusNew()
    {
        $estateguru=DB::table('ProfitusNew')->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
        for ($i=0; $i < count($estateguru) ; $i++) { 
            # code...
        $id=$estateguru[$i]->id;
        $projectName=trim($estateguru[$i]->Project_Name);
        $goal=str_replace(",","",$estateguru[$i]->Goal);
        $loanDuration=trim(str_replace("months","",$estateguru[$i]->Loan_Duration));
        $interest=str_replace("%","",$estateguru[$i]->Interest);
        $ltv=trim(str_replace("%","",$estateguru[$i]->LTV));
        $linkToProject=$estateguru[$i]->Link_To_Project;
        $raisedToDate=$estateguru[$i]->Raised_To_Date;
        $raisedToDate=$raisedToDate == '' ? 0 : $raisedToDate;
        $fundingProgress=str_replace("%","",$estateguru[$i]->Funding_Progress);
        $numberOfInvestors=str_replace(",","",$estateguru[$i]->Number_Of_Investors);
        $remainingToRaise=str_replace(",","",$estateguru[$i]->Remaining_To_Raise);
        $loanType=$estateguru[$i]->Loan_Type;
        $comment=$estateguru[$i]->Comment;
        $dateTimeRounded=Date('Y-m-d h:i:s',strtotime($estateguru[$i]->Date_Time_Rounded));
        $platForm=$estateguru[$i]->Platform;
        $fetchData=$estateguru[$i]->fetch_data;
       // $fundingProgress=($raisedToDate/$goal)*100;
        // $raisedToDate=$goal*($fundingProgress/100);
        
        if(!is_numeric($goal))
        {
            DB::table('ProfitusNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
                   
            continue;
        }
       
        $remainingToRaise=$goal-$raisedToDate;
        try {
            $avgTicket=$raisedToDate/$numberOfInvestors;
        } catch (\Throwable $th) {
            $avgTicket=0;
        }
        
        $estateguruProject=Project::where('project_name',$projectName)->first();
        if(!is_null($estateguruProject))
        {

            $date1 = new DateTime($estateguruProject->updated_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;
            //update
            if($fundingProgress < '100' && $daysForStatus > '2')
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="unknown";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress == '100' )
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="funded";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress < '100')
            {
                // $date1 = new DateTime($dateTimeRounded);
                // $date2 = new DateTime(Date('Y-m-d'));
                // $interval = $date1->diff($date2);
                // $days=$interval->days;
                // $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;

                $status="in process";
                $fundingPlace=$raisedToDate/$hours;
            }
            DB::table('projects')
            ->where('id', $estateguruProject->id)
            ->update(['goal' => $goal,'plat_form'=>$platForm
            ,'project_name'=>$projectName,'duration_month'=>$loanDuration,'interest'=>$interest
            ,'ltv'=>$ltv,'raised_to_date'=>$raisedToDate,'funding_progress'=>$fundingProgress
            ,'investors'=>$numberOfInvestors,'average_ticket'=>$avgTicket,'funding_pace'=>$fundingPlace
            ,'funding_status'=>$status,'url'=>$linkToProject,'comment'=>$comment,'loan_type'=>$loanType
            ,'remaining_to_rise'=>$remainingToRaise,'updated_at'=>$dateTimeRounded]);
            DB::table('ProfitusNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
            if($fundingProgress < "100")
            {
                $status="in process";
            }
            elseif($fundingProgress == "100")
            {
                $status="funded";
            }
            $fundingPlace=$raisedToDate/$hours;
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
                'remaining_to_rise'=>$remainingToRaise,
                'created_at' => $dateTimeRounded,
            ]);
            DB::table('ProfitusNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }
    }
    protected function RendityNew()
    {
        $estateguru=DB::table('RendityNew')->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
        for ($i=0; $i < count($estateguru) ; $i++) { 
            # code...
        $id=$estateguru[$i]->id;
        $projectName=trim($estateguru[$i]->Project_Name);
        $goal=str_replace(",","",$estateguru[$i]->Goal);
        $loanDuration=trim(str_replace("months","",$estateguru[$i]->Loan_Duration));
        $interest=str_replace("%","",$estateguru[$i]->Interest);
        $ltv=trim(str_replace("%","",$estateguru[$i]->LTV));
        $linkToProject=$estateguru[$i]->Link_To_Project;
        $raisedToDate=$estateguru[$i]->Raised_To_Date;
        $fundingProgress=str_replace("%","",$estateguru[$i]->Funding_Progress);
        $numberOfInvestors=str_replace(",","",$estateguru[$i]->Number_Of_Investors);
        $numberOfInvestors=$numberOfInvestors == '' ? 0 : $numberOfInvestors;
        $remainingToRaise=str_replace(",","",$estateguru[$i]->Remaining_To_Raise);
        $loanType=$estateguru[$i]->Loan_Type;
        $comment=$estateguru[$i]->Comment;
        $dateTimeRounded=Date('Y-m-d h:i:s',strtotime($estateguru[$i]->Date_Time_Rounded));
        $platForm=$estateguru[$i]->Platform;
        $fetchData=$estateguru[$i]->fetch_data;
       // $fundingProgress=($raisedToDate/$goal)*100;
        // $raisedToDate=$goal*($fundingProgress/100);
        if($fundingProgress == '' || $fundingProgress == 0)
        {
            DB::table('RendityNew')->where('id', $id)
            ->update(['fetch_data' => 'yes']);
           
                continue;
        }
        if($raisedToDate == '' || $raisedToDate == 0)
        {
            DB::table('RendityNew')->where('id', $id)
            ->update(['fetch_data' => 'yes']);
           
                continue;
        }
        $goal=$raisedToDate/($fundingProgress/100);
       
        $remainingToRaise=$goal-$raisedToDate;
        try {
            $avgTicket=$raisedToDate/$numberOfInvestors;
        } catch (\Throwable $th) {
            $avgTicket=0;
        }
        
        $estateguruProject=Project::where('project_name',$projectName)->first();
        if(!is_null($estateguruProject))
        {

            $date1 = new DateTime($estateguruProject->updated_at);
            $date2 = new DateTime(Date('Y-m-d'));
            $interval = $date1->diff($date2);
            $daysForStatus=$interval->days;
            //update
            if($fundingProgress < '100' && $daysForStatus > '2')
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="unknown";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress == '100' )
            {
                // $date1 = new DateTime($estateguruProject->created_at);
                // $date2 = new DateTime($dateTimeRounded);
                // $interval = $date1->diff($date2);
                // $daysForClose=$interval->days;
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;
                $status="funded";
                $fundingPlace=$raisedToDate/$hours;
                // $fundingPlace=$goal/$hours;
            }
            elseif($fundingProgress < '100')
            {
                // $date1 = new DateTime($dateTimeRounded);
                // $date2 = new DateTime(Date('Y-m-d'));
                // $interval = $date1->diff($date2);
                // $days=$interval->days;
                // $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
                $hours=$this->calculateHours($estateguruProject->created_at,$dateTimeRounded);
                $hours=$hours == 0 ? 1 : $hours;

                $status="in process";
                $fundingPlace=$raisedToDate/$hours;
            }
            DB::table('projects')
            ->where('id', $estateguruProject->id)
            ->update(['goal' => $goal,'plat_form'=>$platForm
            ,'project_name'=>$projectName,'duration_month'=>$loanDuration,'interest'=>$interest
            ,'ltv'=>$ltv,'raised_to_date'=>$raisedToDate,'funding_progress'=>$fundingProgress
            ,'investors'=>$numberOfInvestors,'average_ticket'=>$avgTicket,'funding_pace'=>$fundingPlace
            ,'funding_status'=>$status,'url'=>$linkToProject,'comment'=>$comment,'loan_type'=>$loanType
            ,'remaining_to_rise'=>$remainingToRaise,'updated_at'=>$dateTimeRounded]);
            DB::table('RendityNew')->where('id', $id)
                    ->update(['fetch_data' => 'yes']);
        }
        else 
        {
            $hours=$this->calculateHours($dateTimeRounded,Date('Y-m-d h:i:s'));
            if($fundingProgress < "100")
            {
                $status="in process";
            }
            elseif($fundingProgress == "100")
            {
                $status="funded";
            }
            $fundingPlace=$raisedToDate/$hours;
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
                'remaining_to_rise'=>$remainingToRaise,
                'created_at' => $dateTimeRounded,
            ]);
            DB::table('RendityNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
        } 
    }
    }
}

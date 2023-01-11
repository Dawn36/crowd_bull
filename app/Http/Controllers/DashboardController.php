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
         $this->estateGuru();
         $this->crowdEstate();
         $this->HousersNew();
         $this->NordstreetNew();
         $this->ProfitusNew();
         $this->RendityNew();
        $this->platFormData('Crowdestate_General');
        $this->platFormData('Estateguru_General');
        $this->platFormData('Housers_General');
        $this->platFormData('letsinvest_Genegal'); 
        $this->platFormData('Nordstreet_General');
        $this->platFormData('Profitus_General');
        $this->platFormData('Raizers_General'); 
        $this->platFormData('Reinvest24_General'); 
        $this->platFormData('Rendity_General'); 
        $this->platFormData('Rontgen_General');
       
        
    }
    protected function estateGuru()
    {
        $estateguru=DB::table('EstateguruNew')->where('Project_Name','!=','')->where('fetch_data','no')->orderby('id','ASC')->limit('10000')->get();
        for ($i=0; $i < count($estateguru) ; $i++) { 
            # code...
            $fundingPlace=0;
        $id=$estateguru[$i]->id;
        $projectName=trim($estateguru[$i]->Project_Name);
        $goal=str_replace(",","",$estateguru[$i]->Goal);
        $loanDuration=$estateguru[$i]->Loan_Duration;
        $interest=str_replace("%","",$estateguru[$i]->Interest);
        $ltv=str_replace("%","",$estateguru[$i]->LTV);
        $linkToProject=$estateguru[$i]->Link_To_Project;
        $raisedToDate=$estateguru[$i]->Raised_To_Date;
        $fundingProgress=str_replace("%","",$estateguru[$i]->Funding_Progress);
        $fundingProgress=str_replace(",","",$fundingProgress);
        $numberOfInvestors=str_replace(",","",$estateguru[$i]->Number_Of_Investors);
        $remainingToRaise=str_replace(",","",$estateguru[$i]->Remaining_To_Raise);
        $loanType=$estateguru[$i]->Loan_Type;
        $comment=$estateguru[$i]->Comment;
        $dateTimeRounded=Date('Y-m-d h:i:s',strtotime($estateguru[$i]->Date_Time_Rounded));
        $platForm=$estateguru[$i]->Platform;
        $fetchData=$estateguru[$i]->fetch_data;
    //   dd($fundingProgress);
        $raisedToDate=$goal*($fundingProgress/100);
         
        if($raisedToDate == '')
        {
            DB::table('EstateguruNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
                continue;
        }

        if($numberOfInvestors == '')
        {
            DB::table('EstateguruNew')->where('id', $id)
                ->update(['fetch_data' => 'yes']);
                continue;
        }
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
    protected function platFormData($table)
    {
        $day7=Date("Y-m-d",strtotime("-7 days"));
        $day30=Date("Y-m-d",strtotime("-30 days"));
        $data=DB::table($table)->orderby('id','desc')->limit('1')->get(); 
        $data7Days=DB::table($table)->whereDate('Current_time_date',$day7)->orderby('id','desc')->limit('1')->get(); 
        $data30Days=DB::table($table)->whereDate('Current_time_date',$day30)->orderby('id','desc')->limit('1')->get(); 
        if(count($data) > 0)
        {
            $platFrom=trim($data[0]->Original_URL);
            $capitalRaisedToDate=trim($data[0]->Capital_raised);
            $avgInterestRate=isset($data[0]->Average_return) ? trim($data[0]->Average_return) : 0;
            $noOfProjectFunded=isset($data[0]->Funded_projects) ? trim($data[0]->Funded_projects) : 0;
            $noOfInvestors=isset($data[0]->No_of_investors) ? trim($data[0]->No_of_investors) : 0;
            try {
                $avgTicketSize=$capitalRaisedToDate/$noOfInvestors;
            } catch (\Throwable $th) {
                $avgTicketSize=0;
            }
            try {
                $raisedInThePast30DaysPercentage=trim($data30Days[0]->Capital_raised)/$capitalRaisedToDate;
                $increase30Status='increase';
            } catch (\Throwable $th) {
                $raisedInThePast30DaysPercentage=0;
                $increase30Status=(NULL);
            }
            try {
                $raisedThisWeekPercentage=trim($data7Days[0]->Capital_raised)/$capitalRaisedToDate;
                $increase7Status='increase';
            } catch (\Throwable $th) {
                $raisedThisWeekPercentage=0;
                $increase7Status=(NULL);
            }
            try {
                $data=isset($data30Days[0]->Capital_raised) ? trim($data30Days[0]->Capital_raised) : 0;
              $raisedInPast30Days=$capitalRaisedToDate-$data;
            } catch (\Throwable $th) {
                $raisedInPast30Days=0;
            }
            try {
                $data=isset($data7Days[0]->Capital_raised) ? trim($data7Days[0]->Capital_raised) : 0;
                $raisedInPast7Days=$capitalRaisedToDate-$data;
            } catch (\Throwable $th) {
                $raisedInPast7Days=0;
            }
            $flight = PlatForm::updateOrCreate(
                ['plat_form' => $platFrom],
                ['capital_raised_to_date' => $capitalRaisedToDate, 'avg_interest_rate' => $avgInterestRate,
                'no_of_project_funded' => $noOfProjectFunded, 'no_of_investors' => $noOfInvestors,
                'avg_ticket_size' => $avgTicketSize, 'raised_in_past_30_days' => $raisedInPast30Days,
                'raised_in_past_7_days' => $raisedInPast7Days, 'updated_at' => Date("Y-m-d H:i:s"),
                'raised_in_the_past_30_days_percentage' => $raisedInThePast30DaysPercentage, 'raised_this_week_percentage' => $raisedThisWeekPercentage,
                'raised_in_the_past_30_days_status' => $increase30Status, 'raised_this_week_status' => $increase7Status
                ]
            );
        }
        
    }
}

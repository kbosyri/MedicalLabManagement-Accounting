<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rewards\AddRewardRequest;
use App\Http\Requests\Rewards\RewardsReportRequest;
use App\Http\Requests\Rewards\UpdateRewardRequest;
use App\Http\Resources\RewardResource;
use App\Models\Reward;
use App\Models\Staff;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function AddReward(AddRewardRequest $request)
    {
        $reward = new Reward();

        $reward->staff_id = $request->staff_id;
        $reward->amount = $request->amount;
        $reward->reason = $request->reason;
        $reward->date = $request->date;

        $reward->save();

        return response()->json([
            'message'=>"تم إضافة مكافئة للموظف بنجاح",
            'reward'=>new RewardResource($reward),
        ]);
    }

    public function UpdateReward(UpdateRewardRequest $request,$id)
    {
        $reward = Reward::find($id);

        $reward->amount = $request->amount;
        $reward->reason = $request->reason;
        $reward->date = $request->date;

        $reward->save();

        return response()->json([
            'message'=>"تم تعديل مكافئة الموظف بنجاح",
            'reward'=>new RewardResource($reward),
        ]);
    }

    public function GetRewardsForStaff($id)
    {
        $rewards = Reward::where('staff_id',$id)->get();

        return RewardResource::collection($rewards);
    }

    public function GetAllRewards()
    {
        $rewards = Reward::all();

        return RewardResource::collection($rewards);
    }

    public function GetReward($id)
    {
        $reward = Reward::find($id);

        return new RewardResource($reward);
    }

    public function RewardsReport(RewardsReportRequest $request)
    {
        $rewards = Reward::whereBetween('date',[$request->from_date,$request->to_date]);

        if($request->first_name)
        {
            $staff = Staff::where('first_name',$request->first_name)->get();

            $ids = [];
            foreach($staff as $member)
            {
                array_push($ids,$member->id);
            }

            $rewards = $rewards->whereIn('staff_id',$ids);
        }

        if($request->father_name)
        {
            $staff = Staff::where('father_name',$request->father_name)->get();

            $ids = [];
            foreach($staff as $member)
            {
                array_push($ids,$member->id);
            }

            $rewards = $rewards->whereIn('staff_id',$ids);
        }

        if($request->last_name)
        {
            $staff = Staff::where('last_name',$request->last_name)->get();

            $ids = [];
            foreach($staff as $member)
            {
                array_push($ids,$member->id);
            }

            $rewards = $rewards->whereIn('staff_id',$ids);
        }

        $rewards = $rewards->get();

        return RewardResource::collection($rewards);
    }

}

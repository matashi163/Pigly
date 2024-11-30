<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SetWeightRequest;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Carbon\Carbon;

class PiglyController extends Controller
{
    public function test()
    {
        return view('test');
    }

    public function registerStep1()
    {
        return view('auth.register_step1');
    }

    public function registerStep2()
    {
        return view('auth.register_step2');
    }

    public function setWeight(SetWeightRequest $request)
    {
        $userId = auth()->id();

        $createWeightTarget = [
            'user_id' => $userId,
            'target_weight' => $request->target_weight,
        ];
        WeightTarget::create($createWeightTarget);

        $createWeightLog = [
            'user_id' => $userId,
            'date' => date('Y-m-d'),
            'weight' => $request->weight,
        ];
        WeightLog::create($createWeightLog);
        return redirect('/weight_logs');
    }

    public function weightLogs()
    {
        $user = User::find(auth()->id());
        $searching = false;

        $targetWeight = $user->weightTarget()->first()->target_weight;
        $weight = $user->weightLogs()->latest('date')->first()->weight;
        $toTargetWeight = number_format($targetWeight - $weight, 1);
        $weightLogs = $user->weightLogs()->select('id', 'date', 'weight', 'calories', 'exercise_time')->orderBy('date', 'desc')->paginate(8);
        $weightLogs->getCollection()->transform(function ($item) {
            if($item->exercise_time){
                $item->exercise_time = Carbon::parse($item->exercise_time)->format('H:i');
            }
            return $item;
        });

        return view('weight_logs', compact('targetWeight', 'weight', 'toTargetWeight', 'weightLogs', 'searching'));
    }

    public function goalSetting()
    {
        return view('goal_setting');
    }

    public function updateTarget(Request $request)
    {
        $targetWeight = [
            'target_weight' => $request->target_weight
        ];
        WeightTarget::where('user_id', auth()->id())->update($targetWeight);
        return redirect('/weight_logs');
    }

    public function search(Request $request)
    {
        $user = User::find(auth()->id());
        $dateFrom = $request->search_date_from;
        $dateTo = $request->search_date_to;
        $searching = true;

        $targetWeight = $user->weightTarget()->first()->target_weight;
        $weight = $user->weightLogs()->latest('date')->first()->weight;
        $toTargetWeight = number_format($targetWeight - $weight, 1);
        $weightLogs = $user->weightLogs()->whereBetween('date', [$dateFrom, $dateTo])->select('id', 'date', 'weight', 'calories', 'exercise_time')->orderBy('date', 'desc')->paginate(8)->withQueryString();
        $weightLogs->getCollection()->transform(function ($item) {
            if($item->exercise_time){
                $item->exercise_time = Carbon::parse($item->exercise_time)->format('H:i');
            }
            return $item;
        });
        $count = $user->weightLogs()->whereBetween('date', [$dateFrom, $dateTo])->count();

        return view('weight_logs', compact('targetWeight', 'weight', 'toTargetWeight', 'weightLogs', 'dateFrom', 'dateTo', 'searching', 'count'));
    }

    public function create(CreateRequest $request)
    {
        $createWeightLog = [
            'user_id' => auth()->id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ];
        weightLog::create($createWeightLog);
        return redirect('/weight_logs');
    }

    public function detail($weightLogId)
    {
        $weightLog = WeightLog::find($weightLogId);

        $detail = [
            'id' => $weightLog->id,
            'date' => $weightLog->date,
            'weight' => $weightLog->weight,
            'calories' => $weightLog->calories,
            'exercise_time' => $weightLog->exercise_time ? Carbon::parse($weightLog->exercise_time)->format('H:i') : null,
            'exercise_content' => $weightLog->exercise_content,
        ];

        return view('detail', compact('detail'));
    }

    public function updateLog(UpdateRequest $request, $weightLogId)
    {
        $updateLog = [
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ];
        WeightLog::find($weightLogId)->update($updateLog);
        return redirect('/weight_logs');
    }

    public function delete($weightLogId)
    {
        WeightLog::find($weightLogId)->delete();
        return redirect('/weight_logs');
    }
}

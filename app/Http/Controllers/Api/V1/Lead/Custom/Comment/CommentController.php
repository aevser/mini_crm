<?php

namespace App\Http\Controllers\Api\V1\Lead\Custom\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lead\Custom\Comment as Requests;
use App\Jobs\V1\Lead\Custom\Comment as Jobs;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function update(Requests\Update $request, $lead_id)
    {
        Jobs\Update::dispatchSync(
            lead_id: $lead_id,
            comment: $request->comment
        );

        return response()->json(['message' => 'Комментарий добавлен'], Response::HTTP_OK);
    }

    public function destroy($lead_id)
    {
        Jobs\Delete::dispatchSync($lead_id);
        return response()->json(['messages' => 'Комментарий удален'], Response::HTTP_OK);
    }
}

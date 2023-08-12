<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Blog\Post;
use App\Models\User;
use App\Models\WriterInfo;
use App\Traits\OptimizeImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class MainController extends Controller
{
    use OptimizeImage;

    public $notifications;

    public function index()
    {
        $posts = Post::editor()->latest()->get();
        $now = Carbon::now();
        $postsThisMonth = $posts->where('created_at', '>=', $now->startOfMonth())->count();
        $totalPosts = $posts->count();

        $percentageThisMonth = $totalPosts > 0 ? abs(($postsThisMonth / $totalPosts) * 100) : 0;

        $viewsThisMonth = $posts->where('created_at', '>=', $now->startOfMonth())->sum('views');

        $previousMonth = Carbon::now()->subMonth();

        // Calculate previous month's comments
        $previousMonthTotalComments = $posts->flatMap(function ($post) use ($previousMonth) {
            return $post->comments->whereBetween('created_at', [$previousMonth->startOfMonth(), $previousMonth->endOfMonth()]);
        })->count();

        // Calculate current month's comments
        $currentMonthTotalComments = $posts->flatMap(function ($post) use ($now) {
            return $post->comments->whereBetween('created_at', [$now->startOfMonth(), $now->endOfMonth()]);
        })->count();

        // Calculate differences
        $commentsDifference = $currentMonthTotalComments - $previousMonthTotalComments;

        // Determine Increase or Decrease
        $commentsChange = $commentsDifference > 0 ? 'Increase' : ($commentsDifference < 0 ? 'Decrease' : 'No change');

        // Calculate percentage change (avoid division by zero)
        $percentageCommentsChange = $previousMonthTotalComments > 0 ? abs(($commentsDifference / $previousMonthTotalComments) * 100) : 0;


        // Fetch previous month's total views
        $previousMonthTotalViews = $posts->sum('views', function ($post) use ($previousMonth) {
            return $post->created_at->between($previousMonth->startOfMonth(), $previousMonth->endOfMonth());
        });
        // Fetch current month's total views
        $currentMonthTotalViews = $posts->sum('views', function ($post) use ($now) {
            return $post->created_at->between($now->startOfMonth(), $now->endOfMonth());
        });
        // Calculate differences
        $viewsDifference = $currentMonthTotalViews - $previousMonthTotalViews;
        // Determine Increase or Decrease
        $viewsChange = $viewsDifference > 0 ? 'Increase' : ($viewsDifference < 0 ? 'Decrease' : 'No change');
        // Calculate percentage change (avoid division by zero)
        $percentageViewsChange = $previousMonthTotalViews > 0 ? abs(($viewsDifference / $previousMonthTotalViews) * 100) : 0;


        $data = [
            'posts' => [
                'posts' => $posts,
                'percentageThisMonth' => $percentageThisMonth,
                'postsThisMonth' => $postsThisMonth,
                'totalPosts' => $totalPosts
            ],
            'views' => [
                'viewsThisMonth' => $viewsThisMonth,
                'percentageViewsChange' => $percentageViewsChange,
                'viewsChange' => $viewsChange,
            ],
            'comments' => [
                'commentsThisMonth' => $currentMonthTotalComments,
                'percentageCommentsChange' => $percentageCommentsChange,
                'commentsChange' => $commentsChange
            ]

        ];


        return view('writer.index', $data);
    }

    public function getNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    public function notifications()
    {
        $this->getNotifications();

        $data = [
            'notifications' => $this->notifications
        ];

        return view('writer.notifications', $data);
    }
}

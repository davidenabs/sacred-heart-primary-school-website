<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Blog\Post;
use App\Models\Gallery\Gallery;
use App\Models\Management;
use App\Models\Setting;
use App\Models\Subscribe;
use App\Models\Testimony;
use App\Models\User;
use App\Traits\OptimizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class MainController extends Controller
{
    use OptimizeImage;

    public function __construct()
    {
    }

    public function index()
    {
        $posts = Post::with([
            'author' => function ($query) {
                $query->select('id', 'name',);
            },
        ])
            ->searched()
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get(
                [
                    'id',
                    'author_id',
                    'category_id',
                    'title',
                    'summary',
                    'featured_image',
                    'slug',
                    'created_at'
                ]
            );
        //
        $team = Management::orderBy('created_at', 'desc')->get([
            'name', 'avatar', 'role', 'social_fb',
            'social_tw',  'social_ig'
        ]);

        $data = [
            'posts' => $posts,
            'team' => $team,
            'testimonies' => Testimony::latest()->take(6)->get(),
            'page' => new SEOData(
                title: 'Sacred Heart Primary School Kaduna',
                description: 'Welcome to Sacred Heart Primary School, a leading institution committed to nurturing young minds, fostering academic excellence, and building a strong foundation for a successful future. Explore our vibrant community and discover the exceptional educational opportunities we offer.',
            ),
        ];

        return view('guest.index', $data);
    }

    public function about()
    {
        return view('guest.about', [
            'page' => new SEOData(
                title: 'About us',
                description: "Discover our vision at Sacred Heart Primary School, where we aim to create a caring community, fostering love, respect, and the realization of each child's fullest potential. Learn more about our commitment to holistic growth and excellence in education.",
            ),
        ]);
    }

    public function management()
    {
        $team = Management::orderBy('created_at', 'desc')->get([
            'name', 'avatar', 'bio', 'role', 'social_fb',
            'social_tw',  'social_ig'
        ]);
        return view('guest.management', [
            'team' => $team,
            'page' => new SEOData(
                title: 'Our management',
                description: "Explore the dedicated School Management team at Sacred Heart Primary School, leading with passion and expertise to provide a nurturing environment for academic growth. Learn about our commitment to excellence in education and student development.",
            ),
        ]);
    }

    public function contact()
    {
        return view('guest.contact', [
            'page' => new SEOData(
                title: 'Contact us',
                description: "Contact Sacred Heart Primary School today to learn more about our exceptional education, nurturing environment, and community-driven approach. Reach out to our dedicated team for inquiries, enrollment, and to experience the heart of education.",
            ),
        ]);
    }

    public function contactSend(Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'subject' => 'required',
        ]);

        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
            'subject' => $validatedData['subject'],
        ];

        // sending to main admin
        $admin = User::whereRole('ADM')->whereId('1')->first();

        Mail::to($admin)->send(new ContactMail($data));

        session()->flash('success', 'Thank you for your inquiry. We have received it and will process it promptly, expecting to provide a response shortly.');

        return redirect()->back();
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->get();
        $page = new SEOData(
            title: 'Our gallery',
            description: "Explore the vibrant world of Sacred Heart Primary School through our gallery. Immerse yourself in our students' achievements, memorable events, and the spirit of our community. Discover the heartwarming moments that make our school a special place",
        );
        return view('guest.gallery', compact('galleries', 'page'));
    }

    public function galleryShow(Gallery $gallery)
    {
        $page = new SEOData(
            title: $gallery->title,
            description: $gallery->description,
            image: json_decode($gallery->photos)[0],
            url: url(route('gallery.show', $gallery->slug))
        );
        return view('guest.gallery-show', compact('gallery', 'page'));
    }

    public function blog()
    {
        return view('guest.blog');
    }

    public function apply()
    {
        $page = new SEOData(
            title: 'Apply now',
            description: " Begin your child's educational journey at Sacred Heart Primary School. Our application page provides a seamless process for enrollment, offering a nurturing environment where children can thrive, learn, and develop to their fullest potential. Apply now and be part of our caring community.",
        );
        return view('guest.application', compact('page'));
    }

    public function createTestimony()
    {
        $page = new SEOData(
            title: 'Testimonial',
        );
        return view('guest.create-testimony', compact('page'));
    }

    public function storeTestimony(Request $request)
    {
        $validatedData = $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|string',
            'occupation' => 'nullable|string',
            'review' => 'required|max:500|string'
        ]);

        $checkWhetherUserHasReviewedBefore = Testimony::whereEmail($request->email)->first();

        if (!$checkWhetherUserHasReviewedBefore) {

            Testimony::create($validatedData);

            // send notification to admin

            session()->flash(
                'success',
                "We sincerely appreciate your valuable review of our school. Rest assured, we are diligently addressing the points you've raised, and we are committed to enhancing the overall experience at Sacred Heart. Your feedback is invaluable to us, and we look forward to implementing improvements that will make our institution even more exceptional. Thank you for being a part of our ongoing journey of growth and excellence."
            );

            return redirect()->back();
        }

        session()->flash('warining', '');

        return redirect()->back();
    }

    public function subscribe(Request $request)
    {
        $validatedData = $this->validate($request, ['subscribe_email' => 'required|email|unique:subscribes,email'], ['subscribe_email.unique' => 'You are already a subscriber']);

        Subscribe::create(['email' => $validatedData['subscribe_email']]);


        session()->flash('success', 'You\'s successfully subscribed to our newslatter.');
        return redirect()->back()->withErrors($validatedData)->withInput();
    }

    public function unsubscribe(Request $request)
    {
        if ($request->method() == "POST" && $request->has('_token')) {

            $email = session('unsubscribe_email');

            if ($email) {
                Subscribe::whereStatus('1')->first()->update(['status' => 0]);
                session()->flash(
                    'success',
                    "You have successfully unsubscribed from receiving our newsletter and updates."
                );
                $email = '';
                session()->forget('unsubscribe_email');
                return view('guest.unsubscribe', compact('email'));
            }
        }

        if ($request->has('email')) {

            session(['unsubscribe_email' =>  $request->query('email')]);
            return redirect()->route('unsubscribe');
        } elseif (session()->has('unsubscribe_email')) {

            $email = session('unsubscribe_email');

            return view('guest.unsubscribe', compact('email'));
        }


        // $email = session('unsubscribe_email');

        // Handle the unsubscribe action (e.g., set the subscriber's status to "unsubscribed" in the database)

        // Clear the email from the session
        // session()->forget('unsubscribe_email');



        return view('guest.unsubscribe');
    }

    public function downloadApplicationForm()
    {
        $file = public_path() . "/shs/download/application.pdf";

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'application.pdf', $headers);
    }

    public function test(Request $request)
    {
        $files = $request->only('files');
        if ($files) {

            // $i = rand(1000, 9999);
            foreach ($files as $key => $file) {
                $name = 'sacred-heart-primary-school-kaduna' . '.' . $file->extension();

                $imagePath = $file->storeAs('shs_images/circles', $name, 'real_public');

                echo $file = $this->optimizeImage($imagePath);
                // $i++;

            }
        }
    }
}

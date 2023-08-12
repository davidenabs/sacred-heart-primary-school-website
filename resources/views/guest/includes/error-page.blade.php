<div class="container">
    <div class="wrapper-pack">
        <center>
            <h2>{{ $title }}</h2>
            <img src="{{ $imageLink }}" alt="" class="img-err animate__animated animate__bounce" />
            <p style="color: rgb(31, 30, 112); widt: 330px; font-size: 20px;"
                class="animate__animated animate__backInLeft">{{ $message }}<br>Try going back to the Homepage</p>
            <a href="{{ route('home') }}"><button class="btn text-light"
                    style="width: 150px; background-color: rgb(31, 30, 112);">Go Back</button></a>
            <br>
            <p class="my-4" style="color: color-mix(in srgb, blue 20%, grey 60%);">
                If you think this is an error<br>contact our support
                team
                at
                {{ $settings->school_email }}
            </p>
        </center>
    </div>
</div>

@section('styles')
<style>
    .container-pack {
      display: grid;
      align-items: center;
      margin-top: 140px;

    }

    .img-err {
      height: 55vh;
      width: 390px;
      border: 2px thin rgb(31, 30, 112);
      background-blend-mode: luminosity;
      mix-blend-mode: multiply;
    }

    h2 {
      padding-bottom: 0;
      font-size: 55px;
      font-weight: bolder;
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      color: rgb(31, 30, 112);
    }

    button:hover {
      border: 2px solid white;
      color: rgb(31, 30, 112);
      background-color: white;
    }
  </style>
@endsection
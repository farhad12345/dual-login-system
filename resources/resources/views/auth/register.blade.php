<x-guest-layout>
    @section('title', 'Register')
    <style>
        .back{
    background-image: url('{{ asset('admin/ff1.jpg') }}');
    background-repeat: no-repeat;
    background-size: cover;
}
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}
    </style>
   <div class="container">
    <h3>
        <a class="btn btn-info" href="javascript:history.back()">
            &#8592; Back
        </a>
    </h3>
    <br>
</div>

      <x-auth-session-status class="mb-4" :status="session('status')" />
    {{-- <body class="">
  <div class="container mt-5 "  >
    <div class="card shadow-sm" >

        <div class="card-body"> --}}
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- الاسم -->
        <div>
            <x-input-label for="name" :value="__('الاسم')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- البريد الإلكتروني -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- كلمة المرور -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" />

            <div class="relative">
                <!-- Password Input -->
                <x-text-input id="password" class="block mt-1 w-full pr-12" type="password" name="password" required
                              autocomplete="new-password" />

                <!-- Eye Icon -->
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password absolute inset-y-0 right-3 flex items-center cursor-pointer"></span>
              </div>



            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- تأكيد كلمة المرور -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('هل لديك حساب؟') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('تسجيل') }}
            </x-primary-button>
        </div>
    </form>
    {{-- </div>
</div>
</div>
    </body> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
  $(document).ready(function () {
    $(".toggle-password").click(function () {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") === "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  });
      </script>
</x-guest-layout>

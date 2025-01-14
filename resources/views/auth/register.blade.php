<x-guest-layout>
    @section('title', 'Register')
    <style>
        .back{
    background-image: url('{{ asset('admin/ff1.jpg') }}');
    background-repeat: no-repeat;
    background-size: cover;
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

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

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
</x-guest-layout>

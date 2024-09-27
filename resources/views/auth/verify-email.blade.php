{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}


@extends('frontend.layouts.layout')
@section('content')

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="login-register-wrapper">
            <div class="container">
                <div class="member-area-from-wrap">
                    <div class="row justify-content-center">

                        <div class="login-reg-form-wrap mt-md-34 mt-sm-34">
                            <!-- Informational Message -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single-input-item">
                                        <p class="text-sm text-gray-600">
                                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Verification Status Message -->
                            @if (session('status') == 'verification-link-sent')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single-input-item">
                                            <p class="font-medium text-sm text-success">
                                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Resend Verification Email -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single-input-item">
                                        <button type="submit" class="sqr-btn">
                                            {{ __('Resend Verification Email') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Logout Button -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="single-input-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

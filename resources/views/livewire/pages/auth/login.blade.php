<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <!-- auth page bg -->
    <div class="auth-one-bg-position {{--auth-one-bg--}}" style="background-color:#EFB036" id="auth-particles">
        <div class="bg-overlay" style="background-color:#EFB036"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a class="d-inline-block auth-logo">
                                <img src="assets/iconw.png" alt="" height="210">
                            </a>
                        </div>
                        <ed class="mt-3 fs-15 fw-medium" style="color:white">EDM - Integrated System</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to EDM - Integrated System.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form wire:submit="login">

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Email</label>
                                        <input type="text" class="form-control @error('form.email') is-invalid @enderror" placeholder="Enter email" wire:model="form.email">
                                        @error('form.email')
                                            <span class="text-danger"
                                                x-data="{ show: true }" show="show">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input @error('form.password') is-invalid @enderror" placeholder="Enter password" id="password-input" wire:model="form.password">
                                            {{-- <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button> --}}
                                            @error('form.password')
                                                <span class="text-danger"
                                                    x-data="{ show: true }" x-show="show">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  wire:model="form.remember" value="" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">{{ __('Remember me') }}</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn w-100" style="background-color:#EFB036;color:white" type="submit">Sign In</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script> EDM - Mozambique. Crafted with <i class="mdi mdi-heart text-danger"></i> by Mauro Peniel
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
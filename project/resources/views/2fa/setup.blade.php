@extends('layouts.profile')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/4 bg-gray-50 p-6 border-r border-gray-200">
                <nav class="space-y-2">
                    <a href="{{ route('profile.index') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-md">
                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Personal Info
                    </a>
                    <a href="{{ route('profile.password') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-md">
                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Change Password
                    </a>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-indigo-700 bg-indigo-50 rounded-md">
                        <svg class="mr-3 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 3a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm0 14.5c-2.003 0-3.887-.78-5.303-2.197a1 1 0 0 1-.094-1.32A6.974 6.974 0 0 1 12 13c2.22 0 4.22 1.034 5.397 2.643a1 1 0 0 1-.094 1.32A7.496 7.496 0 0 1 12 19.5z" />
                        </svg>
                        Two-Factor Authentication
                    </a>
                </nav>
            </div>

            @if(!Auth::user()->google2fa_enabled)
                <div class="md:w-3/4 p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Set Up Two-Factor Authentication</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Enhance your account security by enabling two-factor authentication.
                            This adds an extra layer of protection to your account.
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row">
                                <div class="sm:w-1/2 mb-6 sm:mb-0 sm:pr-4">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">1. Scan this QR code</h3>
                                    <div class="bg-gray-100 p-4 rounded-lg flex items-center justify-center">
                                        <div>{!! $qrcode !!}</div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Use Google Authenticator or another authenticator app to scan this QR code.
                                    </p>
                                </div>

                                <div class="sm:w-1/2 sm:pl-4 border-t sm:border-t-0 sm:border-l border-gray-200 pt-6 sm:pt-0 sm:pl-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">2. Enter the code from your app</h3>

                                    @if(session('error'))
                                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                            <span class="block sm:inline">{{ session('error') }}</span>
                                        </div>
                                    @endif

                                    <p class="text-sm text-gray-600 mb-3">
                                        After scanning, enter the 6-digit verification code displayed in your authenticator app.
                                    </p>

                                    <form method="POST" action="{{ route('2fa.authenticate') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="one_time_password" class="sr-only">Authentication Code</label>
                                            <input type="text" name="one_time_password" id="one_time_password"
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-lg border-gray-300 rounded-md text-center tracking-widest font-mono"
                                                placeholder="000000" maxlength="6" autocomplete="off" autofocus required>
                                            @error('one_time_password')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Verify & Enable 2FA
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Backup Code</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    If you can't access your authenticator app, you can use this secret key to set up 2FA on a new device:
                                </p>
                                <div class="bg-gray-100 p-3 rounded-md mb-4">
                                    <code class="font-mono text-sm tracking-wider select-all">{{ $secret }}</code>
                                </div>
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                <strong>Important:</strong> Store this secret key securely. If you lose your device, you'll need this key to regain access to your account.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('profile.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to Profile
                        </a>
                    </div>
                </div>
            @else
                <div class="mt-10 px-10 py-6  border-t border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Two-Factor Authentication</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Add additional security to your account using two-factor authentication.
                                </p>

                                <div class="mt-4">
                                    @if(auth()->user()->google2fa_enabled)
                                        <div class="bg-green-50 border-l-4 border-green-400 p-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm text-green-700">
                                                        You have enabled two-factor authentication.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" class="cursor-no-drop mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Disable Two-Factor Authentication
                                        </a>
                                    @else
                                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm text-yellow-700">
                                                        You have not enabled two-factor authentication yet.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('2fa.setup') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Set up Two-Factor Authentication
                                        </a>
                                    @endif
                                </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Or
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    sign in to your existing account
                </a>
            </p>
        </div>
       <div id="message" class="text-red-400 "></div>
        <form class="mt-8 space-y-6" onsubmit="RegisterAccount(event)">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="name" class="sr-only">Full name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Full name">
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="mt-4">
                @error('account_type')
                    <span>{{ $message }}</span>
                @enderror
                <fieldset>
                    <legend class="text-center text-sm font-medium text-gray-700">Account type</legend>
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <div onclick="AccountType(1)" >
                            <input type="radio" id="client" name="account_type" value="client" class="sr-only" checked>
                            <label id="person" for="client" class="flex p-3 border-2 rounded-md shadow-sm cursor-pointer focus:outline-none ">
                                <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="ml-2 text-sm font-medium text-gray-900">Passenger</span>
                            </label>
                        </div>
                        <div onclick="AccountType(2)">
                            <input type="radio"  id="company" name="account_type" value="company" class="sr-only">
                            <label id="campany" for="company" class="flex p-3 border-2 rounded-md shadow-sm cursor-pointer focus:outline-none ">
                                <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="ml-2 text-sm font-medium text-gray-900">Company</span>
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="flex items-center">
                <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" required>
                <label for="terms" class="ml-2 block text-sm text-gray-900">
                    I agree to the <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Terms and Conditions</a>
                </label>
            </div>

            <div>
                <button id="registerbtn" type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span id="loadingpanel" class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                    </span>
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>
<script >

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("person").classList.add("border-indigo-600");
        document.getElementById("campany").classList.add("border-white");
    });
    window.AccountType = function (type) {
        console.log("Selected account type:", type);
        if (type === 1) {
            document.getElementById("person").classList.remove("border-white");
            document.getElementById("person").classList.add("border-indigo-600");
            document.getElementById("campany").classList.remove("border-indigo-600");
            document.getElementById("campany").classList.add("border-white");
            document.getElementById("passenger").checked = true;
        } else {
            document.getElementById("campany").classList.remove("border-white");
            document.getElementById("campany").classList.add("border-indigo-600");
            document.getElementById("person").classList.remove("border-indigo-600");
            document.getElementById("person").classList.add("border-white");
            document.getElementById("company").checked = true;
        }
    };

    function RegisterAccount(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        document.getElementById("loadingpanel").innerHTML = `
            <svg aria-hidden="true" class="w-6 h-6 text-transparent animate-spin  fill-white" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
                        `;
        const messageerror = document.getElementById("message");
        messageerror.innerHTML = ``;
        const spanE = document.createElement("span");

        const data = {};
        formData.forEach((value, key) => {
        data[key] = value;
        });

        console.log(data);

        fetch("{{ route('signup') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
        if(result?.status){
            location.href = "/login";
        }else{
            spanE.textContent = result?.message;
            messageerror.appendChild(spanE);
            document.getElementById("loadingpanel").innerHTML = `
                <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                </svg>`;
        }
        })
        .catch(error => {
            spanE.textContent = "An error occurred. Please try again.";
            messageerror.appendChild(spanE);
            document.getElementById("loadingpanel").innerHTML = `
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
            </svg>`;
        });

    }


</script>
@endsection


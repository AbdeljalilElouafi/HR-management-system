<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Company Registration</h2>

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form action="{{ route('company.register') }}" method="POST">
                @csrf

                <!-- Company Information -->
                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-4">
                    <label for="sector" class="block text-sm font-medium text-gray-700">Sector</label>
                    <input type="text" name="sector" id="sector" value="{{ old('sector') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-4">
                    <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-4">
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                    <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <!-- Admin User Information -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Your Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Register
                    </button>
                </div>
            </form>

            <!-- Link to Login Page -->
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Login here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
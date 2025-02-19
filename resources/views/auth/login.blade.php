@extends("layouts.home")
@section("content")
    ;
    <div class="container mx-auto p-4">
        <div class="mx-auto max-w-md rounded bg-white p-8 shadow">
            <h1 class="mb-4 text-2xl font-bold">Login</h1>
            <form action="{{ route("login") }}" method="POST">
                @csrf
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    class="mb-2 w-full rounded border p-2"
                />
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="mb-2 w-full rounded border p-2"
                />
                <button class="w-full rounded bg-blue-500 p-2 text-white">
                    Login
                </button>
            </form>

            <!-- Link ke Modal -->
            <div class="mt-4 text-center">
                <button
                    onclick="showAuthModal('login')"
                    class="text-sm text-blue-500 hover:underline"
                >
                    Login Via Modal
                </button>
            </div>
        </div>
    </div>
@endsection

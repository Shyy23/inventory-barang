@extends("layouts.home")

@section("content")
    <div class="container mx-auto p-4">
        <div class="mx-auto max-w-md rounded bg-white p-8 shadow">
            <h1 class="mb-4 text-2xl font-bold">Lupa Password</h1>
            <form method="POST" action="{{ route("password.email") }}">
                @csrf
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    class="mb-4 w-full rounded border p-2"
                />
                <button class="w-full rounded bg-blue-500 p-2 text-white">
                    Kirim Link Reset
                </button>
            </form>

            <!-- Link ke Modal -->
            <div class="mt-4 text-center">
                <button
                    onclick="showPasswordResetModal()"
                    class="text-sm text-blue-500 hover:underline"
                >
                    Reset via Modal
                </button>
            </div>
        </div>
    </div>
@endsection

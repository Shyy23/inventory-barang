<div
    class="fixed inset-0 flex items-center justify-center bg-black/50"
    x-show="showPasswordReset"
    clas
>
    <div class="w-96 rounded-lg bg-white p-6">
        <h2 class="mb-4 text-xl font-bold">Reset Password</h2>
        <form action="{{ route("password.email") }}">
            @csrf
            <input
                type="email"
                name="email"
                placeholder="Email"
                class="mb-4 w-full rounded border p-2"
            />
            <div class="flex gap-2">
                <button
                    type="button"
                    @click="showPasswordReset=false"
                    class="rounded bg-gray-200 px-4 py-2"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="rounded bg-blue-500 px-4 py-2 text-white"
                >
                    Kirim Link Reset
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Tabs --}}

<div class="flex mb-6 border-b">
    <button
    @click="activeTab='login'"
    :class="{ 'border-b-2 border-[--primary-clr]' : activeTab === 'login'}"
    >
    Login
    </button>
    <button
    @click="activeTab='register'"
    :class="{'border-b-2 border-[--primary-clr]' : activeTab === 'register'}"
    >
    Register
</button>
</div>

<div 
x-show="activeTab === 'login'"
class="">
<form action="{{route('login')}}">
    @csrf
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button>Login</button>
</form>

<a href="{{route('social.redirect', 'google')}}">Google</a>
<a href="{{route('social.redirect', 'github')}}">Github</a>

<button @click="showPasswordReset = true">Lupa Password?</button>
</div>

{{-- Register Form --}}
<div x-show="activeTab === 'register" 
class="">
 <form action="{{route('register')}}" method="POST">
    @csrf
    <input type="text" name="name" required>
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button>Daftar</button>
 </form>
</div>

{{-- Lupa Password --}}
<div x-show="showPasswordReset" class="fixed inset-0 bg-black/50">
    <form action="{{route('password.email')}}" method="POST">
        <input type="email" name="email" required>
        <button>Kirim Reset Link</button>
        <button @click="showPasswordReset = false">Batal</button>
    </form>
    <a href="{{route('password.request')}}">Gunakan Halaman reset Password</a>
</div>

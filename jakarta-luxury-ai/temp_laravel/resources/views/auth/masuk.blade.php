@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-6">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <span class="text-luxury-gold text-xs uppercase tracking-[0.2em]">Selamat Datang Kembali</span>
            <h1 class="text-4xl font-serif text-white mt-4">Masuk</h1>
        </div>

        <div class="bg-luxury-card border border-white/5 p-8 rounded-xl backdrop-blur-md">
            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/50 text-red-400 text-xs p-3 rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Username atau Email</label>
                    <input type="text" name="username" class="w-full bg-black/50 border border-white/10 rounded p-3 text-white focus:border-luxury-gold focus:outline-none transition-colors" required>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-black/50 border border-white/10 rounded p-3 text-white focus:border-luxury-gold focus:outline-none transition-colors" required>
                </div>

                <button type="submit" class="w-full py-4 bg-luxury-gold text-black text-xs font-bold uppercase tracking-widest hover:bg-white transition-colors rounded-sm">
                    Masuk
                </button>

                <div class="text-center mt-6">
                    <p class="text-gray-500 text-xs">Belum punya akun? <a href="{{ route('register') }}" class="text-luxury-gold hover:text-white transition-colors">Daftar Sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

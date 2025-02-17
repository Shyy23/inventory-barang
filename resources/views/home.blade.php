@extends("layouts.home")
@push("styles")
    
@endpush

@section("content")
    <div class="content grid h-full w-full grid-cols-2 gap-10">
        <div class="content-image grid place-items-center py-8">
            <img
                src="{{ asset("assets/svg/welcome.svg") }}"
                alt="Welcome"
                class="w-[400px]"
            />
        </div>
        <div class="content-description pt-[4rem]">
            <h3 class="title text-left font-nunito font-semibold leading-[1.3]">
                <span
                    class="text-[1.5rem] font-bold uppercase text-[--primary-clr]"
                >
                    Selamat Datang
                </span>
                <br />
                <span class="text-[1.3rem]">di Website Inventory Barang</span>
            </h3>
        </div>
    </div>
@endsection

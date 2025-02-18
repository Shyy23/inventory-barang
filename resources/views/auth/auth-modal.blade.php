{{-- Tabs --}}

<div class="flex mb-6 border-b">
    <button
    @click="activeTab='login'"
    :class="{ 'border-b-2 border-[--primary-clr]' : activeTab === 'login'}"
    >
    Login
    </button>

</div>

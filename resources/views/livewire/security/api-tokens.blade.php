<div>
    <x-security.navbar />
    <div class="flex gap-2">
        <h2 class="pb-4">API Tokens</h2>
        <x-helper
            helper="Tokens are created with the current team as scope. You will only have access to this team's resources." />
    </div>
    <h4>Create New Token</h4>
    <span>Currently active team: <span class="text-warning">{{ session('currentTeam.name') }}</span></span>
    <form class="flex items-end gap-2 pt-4" wire:submit.prevent='addNewToken'>
        <x-forms.input required id="description" label="Description" />
        <x-forms.button type="submit">Create New Token</x-forms.button>
    </form>
    @if (session()->has('token'))
        <div class="pb-4 font-bold text-warning">Please copy this token now. For your security, it won't be shown again.
        </div>
        <div class="pb-4 font-bold text-white"> {{ session('token') }}</div>
    @endif
    <h4 class="py-4">Issued Tokens</h4>
    <div class="grid gap-2 lg:grid-cols-1">
        @forelse ($tokens as $token)
            <div class="flex items-center gap-2">
                <div
                    class="flex items-center gap-2 group-hover:text-white p-2 border border-coolgray-200 hover:text-white hover:no-underline min-w-[24rem] cursor-default">
                    <div>{{ $token->name }}</div>
                </div>
                <x-forms.button wire:click="revoke('{{ $token->id }}')">Revoke</x-forms.button>
            </div>
        @empty
            <div>
                <div>No API tokens found.</div>
            </div>
        @endforelse
    </div>

</div>

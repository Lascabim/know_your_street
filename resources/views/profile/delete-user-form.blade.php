<x-action-section>
    <x-slot name="title">
        {{ __('Apagar Conta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Apagar permanentemente a tua conta.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Uma vez que a mesma seja apagada, toda a informação da mesma será permanentemente perdida.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Apagar Conta') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Apagar Conta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Tens a certeza que queres apagar a tua conta? Uma vez que a mesma seja apagada, toda a informação da mesma será permanentemente perdida. Por favor introduz a tua password atual para confirmares esta ação.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Apagar Conta') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>

<script>

import BlockHeader from "@/Components/BlockHeader.svelte";
import { useForm } from '@inertiajs/svelte'

let form = useForm({
    login: null,
    password: null,
    remember: false,
})

let RegForm = useForm({
    email: null,
    password: null,
    password_confirm: null,
    name: null
})
function registerSubmit(){
    $RegForm.post('/register')
}

export let errors = {};
let error = '';

function checkMatch() {
    if ($RegForm.password_confirm !== $RegForm.password) {
        error = "Passwords don't match"
    } else {
        error = ''
    }
}

function submit() {

    $form.post('/signin')
}

</script>
<div class="container">

    <div class="columns">
        <div class="column col-12">
            <BlockHeader title="sign-in">
                <div class="columns">
                    <div class="column">

                        <form on:submit|preventDefault={submit}>
                            <div class="form-group">
                                <label class="form-label" for="input-example-1">Email or Username</label>
                                <input class="form-input" id="input-example-1" required type="text" bind:value={$form.login} placeholder="Email">
                                {#if $form.errors.login}
                                    <div class="form-error bg-error">{$form.errors.login}</div>
                                {/if}
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="input-example-2">Password</label>
                                <input class="form-input" id="input-example-2" type="password" required placeholder="Password" bind:value={$form.password}>
                            </div>
                            <div class="form-group">
                                <label class="form-checkbox">
                                    <input type="checkbox" bind:checked={$form.remember}><i class="form-icon"></i> Remember me
                                </label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" disabled={$form.processing}>Sign in</button>
                            </div>
                        </form>

                    </div>
                    <div class="divider-vert" data-content="OR"></div>
                    <div class="column">

                        <form on:submit|preventDefault={registerSubmit}>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input class="form-input" type="text" placeholder="Email" required bind:value={$RegForm.email}>
                                {#if errors.email}
                                    <div class="bg-error">{errors.email}</div>
                                {/if}
                            </div>

                            <div class="form-group">
                                <label class="form-label" >Username</label>
                                <input class="form-input" type="text" placeholder="Username" required bind:value={$RegForm.name}>
                                {#if errors.name}
                                    <div class="bg-error">{errors.name}</div>
                                {/if}
                            </div>

                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input class="form-input" type="password" required bind:value={$RegForm.password}>
                                {#if errors.password}
                                    <div class="bg-error">{errors.password}</div>
                                {/if}
                            </div>

                            <div class="form-group">
                                <label class="form-label">Repeat Password</label>
                                <input class="form-input" type="password" required bind:value={$RegForm.password_confirm} on:keyup={checkMatch} on:change={checkMatch}>
                                {#if errors.password_confirm}
                                    <div class="bg-error">{errors.password_confirm}</div>
                                {/if}
                                {#if error !== ''}
                                    <div class="bg-error">{error}</div>
                                {/if}
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block" disabled={$RegForm.processing}>Sign up</button>
                            </div>
                        </form>

                    </div>
                </div>
            </BlockHeader>
        </div>
    </div>
</div>
